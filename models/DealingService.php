<?php
/**
 * Created by PhpStorm.
 * User :  keshtgar
 * Date :  6/19/19
 * Time : 12:29 PM
 *
 * $baseInfo BaseInfo
 */

namespace Pod\Dealing\Service;
require __DIR__ . '/../vendor/autoload.php';

use Pod\Base\Service\BaseService;
use Pod\Base\Service\ApiRequestHandler;
use Exception;


class DealingService extends BaseService
{
    private $serverType;
    private static $dealingApi;

    public function __construct($serverType = "Production")
    {
        parent::__construct();
        self::$jsonSchema = json_decode(file_get_contents ('jsonSchema.json'), true);
        $this->serverType = $serverType;
//        $this->header = [
//            "_token_issuer_"    => $this->baseInfo->getTokenIssuer(),
//            "_token_"           => $this->baseInfo->getApiToken(),
//        ];
        self::$dealingApi = require __DIR__ . '/../config/apiConfig.php';
    }

    public function addUserAndBusiness($params) {
        $apiName = 'addUserAndBusiness';
        array_walk_recursive($params, 'self::prepareData');
        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';
        $relativeUri = self::$dealingApi[$apiName]['subUri'];

        // set headers
        $header = [
            "_token_issuer_"    => isset($params["_token_issuer_"]) ? $params["_token_issuer_"] : 1,
            "_token_"           => isset($params["_token_"]) ? $params["_token_"] : "",
        ];
        // unset header value from params
        unset($params["_token_issuer_"]);
        unset($params["_token_"]);

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        $validateResult = self::validateOption($apiName, $option, $paramKey);
        if ($validateResult['validate']) {
            // if we have array type fields httpQuery add index but pod server dont accept it so we should remove index from http query
            if ($paramKey == 'query') {
                $httpQuery = self::buildHttpQuery($params);
                $relativeUri = self::$dealingApi[$apiName]['subUri'] . "?" . $httpQuery;
                unset($option['query']); // unset query because it is added to uri and dont need send again in query params
            }
            return  ApiRequestHandler::Request(
                self::$config[$this->serverType][self::$dealingApi[$apiName]['baseUri']],
                self::$dealingApi[$apiName]['method'],
                $relativeUri,
                $option,
                false
            );

        }
        else {
            throw new Exception($validateResult['errorMessage'], self::VALIDATION_ERROR_CODE);
        }

    }

    public function listUserCreatedBusiness($params) {
        $apiName = 'listUserCreatedBusiness';
        array_walk_recursive($params, 'self::prepareData');
        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';
        $relativeUri = self::$dealingApi[$apiName]['subUri'];

        // set headers
        $header = [
            "_token_issuer_"    => isset($params["_token_issuer_"]) ? $params["_token_issuer_"] : 1,
            "_token_"           => isset($params["_token_"]) ? $params["_token_"] : "",
        ];
        // unset header value from params
        unset($params["_token_issuer_"]);
        unset($params["_token_"]);

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        $validateResult = self::validateOption($apiName, $option, $paramKey);
        if ($validateResult['validate']) {
            // if we have array type fields httpQuery add index but pod server dont accept it so we should remove index from http query
            if ($paramKey == 'query') {
                $httpQuery = self::buildHttpQuery($params);
                $relativeUri = self::$dealingApi[$apiName]['subUri'] . "?" . $httpQuery;
                unset($option['query']); // unset query because it is added to uri and dont need send again in query params
            }
            return  ApiRequestHandler::Request(
                self::$config[$this->serverType][self::$dealingApi[$apiName]['baseUri']],
                self::$dealingApi[$apiName]['method'],
                $relativeUri,
                $option,
                false
            );

        }
        else {
            throw new Exception($validateResult['errorMessage'], self::VALIDATION_ERROR_CODE);
        }

    }

