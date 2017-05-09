<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @apiDefine HEADER_EXAMPLE_bearer
 * @apiHeaderExample {json} Header-Example:
 *     {
 *       "Content-Type": "application/x-www-form-urlencoded",
 *       "Authorization": "Bearer e9c2b0cf02127e06bc4ccb90ac8d2"
 *     }
 *
 */


/**
 * @apiDefine ERROR_EXAMPLE_oauth
 * @apiErrorExample {json} Error-InvalidToken:
 *     HTTP/1.1 401 Unauthorized
 *     {
 *       "errors": {
 *         "status": 401,
 *         "type": "invalid_token",
 *         "title": "Invalid Access Token",
 *         "detail": "The access token provided is invalid"
 *       }
 *     }
 */


/**
 * @apiDefine ERROR_EXAMPLE_validation
 * @apiErrorExample {json} Error-Validation:
 *     HTTP/1.1 422 Unprocessable Entity
 *     {
 *       "errors": {
 *         "status": 422,
 *         "type": "validation_error",
 *         "title": "There was a validation error",
 *         "detail": "Please check the fields: FIELD1,FIELD2 etc.."
 *       }
 *     }
 */

/**
 * @apiDefine ERROR_EXAMPLE_conflict
 * @apiErrorExample {json} Error-Conflict:
 *     HTTP/1.1 409 Conflict
 *     {
 *       "errors": {
 *         "status": 409,
 *         "type": "conflicted_resource",
 *         "title": "Conflict in Resource",
 *         "detail": "Resource already exists"
 *       }
 *     }
 */


/**
 * @apiDefine ERROR_EXAMPLE_not_found
 * @apiErrorExample {json} Error-NotFound:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "errors": {
 *         "status": 404,
 *         "type": "not_found",
 *         "title": "Resource does not exists",
 *         "detail": "Resource requested could not be found or is unavailable"
 *       }
 *     }
 */


/**
 *
 * @apiDefine PARAM_grant_type_password
 * @apiParam {String} grant_type <p>Grant type for this token request</p><p>Allowed values:<code>"password"</code></p>
 *
 */

/**
 *
 * @apiDefine PARAM_grant_type_refresh
 * @apiParam {String} grant_type <p>Grant type for this token request</p><p>Allowed values:<code>"refresh_token"</code></p>
 *
 */

/**
 *
 * @apiDefine PARAM_scope
 * @apiParam {String} scope <p>Requested scopes, delimited by spaces</p><p class="type-size">Allowed values: <code>"public"</code>, <code>"read:user"</code>, <code>"write:user"</code>, <code>"read:portfolio"</code>, <code>"write:portfolio"</code>, <code>"read:affiliate"</code>, <code>"write:affiliate"</code>, <code>"offline"</code>, <code>"notifications"</code> </p>
 *
 */



/**
 *
 * @apiDefine SUCCESS_EXAMPLE_token
 *
 * @apiSuccessExample {json} Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *        "access_token": "a68a11130b5532a27f5adea44ab6b4752ab2ca6d",
 *        "expires_in": 3600,
 *        "token_type": "Bearer",
 *        "scope": "read:portfolio write:portfolio public write:user read:user",
 *        "refresh_token": "1708cac911b413d40bfd51c24aa6bf91449f16c8"
 *      }
 *
 */

/**
 * @apiDefine SUCCESS_EXAMPLE_info
 *
 * @apiSuccessExample {json} Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "user_id": "madhukumarit23@gmail.com",
 *          "expires": 1494315376,
 *          "scope": "public read:user write:user read:portfolio write:portfolio read:affiliate write:affiliate offline notifications",
 *          "token": "8476bf46d0b8482490b86056252bfdaca0f4bcfb"
 *      }
 */

/**
 * @apiDefine SUCCESS_EXAMPLE_blacklist_post
 *
 * @apiSuccessExample {json} SuccessData-Response:
 *      HTTP/1.1 201 Created
 *      {
 *          "data": {
 *          "id": 6,
 *          "unique_symbol": "ABC:MOF"
 *        }
 *      }
 */

/**
 * @apiDefine SUCCESS_EXAMPLE_blacklist_get
 *
 * @apiSuccessExample {json} SuccessData-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "data": {
 *          "id": 6,
 *          "unique_symbol": "ABC:MOF"
 *        }
 *      }
 */

/**
 * @apiDefine SUCCESS_EXAMPLE_company
 *
 * @apiSuccessExample {json} SuccessData-Response:
 *      HTTP/1.1 200 OK
 *      {
 *        "data": {
 *          "id": 22751,
 *          "name": "Roper Technologies",
 *          "slug": "roper-technologies",
 *          "trading_item_id": 2643691,
 *          "unique_symbol": "NYSE:ROP",
 *          "exchange_symbol": "NYSE",
 *          "ticker_symbol": "ROP",
 *          "primary_ticker": "1",
 *          "last_updated": 1497123489
 *        }
 *      }
 */


/**
 * @apiDefine SUCCESS_EXAMPLE_post_portfolio
 *
 * @apiSuccessExample {json} SuccessData-Response:
 *      HTTP/1.1 201 Created
 *      {
 *        "data": {
 *          "id": 3,
 *          "name": "some name",
 *          "currency_iso": "USD",
 *          "sharing": true
 *        }
 *      }
 */


/**
 * @apiDefine SUCCESS_EXAMPLE_get_portfolio
 *
 * @apiSuccessExample {json} SuccessData-Response:
 *      HTTP/1.1 200 OK
 *      {
 *        "data": {
 *          "id": 3,
 *          "name": "some name",
 *          "currency_iso": "USD",
 *          "sharing": true
 *        }
 *      }
 */

/**
 * @apiDefine SUCCESS_EXAMPLE_delete
 *
 * @apiSuccessExample {json} NoContent-Response:
 *      HTTP/1.1 204 No Content
 */


/**
 *
 * @apiDefine SUCCESS_EXAMPLE_register
 *
 * @apiSuccessExample {json} Success-Response:
 *      HTTP/1.1 201 Created
 *      {
 *        "data": {
 *          "id": 3,
 *          "name": "Madhu",
 *          "email": "madhu@email.com",
 *          "given_name": "Madhu",
 *          "family_name": null,
 *          "picture": null,
 *          "locale": null,
 *          "register_date": null,
 *          "country_iso": null,
 *          "token": {
 *            "access_token": "0ecf4a498c3a4cc264ce2e42e8114c8ebe2d7077",
 *            "expires_in": 3600,
 *            "token_type": "Bearer",
 *            "scope": "public read:user write:user read:portfolio write:portfolio read:affiliate write:affiliate offline notifications",
 *            "refresh_token": "78f3e2216d5ec76efcf59e26da0f81b38ff3e65e"
 *          }
 *        }
 *      }
 *
 */