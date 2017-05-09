<?php
/**
 * Created by PhpStorm.
 * User: madhu
 * Date: 04/05/17
 * Time: 1:51 PM
 */

namespace AppBundle\Controller\Api;

use AppBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\Common\Annotations\Annotation\IgnoreAnnotation;


/**
 * Class CompanyController
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
class CompanyController extends BaseController
{

    /**
     * @api {get} /api/company/:uniqueSymbol Get Company
     * @apiVersion 0.1.0
     * @apiName GetCompany
     * @apiPermission Authenticated User
     * @apiGroup Company
     * @apiHeader (Header) {String} Content-Type APPLICATION/TYPE
     * @apiHeader (Header) {String} Authorization Bearer TOKEN
     *
     * @apiUse HEADER_EXAMPLE_bearer
     *
     * @apiParam {String} unique_symbol Unique Symbol of company
     *
     * @apiParamExample {json} Request-Example:
     *      {
     *          "unique_symbol": "ABC:CDF"
     *      }
     *
     *
     * @apiSuccess {Integer} id Internal ID
     * @apiSuccess {String} name Name of Company
     * @apiSuccess {String} slug Slug of Company
     * @apiSuccess {Integer} trading_item_id Trading item of Company
     * @apiSuccess {String} unique_symbol Unique Symbol of Company
     * @apiSuccess {String} exchange_symbol Exchange symbol of Company
     * @apiSuccess {String} ticker_symbol Ticker Symbol of Company
     * @apiSuccess {String} primary_ticker Boolean
     * @apiSuccess {Integer} last_updated Timestamp
     *
     * @apiUse SUCCESS_EXAMPLE_company
     *
     * @apiError {String} status Statuscode
     * @apiError {String} type Type of Error
     * @apiError {String} title Title of Error
     * @apiError {String} detail Error details
     *
     * @apiUse ERROR_EXAMPLE_oauth
     * @apiUse ERROR_EXAMPLE_validation
     *
     * @apiDescription Create Blacklist entry
     */

    /**
     * @Route("/api/company/{uniqueSymbol}")
     * @Method("GET")
     *
     */
    public function getCompanyAction($uniqueSymbol){

        $company = $this->getCompanyRepository()->findOneByUniqueSymbol($uniqueSymbol);

        if(!$company) {
            throw $this->createNotFoundException();
        }

        return $this->createApiResponse($company, 200);
    }






}