    public function updateBusiness($params) {
        $apiName = 'updateBusiness';
        array_walk_recursive($params, 'self::prepareData');
        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';
        $relativeUri = self::$dealingApi[$apiName]['subUri'];

        // set headers
        $header = [
            "_token_issuer_"    => isset($params["_token_issuer_"]) ? $params["_token_issuer_"] : 1,
            "_token_"           => isset($params["_token_"]) ? $params["_token_"] : "",
        ];
        // unset header value from params
        unset($params["_token_issuer_"]);
        unset($params["_token_"]);

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        $validateResult = self::validateOption($apiName, $option, $paramKey);
        if ($validateResult['validate']) {
            // if we have array type fields httpQuery add index but pod server dont accept it so we should remove index from http query
            if ($paramKey == 'query') {
                $httpQuery = self::buildHttpQuery($params);
                $relativeUri = self::$dealingApi[$apiName]['subUri'] . "?" . $httpQuery;
                unset($option['query']); // unset query because it is added to uri and dont need send again in query params
            }
            return  ApiRequestHandler::Request(
                self::$config[$this->serverType][self::$dealingApi[$apiName]['baseUri']],
                self::$dealingApi[$apiName]['method'],
                $relativeUri,
                $option,
                false
            );
        }
        else {
            throw new Exception($validateResult['errorMessage'], self::VALIDATION_ERROR_CODE);
        }

    }

//    public function subBusinessList($params) {
//        $apiName = 'subBusinessList';
//        array_walk_recursive($params, 'self::prepareData');
//        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';
//
//        $option = [
//            'headers' => $header,
//            $paramKey => $params,
//        ];
//
//        $validateResult = self::validateOption($apiName, $option, $paramKey);
//        if ($validateResult['validate']) {
//            return  ApiRequestHandler::Request(
//                self::$config[$this->serverType][self::$dealingApi[$apiName]['baseUri']],
//                self::$dealingApi[$apiName]['method'],
//                self::$dealingApi[$apiName]['subUri'],
//                $option,
//                false
//            );
//
//        }
//        else {
//            throw new Exception($validateResult['errorMessage'], self::VALIDATION_ERROR_CODE);
//        }
//
//    }

    public function getApiTokenForCreatedBusiness($params) {
        $apiName = 'getApiTokenForCreatedBusiness';
        array_walk_recursive($params, 'self::prepareData');
        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';

        // set headers
        $header = [
            "_token_issuer_"    => isset($params["_token_issuer_"]) ? $params["_token_issuer_"] : 1,
            "_token_"           => isset($params["_token_"]) ? $params["_token_"] : "",
        ];
        // unset header value from params
        unset($params["_token_issuer_"]);
        unset($params["_token_"]);

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        $validateResult = self::validateOption($apiName, $option, $paramKey);
        if ($validateResult['validate']) {
            return  ApiRequestHandler::Request(
                self::$config[$this->serverType][self::$dealingApi[$apiName]['baseUri']],
                self::$dealingApi[$apiName]['method'],
                self::$dealingApi[$apiName]['subUri'],
                $option,
                false
            );

        }
        else {
            throw new Exception($validateResult['errorMessage'], self::VALIDATION_ERROR_CODE);
        }

    }

    public function rateBusiness($params) {
        $apiName = 'rateBusiness';
        array_walk_recursive($params, 'self::prepareData');
        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';

        // set headers
        $header = [
            "_token_issuer_"    => isset($params["_token_issuer_"]) ? $params["_token_issuer_"] : 1,
            "_token_"           => isset($params["_token_"]) ? $params["_token_"] : "",
        ];
        // unset header value from params
        unset($params["_token_issuer_"]);
        unset($params["_token_"]);

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        $validateResult = self::validateOption($apiName, $option, $paramKey);
        if ($validateResult['validate']) {
            return  ApiRequestHandler::Request(
                self::$config[$this->serverType][self::$dealingApi[$apiName]['baseUri']],
                self::$dealingApi[$apiName]['method'],
                self::$dealingApi[$apiName]['subUri'],
                $option,
                false
            );

        }
        else {
            throw new Exception($validateResult['errorMessage'], self::VALIDATION_ERROR_CODE);
        }

    }

    public function commentBusiness($params) {
        $apiName = 'commentBusiness';
        array_walk_recursive($params, 'self::prepareData');
        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';

        // set headers
        $header = [
            "_token_issuer_"    => isset($params["_token_issuer_"]) ? $params["_token_issuer_"] : 1,
            "_token_"           => isset($params["_token_"]) ? $params["_token_"] : "",
        ];
        // unset header value from params
        unset($params["_token_issuer_"]);
        unset($params["_token_"]);

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        $validateResult = self::validateOption($apiName, $option, $paramKey);
        if ($validateResult['validate']) {
            return  ApiRequestHandler::Request(
                self::$config[$this->serverType][self::$dealingApi[$apiName]['baseUri']],
                self::$dealingApi[$apiName]['method'],
                self::$dealingApi[$apiName]['subUri'],
                $option,
                false
            );

        }
        else {
            throw new Exception($validateResult['errorMessage'], self::VALIDATION_ERROR_CODE);
        }

    }

