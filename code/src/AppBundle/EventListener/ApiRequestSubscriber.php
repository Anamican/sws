<?php

namespace AppBundle\EventListener;

use AppBundle\Api\ApiEntities;
use AppBundle\Api\ApiProblem;
use AppBundle\Api\ApiProblemException;
use AppBundle\Validator\ApiValidator;
use Doctrine\ORM\EntityManager;
use OAuth2\HttpFoundationBridge\Request;
use OAuth2\HttpFoundationBridge\Response;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use OAuth2\Server;
use Symfony\Component\HttpKernel\KernelEvents;


class ApiRequestSubscriber implements EventSubscriberInterface
{
    private $debug;
    private $server;
    private $request;
    private $response;
    private $em;
    private $user;

    public function __construct(Server $server, Request $request, Response $response, EntityManager $em,  $debug)
    {
        $this->server = $server;
        $this->request = $request;
        $this->response = $response;
        $this->debug = $debug;
        $this->em = $em;
    }

    private function validateErrors($path){

        $dataArray = $this->request->request->all();

        $transformedPath = preg_replace('#\/#', "_", $path);

        $apiValidator = new ApiValidator($transformedPath);
        $validated = $apiValidator->validate($dataArray);

        //Validation error throw exception
        if($validated[0] == -1){
            $errorFields = array();
            foreach ($validated[1] as $k => $value)
            {
                if(!in_array($value['field'], $errorFields)){
                    $errorFields[] = $value['field'];
                }
            }

            $detail = "Please check fields: ".implode(", ", $errorFields) ;

            $apiProblem = new ApiProblem(400, ApiProblem::TYPE_VALIDATION_ERROR, $detail);
            throw  new ApiProblemException($apiProblem);
        }

        return 1;
    }

    private function setLoggedInUser($email){

        $user = $this->em->getRepository('AppBundle:User')->findUserByEmail($email);
        $this->user= $user;

    }

    public function onKernelRequest()
    {
        // only reply to /api URLs
        $path = $this->request->getPathInfo();
        if ( strpos($path, '/api/user/register') === 0 || strpos($path, '/api') !== 0 ) {
            return;
        }

        //Check Token validity
        $tokenInfo = $this->server->getAccessTokenData($this->request, $this->response);
        if(!$tokenInfo)
        {
            throw new ApiProblemException(new ApiProblem(401, ApiProblem::TYPE_INVALID_TOKEN));
        }

        //Validate Data
        $this->validateErrors($path);

        //Token is valid so set the user
        $this->setLoggedInUser($tokenInfo['user_id']);

    }

    public function getLoggedInUser(){
        return $this->user;
    }


    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => 'onKernelRequest'
        );
    }

}
