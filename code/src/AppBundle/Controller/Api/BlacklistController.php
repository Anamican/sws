<?php
/**
 * Created by PhpStorm.
 * User: madhu
 * Date: 09/05/17
 * Time: 6:54 AM
 */

namespace AppBundle\Controller\Api;

use AppBundle\Api\ApiProblem;
use AppBundle\Api\ApiProblemException;
use AppBundle\Controller\BaseController;
use AppBundle\Entity\Blacklist;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Annotations\Annotation\IgnoreAnnotation;

/**
 * Class BlacklistController
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
class BlacklistController extends BaseController
{

    /**
     * @api {post} /api/user/company/blacklist Create Blacklist
     * @apiVersion 0.1.0
     * @apiName PostBlackList
     * @apiPermission Authenticated User
     * @apiGroup Blacklist
     * @apiHeader (Header) {String} Content-Type APPLICATION/TYPE
     * @apiHeader (Header) {String} Authorization Bearer TOKEN
     *
     * @apiUse HEADER_EXAMPLE_bearer
     *
     * @apiParam {String} [bulk] Bulk JSON unique_symbols
     * @apiParam {String} [unique_symbol] Unique Symbol
     *
     * @apiParamExample {json} Request-Example:
     *      {
     *          "unique_symbol": "ABC:CDF"
     *      }
     *
     * @apiParamExample {json} Bulk-Example:
     *    [
     *      {
     *          "unique_symbol": "ABC:CEG"
     *      },
     *      {
     *          "unique_symbol": "ABC:CDF"
     *      }
     *    ]
     *
     * @apiSuccess {Integer} id Internal ID
     * @apiSuccess {String} unique_symbol Unique Symbol of company
     *
     * @apiUse SUCCESS_EXAMPLE_blacklist_post
     *
     * @apiError {String} status Statuscode
     * @apiError {String} type Type of Error
     * @apiError {String} title Title of Error
     * @apiError {String} detail Error details
     *
     * @apiUse ERROR_EXAMPLE_oauth
     * @apiUse ERROR_EXAMPLE_validation
     * @apiUse ERROR_EXAMPLE_conflict
     *
     * @apiDescription Create Blacklist entry
     */

    /**
     * @Route("/api/user/company/blacklist", name="company_blacklist_create")
     * @Method("POST")
     */
    public function createBlackList(Request $request){

        $data = json_decode($request->getContent(), true);

        //Check if content-type is json
        $this->throwExceptionIfRequestIsNotJson($data);

        $user = $this->get('api_request_subscriber')->getLoggedInUser();

        if(!empty($data['bulk'])){

            $symbolsArray = array_column($data['bulk'], 'unique_symbol');

            //Check if they don't exist
            $this->throwExceptionIfSymbolExists($symbolsArray, $user);

            //Not present so add it
            $batchSize = 10;
            $returnData = array();
            $em = $this->getDoctrineManager();
            for ($i = 0; $i < count($symbolsArray); $i++) {
                $blackList = new Blacklist();
                $blackList->setUniqueSymbol($symbolsArray[$i]);
                $blackList->setUser($user);
                $em->persist($blackList);
                $returnData[] = $blackList;
                if (($i % $batchSize) === 0) {
                    $em->flush();
                }
            }
            $em->flush(); //Persist objects that did not make up an entire batch

        }else if(!empty($data['unique_symbol'])){

            //Check if they don't exist
            $this->throwExceptionIfSymbolExists(array($data['unique_symbol']), $user);

            $em = $this->getDoctrineManager();
            $blackList = new Blacklist();
            $blackList->setUniqueSymbol($data['unique_symbol']);
            $blackList->setUser($user);
            $em->persist($blackList);
            $em->flush();

            $returnData = $blackList;

        }else{
            $detail = "Request Params cannot be empty";
            $apiProblem = new ApiProblem(400, ApiProblem::TYPE_VALIDATION_ERROR, $detail);
            throw  new ApiProblemException($apiProblem);
        }

        return $this->createApiResponse($returnData, 201);
    }



    /**
     * @api {delete} /api/user/company/blacklist Purge Blacklist
     * @apiVersion 0.1.0
     * @apiName DeleteBlackList
     * @apiPermission Authenticated User
     * @apiGroup Blacklist
     * @apiHeader (Header) {String} Content-Type APPLICATION/TYPE
     * @apiHeader (Header) {String} Authorization Bearer TOKEN
     *
     * @apiUse HEADER_EXAMPLE_bearer
     *
     *
     * @apiUse SUCCESS_EXAMPLE_delete
     *
     * @apiError {String} status Statuscode
     * @apiError {String} type Type of Error
     * @apiError {String} title Title of Error
     * @apiError {String} detail Error details
     *
     * @apiUse ERROR_EXAMPLE_oauth
     *
     * @apiDescription Delete all blacklist entries
     */


    /**
     *
     * @Route("/api/user/company/blacklist")
     * @Method("DELETE")
     *
     */
    public function purgeBlacklist(){

        $user = $this->get('api_request_subscriber')->getLoggedInUser();
        $this->getBlacklistRepository()->purgeBlackList($user);
        return $this->createApiResponse('', 204);

    }


    /**
     * @api {get} /api/user/company/blacklist Get Blacklist
     * @apiVersion 0.1.0
     * @apiName GetBlackList
     * @apiPermission Authenticated User
     * @apiGroup Blacklist
     * @apiHeader (Header) {String} Content-Type APPLICATION/TYPE
     * @apiHeader (Header) {String} Authorization Bearer TOKEN
     *
     * @apiUse HEADER_EXAMPLE_bearer
     *
     *
     * @apiSuccess {Integer} id Internal ID
     * @apiSuccess {String} unique_symbol Unique Symbol of company
     *
     * @apiUse SUCCESS_EXAMPLE_blacklist_get
     * @apiUse SUCCESS_EXAMPLE_delete
     *
     * @apiError {String} status Statuscode
     * @apiError {String} type Type of Error
     * @apiError {String} title Title of Error
     * @apiError {String} detail Error details
     *
     * @apiUse ERROR_EXAMPLE_oauth
     *
     * @apiDescription Read Blacklist entry
     */

    /**
     * @Route("/api/user/company/blacklist")
     * @Method("GET")
     */
    public function readBlacklist(){

        $user = $this->get('api_request_subscriber')->getLoggedInUser();
        $returnData = $this->getBlacklistRepository()->findAllByUser($user);

        if(empty($returnData)){
            return $this->createApiResponse('', 204);
        }

        return $this->createApiResponse($returnData, 200);

    }


    private function throwExceptionIfRequestIsNotJson($data){

        if($data == null){
            $detail = "Content-Type should be JSON";
            throw  new ApiProblemException(new ApiProblem(400, ApiProblem::TYPE_INVALID_REQUEST, $detail));
        }

    }

    private function throwExceptionIfSymbolExists($symbolsArray, $user){

        $details = $this->getBlacklistRepository()->getDetailsOfSymbols($symbolsArray, $user);
        if(!empty($details)){
            throw  new ApiProblemException(new ApiProblem(409, ApiProblem::TYPE_CONFLICTED_RESOURCE));
        }
        return 1;
    }

}