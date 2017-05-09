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
use AppBundle\Entity\Portfolio;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Annotations\Annotation\IgnoreAnnotation;


/**
 * Class PortfolioController
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
class PortfolioController extends BaseController
{


    /**
     * @api {post} /api/user/portfolio Create Portfolio
     * @apiVersion 0.1.0
     * @apiName PostPortfolio
     * @apiPermission Authenticated User
     * @apiGroup Portfolio
     * @apiHeader (Header) {String} Content-Type APPLICATION/TYPE
     * @apiHeader (Header) {String} Authorization Bearer TOKEN
     *
     * @apiUse HEADER_EXAMPLE_bearer
     *
     * @apiParam {String} name Name of portfolio
     * @apiParam {String} currency_iso Currency ISO like AUD, USD
     * @apiParam {Integer} sharing Sharing set to true or not
     *
     * @apiParamExample {json} Request-Example:
     *      {
     *          "name": "some name",
     *          "currency_iso": "USD",
     *          "sharing": 1
     *      }
     *
     *
     * @apiSuccess {Integer} id Internal ID
     * @apiSuccess {String} name Name of company
     * @apiSuccess {String} currency_iso Currency ISO like AUD, USD
     * @apiSuccess {Boolean} sharing Sharing set to true or not
     *
     * @apiUse SUCCESS_EXAMPLE_post_portfolio
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
     * @Route("/api/user/portfolio")
     * @Method("POST")
     */
    public function createPortfolio(Request $request){

        $data = $request->request->all();


        //Check if exists
        $this->throwExceptionIfPortfolioExists($data['name']);

        $user = $this->get('api_request_subscriber')->getLoggedInUser();

        $portfolio = new Portfolio();
        $portfolio->setUser($user);
        $portfolio->setName($data['name']);
        $portfolio->setCurrencyIso($data['currency_iso']);
        $sharing = $data['sharing'] == 1?true:false;
        $portfolio->setSharing($sharing);

        $em = $this->getDoctrineManager();
        $em->persist($portfolio);
        $em->flush();

        return $this->createApiResponse($portfolio, 201);
    }

    /**
     * @api {delete} /api/user/portfolio/:id Delete Portfolio
     * @apiVersion 0.1.0
     * @apiName DeletePortfolio
     * @apiPermission Authenticated User
     * @apiGroup Portfolio
     * @apiHeader (Header) {String} Content-Type APPLICATION/TYPE
     * @apiHeader (Header) {String} Authorization Bearer TOKEN
     *
     * @apiUse HEADER_EXAMPLE_bearer
     *
     * @apiParam {Integer} id ID of portfolio
     *
     * @apiParamExample {json} Request-Example:
     *      {
     *          "id": 1
     *      }
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
     * @apiUse ERROR_EXAMPLE_validation
     * @apiUse ERROR_EXAMPLE_not_found
     *
     * @apiDescription Delete Portfolio
     */


    /**
     *
     * @Route("/api/user/portfolio/{id}")
     * @Method("DELETE")
     */
    public function deletePortfolio($id){

        //Check if exists
        $this->throwExceptionIfNotFound($id);

        //Exists so delete it
        $user = $this->get('api_request_subscriber')->getLoggedInUser();
        $this->getPortfolioRepository()->deletePortfolioByID($user, $id);

        return $this->createApiResponse('', 204);
    }


    /**
     * @api {get} /api/user/portfolio/:id Read Portfolio
     * @apiVersion 0.1.0
     * @apiName GetPortfolio
     * @apiPermission Authenticated User
     * @apiGroup Portfolio
     * @apiHeader (Header) {String} Content-Type APPLICATION/TYPE
     * @apiHeader (Header) {String} Authorization Bearer TOKEN
     *
     * @apiUse HEADER_EXAMPLE_bearer
     *
     * @apiParam {Integer} id ID of portfolio
     *
     * @apiParamExample {json} Request-Example:
     *      {
     *          "id": 3
     *      }
     *
     *
     * @apiSuccess {Integer} id Internal ID
     * @apiSuccess {String} name Name of company
     * @apiSuccess {String} currency_iso Currency ISO like AUD, USD
     * @apiSuccess {Boolean} sharing Sharing set to true or not
     *
     * @apiUse SUCCESS_EXAMPLE_get_portfolio
     *
     * @apiError {String} status Statuscode
     * @apiError {String} type Type of Error
     * @apiError {String} title Title of Error
     * @apiError {String} detail Error details
     *
     * @apiUse ERROR_EXAMPLE_oauth
     * @apiUse ERROR_EXAMPLE_validation
     * @apiUse ERROR_EXAMPLE_not_found
     *
     * @apiDescription Read Portfolio
     */
    /**
     * @Route("/api/user/portfolio/{id}")
     * @Method("GET")
     */
    public function readPortfolio($id){

        //Check if exists else throw exception
        $portfolio = $this->throwExceptionIfNotFound($id);
        return $this->createApiResponse($portfolio, 200);
    }


    /**
     * @api {patch} /api/user/portfolio/:id Update Portfolio
     * @apiVersion 0.1.0
     * @apiName PatchPortfolio
     * @apiPermission Authenticated User
     * @apiGroup Portfolio
     * @apiHeader (Header) {String} Content-Type APPLICATION/TYPE
     * @apiHeader (Header) {String} Authorization Bearer TOKEN
     *
     * @apiUse HEADER_EXAMPLE_bearer
     *
     * @apiParam {Integer} id ID of portfolio
     *
     * @apiParamExample {json} Request-Example:
     *      {
     *          "id": 3,
     *          "name": "My Portfolio",
     *          "currency_iso": "AUD",
     *          "sharing": 1
     *      }
     *
     *
     * @apiSuccess {Integer} id Internal ID
     * @apiSuccess {String} [name] Name of company
     * @apiSuccess {String} [currency_iso] Currency ISO like AUD, USD
     * @apiSuccess {Boolean} [sharing] Sharing set to true or not
     *
     * @apiUse SUCCESS_EXAMPLE_get_portfolio
     *
     * @apiError {String} status Statuscode
     * @apiError {String} type Type of Error
     * @apiError {String} title Title of Error
     * @apiError {String} detail Error details
     *
     * @apiUse ERROR_EXAMPLE_oauth
     * @apiUse ERROR_EXAMPLE_validation
     * @apiUse ERROR_EXAMPLE_not_found
     *
     * @apiDescription Update Portfolio
     */

    /**
     *
     * @Route("/api/user/portfolio/{id}")
     * @Method("PATCH")
     */
    public function updatePortfolio($id, Request $request){

        //Check if exists else throw exception
        $portfolio = $this->throwExceptionIfNotFound($id);

        $data = $request->request->all();

        $em = $this->getDoctrineManager();
        $columnNames = $em->getClassMetadata(get_class($portfolio))->getColumnNames();

        $PATCH_REQUIRED = false;
        foreach ($data as $key => $datum) {
            if(in_array($key, $columnNames)){
                $datum = $this->checkSpecialConditions($key, $datum);
                $setter = $this->getSetter($key);
                $portfolio->$setter($datum);
                $PATCH_REQUIRED = true;
            }
        }
        if($PATCH_REQUIRED){
            $em->persist($portfolio);
            $em->flush();
        }

        return $this->createApiResponse($portfolio, 200);
    }

    private function checkSpecialConditions($key, $datum){

        if($key == 'name'){
            $this->throwExceptionIfPortfolioExists($datum);
        }

        if($key == 'sharing'){
            $datum = $datum == 1? true: false;
        }

        return $datum;
    }


    private function getSetter($name){

        if(strpos($name, "_")){

            $exploded = explode("_", $name);
            foreach ($exploded as &$item) {
                $item = ucfirst($item);
            }
            return "set".implode("", $exploded);

        }else{
            return "set".ucfirst($name);
        }


    }

    private function throwExceptionIfNotFound($id){

        $details = $this->getPortfolioRepository()->findByID($id);
        if(empty($details)){
            throw  new ApiProblemException(new ApiProblem(404, ApiProblem::TYPE_NOT_FOUND));
        }
        return $details;

    }

    private function throwExceptionIfPortfolioExists($name){
        $details = $this->getPortfolioRepository()->findByName($name);
        if(!empty($details)){
            throw  new ApiProblemException(new ApiProblem(409, ApiProblem::TYPE_CONFLICTED_RESOURCE));
        }
        return 1;
    }

}