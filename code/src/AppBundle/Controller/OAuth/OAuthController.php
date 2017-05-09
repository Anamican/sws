<?php
/**
 * Created by PhpStorm.
 * User: madhu
 * Date: 07/05/17
 * Time: 11:00 AM
 */

namespace AppBundle\Controller\OAuth;


use AppBundle\Api\ApiProblem;
use AppBundle\Api\ApiProblemException;
use AppBundle\Controller\BaseController;
use Doctrine\Common\Annotations\Annotation\IgnoreAnnotation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Class OAuthController
 * @package AppBundle\Controller\OAuth
 */

/**
 *
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
class OAuthController extends BaseController
{

    /**
     * @api {post} /oauth/token User credentials token grant
     * @apiVersion 0.1.0
     * @apiName PostUserCredentials
     * @apiPermission Anonymous User
     * @apiGroup Authentication
     * @apiHeader (Authorization) {String} Content-Type APPLICATION/TYPE
     *
     * @apiHeaderExample {json} Header-Example:
     *     {
     *       "Content-Type": "application/x-www-form-urlencoded"
     *     }
     *
     * @apiParam {String} username Username - Email ID of user
     * @apiParam {String} password Password typed by user Limit 1-15
     * @apiParam {String} client_id Client ID
     * @apiParam {String} client_secret Client Secret
     * @apiUse PARAM_grant_type_password
     * @apiUse PARAM_scope
     *
     * @apiParamExample {json} Request-Example:
     *      {
     *         "username": "madhu123@email.com",
     *         "password": "password",
     *         "client_id": 818e9c2b0cf02127e06bc4ccb90ac8d2,
     *         "client_secret": 3iglb7pjwcmcow40k8cs0k8sc4c4w08,
     *          "scope": "public read:user write:user read:portfolio write:portfolio read:affiliate write:affiliate offline notifications"
     *      }
     *
     * @apiSuccess {String} access_token Token to be used in Authorization header
     * @apiSuccess {Integer} expires_in Seconds until token expires
     * @apiSuccess {String} token_type Type of this token
     * @apiSuccess {String} scope Scope access for this token
     * @apiSuccess {String} refresh_token Refresh token
     *
     * @apiUse SUCCESS_EXAMPLE_token
     *
     *
     * @apiError {String} status Statuscode
     * @apiError {String} type Type of Error
     * @apiError {String} title Title of Error
     * @apiError {String} detail Error details
     *
     * @apiUse ERROR_EXAMPLE_oauth
     *
     * @apiDescription User Credentials token grant
     */

    /**
     *
     * @Route("/oauth/token", name="oauth_token")
     * @Method("POST")
     */
    public function tokenAction()
    {
        $server = $this->get('oauth2.server');
        $server->addGrantType($this->get('oauth2.grant_type.user_credentials'));
        $server->addGrantType($this->get('oauth2.grant_type.refresh_token'));
        return $server->handleTokenRequest($this->get('oauth2.request'), $this->get('oauth2.response'));
    }



    /**
     * @api {post} /oauth/token Refresh Token
     * @apiVersion 0.1.0
     * @apiName PostRefreshToken
     * @apiPermission Anonymous User
     * @apiGroup Authentication
     * @apiHeader (Authorization) {String} Content-Type APPLICATION/TYPE
     *
     * @apiHeaderExample {json} Header-Example:
     *     {
     *       "Content-Type": "application/x-www-form-urlencoded"
     *     }
     *
     * @apiParam {String} username Username - Email ID of user
     * @apiParam {String} password Password typed by user Limit 1-15
     * @apiParam {String} client_id Client ID
     * @apiParam {String} client_secret Client Secret
     * @apiUse PARAM_grant_type_refresh
     * @apiUse PARAM_scope
     *
     * @apiParamExample {json} Request-Example:
     *      {
     *         "username": "madhu123@email.com",
     *         "password": "password",
     *         "client_id": 818e9c2b0cf02127e06bc4ccb90ac8d2,
     *         "client_secret": 3iglb7pjwcmcow40k8cs0k8sc4c4w08,
     *         "grant_type" : "refresh_token",
     *          "scope": "public read:user write:user read:portfolio write:portfolio read:affiliate write:affiliate offline notifications"
     *      }
     *
     * @apiSuccess {String} access_token Token to be used in Authorization header
     * @apiSuccess {Integer} expires_in Seconds until token expires
     * @apiSuccess {String} token_type Type of this token
     * @apiSuccess {String} scope Scope access for this token
     * @apiSuccess {String} refresh_token Refresh token
     *
     * @apiUse SUCCESS_EXAMPLE_token
     *
     *
     * @apiError {String} status Statuscode
     * @apiError {String} type Type of Error
     * @apiError {String} title Title of Error
     * @apiError {String} detail Error details
     *
     * @apiUse ERROR_EXAMPLE_oauth
     *
     * @apiDescription Refresh Token
     */
    public function refreshTokenAction(){
        /**
         *
         * CREATED ONLY FOR DOCUMENTATION
         *
         */
    }



    /**
     * @api {post} /oauth/token/info Token Info
     * @apiVersion 0.1.0
     * @apiName PostTokenInfo
     * @apiPermission Anonymous User
     * @apiGroup Authentication
     * @apiHeader (Authorization) {String} Content-Type APPLICATION/TYPE
     * @apiHeader (Authorization) {String} Authorization Bearer TOKEN
     *
     * @apiUse HEADER_EXAMPLE_bearer
     *
     * @apiSuccess {Integer} user_id User ID
     * @apiSuccess {Integer} expires Expiry Seconds
     * @apiSuccess {String} scope Scope access for this token
     * @apiSuccess {String} token Token given
     *
     * @apiUse SUCCESS_EXAMPLE_info
     *
     *
     * @apiError {String} status Statuscode
     * @apiError {String} type Type of Error
     * @apiError {String} title Title of Error
     * @apiError {String} detail Error details
     *
     * @apiUse ERROR_EXAMPLE_oauth
     *
     * @apiDescription Token INFO
     */

    /**
     *
     * @Route("/oauth/token/info", name="oauth_token_info")
     * @Method("POST")
     */
    public function tokenInfoAction()
    {
        $server = $this->get('oauth2.server');

        $tokenInfo = $server->getAccessTokenData($this->get('oauth2.request'), $this->get('oauth2.response'));

        if(!$tokenInfo)
        {
            throw new ApiProblemException((new ApiProblem(401,'invalid_token')));
        }

        $bearer = $this->get('oauth2.request')->headers('Authorization');
        $token = str_replace('Bearer ','',$bearer);

        unset($tokenInfo['client_id']);
        $tokenInfo['token'] = $token;

        return new JsonResponse($tokenInfo, 200);
    }

}