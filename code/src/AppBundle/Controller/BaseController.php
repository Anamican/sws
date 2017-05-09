<?php

namespace AppBundle\Controller;

use AppBundle\Repository\ProgrammerRepository;
use AppBundle\Repository\UserRepository;
use AppBundle\Repository\ApiTokenRepository;
use JMS\Serializer\SerializationContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

abstract class BaseController extends Controller
{

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    protected function getCompanyRepository(){
        return $this->getDoctrine()->getRepository('AppBundle:Company');
    }


    /**
     * @return UserRepository
     */
    protected function getUserRepository()
    {
        return $this->getDoctrine()->getRepository('AppBundle:User');
    }

    /**
     * @return \AppBundle\Repository\BlacklistRepository|\Doctrine\Common\Persistence\ObjectRepository
     */
    protected function getBlacklistRepository()
    {
        return $this->getDoctrine()->getRepository('AppBundle:Blacklist');
    }


    /**
     * @return \AppBundle\Repository\PortfolioRepository|\Doctrine\Common\Persistence\ObjectRepository
     */
    protected function getPortfolioRepository()
    {
        return $this->getDoctrine()->getRepository('AppBundle:Portfolio');
    }


    protected function getDoctrineManager()
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * @param $data
     * @param int $statusCode
     * @param array $extraData
     * @return Response
     */
    protected function createApiResponse($data, $statusCode = 200, $extraData = array(), $extraHeaders = array())
    {
        if(!empty($data)) {
            $json = $this->serialize($data);
            $dataArray = json_decode($json, true);
            $dataArray = array(
                'data' => array_merge($dataArray, $extraData)
            );
            $json = json_encode($dataArray);
        }else{
            $json = null;
        }

        $contentTypeHeader = array(
            'Content-Type' => 'application/json'
        );

        $headers = !empty($extraHeaders)? array_merge($contentTypeHeader, $extraHeaders): $contentTypeHeader;
        return new Response($json, $statusCode, $headers);
    }

    /**
     *
     * @param $data
     * @param string $format
     * @return mixed|string
     */
    protected function serialize($data, $format = 'json')
    {
        $context = new SerializationContext();
        $context->setSerializeNull(true);

        return $this->container->get('jms_serializer')
            ->serialize($data, $format, $context);
    }

    /**
     * Dump function for Development
     *
     * @param $dataArray
     */
    protected function dieArray($dataArray){

        echo "<pre>";

        if(is_array($dataArray)){
            print_r($dataArray);
        }else{
            var_dump($dataArray);
        }

        die;

    }


}
