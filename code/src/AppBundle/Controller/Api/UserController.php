<?php
/**
 * Created by PhpStorm.
 * User: madhu
 * Date: 07/05/17
 * Time: 1:50 PM
 */

namespace AppBundle\Controller\Api;


use AppBundle\Api\ApiProblem;
use AppBundle\Api\ApiProblemException;
use AppBundle\Controller\BaseController;
use AppBundle\Entity\User;
use Doctrine\Common\Annotations\Annotation\IgnoreAnnotation;
use OAuth2\ServerBundle\User\OAuth2UserProvider;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class UserController
 * @package AppBundle\Controller\Api
 */

/**
 * @IgnoreAnnotation("api")
 * @IgnoreAnnotation("apiVersion")
 * @IgnoreAnnotation("apiPermission")
 * @IgnoreAnnotation("apiName")
 * @IgnoreAnnotation("apiGroup")
 * @IgnoreAnnotation("apiHeader")
 * @IgnoreAnnotation("apiHeaderExample")
 * @IgnoreAnnotation("apiParam")
 * @IgnoreAnnotation("apiParamExample")
 * @IgnoreAnnotation("apiSuccess")
 * @IgnoreAnnotation("apiSuccessExample")
 * @IgnoreAnnotation("apiError")
 * @IgnoreAnnotation("apiErrorExample")
 * @IgnoreAnnotation("apiDefine")
 * @IgnoreAnnotation("apiUse")
 * @IgnoreAnnotation("apiDescription")
 */
class UserController extends BaseController
{

    /**
     * @api {post} /api/user/register Register User
     * @apiVersion 0.1.0
     * @apiName PostRegisterUser
     * @apiPermission Anonymous User
     * @apiGroup Authentication
     * @apiHeader (Authorization) {String} Content-Type APPLICATION/TYPE
     *
     * @apiHeaderExample {json} Header-Example:
     *     {
     *       "Content-Type": "application/x-www-form-urlencoded"
     *     }
     *
     * @apiParam {String} name Name of user
     * @apiParam {String} email Email ID of user
     * @apiParam {String} password Password typed by user Limit 1-15
     * @apiParam {String} client_id Client ID
     * @apiParam {String} client_secret Client Secret
     * @apiUse PARAM_scope
     *
     * @apiParamExample {json} Request-Example:
     *      {
     *         "name" : "Madhu",
     *         "email": "madhu123@email.com",
     *         "password": "password",
     *         "client_id": 818e9c2b0cf02127e06bc4ccb90ac8d2,
     *         "client_secret": 3iglb7pjwcmcow40k8cs0k8sc4c4w08,
     *          "scope": "public read:user write:user read:portfolio write:portfolio read:affiliate write:affiliate offline notifications"
     *      }
     *
     * @apiSuccess {Integer} id id of the user
     * @apiSuccess {String} name Name of user
     * @apiSuccess {String} email Email ID
     * @apiSuccess {String} given_name Given Name
     * @apiSuccess {String} family_name Family Name
     * @apiSuccess {String} picture Picture
     * @apiSuccess {String} locale Locale
     * @apiSuccess {String} register_date Timestamp
     * @apiSuccess {String} country_iso ISO
     * @apiSuccess {String} token Access Token details
     *
     *
     * @apiUse SUCCESS_EXAMPLE_register
     *
     *
     * @apiError {String} status Statuscode
     * @apiError {String} type Type of Error
     * @apiError {String} title Title of Error
     * @apiError {String} detail Error details
     *
     * @apiUse ERROR_EXAMPLE_validation
     *
     * @apiDescription Register User
     *
     */

    /**
     *
     * @Route("/api/user/register", name="user_register")
     * @Method("POST")
     */
    public function registerAction(Request $request){


        $dataArray = $request->request->all();

        //Check if user exists else throw Exception
        $userExists = $this->getUserRepository()->findUserByEmail($dataArray['email']);

        if($userExists)
        {
            $apiProblem = new ApiProblem(409,'conflicted_resource');
            throw new ApiProblemException($apiProblem);
        }

        $manager = $this->getDoctrine()->getManager();
        $encodeFactory = $this->get('security.encoder_factory');

        //Create OAuth user with BShaffer bundle code reuse. Inject Dependencies
        $oauthUserProvider = new OAuth2UserProvider($manager, $encodeFactory);
        $oauthUserProvider->createUser($dataArray['email'], $dataArray['password'], array(), explode(" ", $dataArray['scope']));

        //Validating user after creation is left blank to keep it simple and quickly generate protoype.
        //In production it is mandatory

        $server = $this->get('oauth2.server');
        $server->addGrantType($this->get('oauth2.grant_type.user_credentials'));

        $oauthRequest = $this->get('oauth2.request');
        $oauthRequest->request->set('password', $dataArray['password']);
        $oauthRequest->request->set('username', $dataArray['email']);
        $oauthRequest->request->set('grant_type', 'password');

        $oauthResponse = $this->get('oauth2.response');

        $server->handleTokenRequest($oauthRequest, $oauthResponse);

        //Get token for the created user
        $token = json_decode($oauthResponse->getContent(), true);

        if(isset($token['error']))
        {
            $apiProblem = new ApiProblem(400, ApiProblem::TYPE_INVALID_REQUEST);
            throw new ApiProblemException($apiProblem);
        }

        //Create the user and send his/her data back with 201 status code
        $user = new User();
        $user->setName($dataArray['name']);
        $user->setEmail($dataArray['email']);
        $user->setGivenName($dataArray['name']);
        $manager->persist($user);
        $manager->flush();

        $userDetails = $this->getUserRepository()->findUserByEmail($dataArray['email']);

        return $this->createApiResponse($userDetails, 201, array('token' => $token));

    }




}