    public function businessFavorite($params) {
        $apiName = 'businessFavorite';
        array_walk_recursive($params, 'self::prepareData');
        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';
        // set headers
        $header = [
            "_token_issuer_"    => isset($params["_token_issuer_"]) ? $params["_token_issuer_"] : 1,
            "_token_"           => isset($params["_token_"]) ? $params["_token_"] : "",
        ];
        // unset header value from params
        unset($params["_token_issuer_"]);
        unset($params["_token_"]);

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        $validateResult = self::validateOption($apiName, $option, $paramKey);
        if ($validateResult['validate']) {
            return  ApiRequestHandler::Request(
                self::$config[$this->serverType][self::$dealingApi[$apiName]['baseUri']],
                self::$dealingApi[$apiName]['method'],
                self::$dealingApi[$apiName]['subUri'],
                $option,
                false
            );

        }
        else {
            throw new Exception($validateResult['errorMessage'], self::VALIDATION_ERROR_CODE);
        }

    }

    public function userBusinessInfos($params) {
        $apiName = 'userBusinessInfos';
        array_walk_recursive($params, 'self::prepareData');
        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';
        $relativeUri = self::$dealingApi[$apiName]['subUri'];
        // set headers
        $header = [
            "_token_issuer_"    => isset($params["_token_issuer_"]) ? $params["_token_issuer_"] : 1,
            "_token_"           => isset($params["_token_"]) ? $params["_token_"] : "",
        ];
        // unset header value from params
        unset($params["_token_issuer_"]);
        unset($params["_token_"]);

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        $validateResult = self::validateOption($apiName, $option, $paramKey);
        if ($validateResult['validate']) {
            // if we have array type fields httpQuery add index but pod server dont accept it so we should remove index from http query
            if ($paramKey == 'query') {
                $httpQuery = self::buildHttpQuery($params);
                $relativeUri = self::$dealingApi[$apiName]['subUri'] . "?" . $httpQuery;
                unset($option['query']); // unset query because it is added to uri and dont need send again in query params
            }

            return  ApiRequestHandler::Request(
                self::$config[$this->serverType][self::$dealingApi[$apiName]['baseUri']],
                self::$dealingApi[$apiName]['method'],
                $relativeUri,
                $option,
                false
            );

        }
        else {
            throw new Exception($validateResult['errorMessage'], self::VALIDATION_ERROR_CODE);
        }

    }

    public function commentBusinessList($params) {
        $apiName = 'commentBusinessList';
        array_walk_recursive($params, 'self::prepareData');
        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';

        // set headers
        $header = [
            "_token_issuer_"    => isset($params["_token_issuer_"]) ? $params["_token_issuer_"] : 1,
            "_token_"           => isset($params["_token_"]) ? $params["_token_"] : "",
        ];
        // unset header value from params
        unset($params["_token_issuer_"]);
        unset($params["_token_"]);

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        $validateResult = self::validateOption($apiName, $option, $paramKey);
        if ($validateResult['validate']) {
            return  ApiRequestHandler::Request(
                self::$config[$this->serverType][self::$dealingApi[$apiName]['baseUri']],
                self::$dealingApi[$apiName]['method'],
                self::$dealingApi[$apiName]['subUri'],
                $option,
                false
            );

        }
        else {
            throw new Exception($validateResult['errorMessage'], self::VALIDATION_ERROR_CODE);
        }

    }

    public function confirmComment($params) {
        $apiName = 'confirmComment';
        array_walk_recursive($params, 'self::prepareData');
        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';

        // set headers
        $header = [
            "_token_issuer_"    => isset($params["_token_issuer_"]) ? $params["_token_issuer_"] : 1,
            "_token_"           => isset($params["_token_"]) ? $params["_token_"] : "",
        ];
        // unset header value from params
        unset($params["_token_issuer_"]);
        unset($params["_token_"]);

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        $validateResult = self::validateOption($apiName, $option, $paramKey);
        if ($validateResult['validate']) {
            return  ApiRequestHandler::Request(
                self::$config[$this->serverType][self::$dealingApi[$apiName]['baseUri']],
                self::$dealingApi[$apiName]['method'],
                self::$dealingApi[$apiName]['subUri'],
                $option,
                false
            );

        }
        else {
            throw new Exception($validateResult['errorMessage'], self::VALIDATION_ERROR_CODE);
        }

    }

}