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

class DealingService extends BaseService
{
    private static $dealingApi;

    public function __construct()
    {
        parent::__construct();
        self::$jsonSchema = json_decode(file_get_contents(__DIR__. '/../jsonSchema.json'), true);
        self::$dealingApi = require __DIR__ . '/../config/apiConfig.php';
    }

    public function addUserAndBusiness($params) {
        $apiName = 'addUserAndBusiness';
        array_walk_recursive($params, 'self::prepareData');
        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';
        $relativeUri = self::$dealingApi[$apiName]['subUri'];

        // set headers
        $header = [
            '_token_issuer_'    => isset($params['_token_issuer_']) ? $params['_token_issuer_'] : 1,
            '_token_'           => isset($params['_token_']) ? $params['_token_'] : '',
        ];
        // unset header value from params
        unset($params['_token_issuer_']);
        unset($params['_token_']);

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);

        return  ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            self::$dealingApi[$apiName]['method'],
            $relativeUri,
            $option,
            false,
            true
        );
    }

    public function listUserCreatedBusiness($params) {
        $apiName = 'listUserCreatedBusiness';
        array_walk_recursive($params, 'self::prepareData');
        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';
        $relativeUri = self::$dealingApi[$apiName]['subUri'];

        // set headers
        $header = [
            '_token_issuer_'    => isset($params['_token_issuer_']) ? $params['_token_issuer_'] : 1,
            '_token_'           => isset($params['_token_']) ? $params['_token_'] : '',
        ];
        // unset header value from params
        unset($params['_token_issuer_']);
        unset($params['_token_']);

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);

        return  ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            self::$dealingApi[$apiName]['method'],
            $relativeUri,
            $option,
            false,
            true
        );
    }

    public function updateBusiness($params) {
        $apiName = 'updateBusiness';
        array_walk_recursive($params, 'self::prepareData');
        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';
        $relativeUri = self::$dealingApi[$apiName]['subUri'];

        // set headers
        $header = [
            '_token_issuer_'    => isset($params['_token_issuer_']) ? $params['_token_issuer_'] : 1,
            '_token_'           => isset($params['_token_']) ? $params['_token_'] : '',
        ];
        // unset header value from params
        unset($params['_token_issuer_']);
        unset($params['_token_']);

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);

        return  ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            self::$dealingApi[$apiName]['method'],
            $relativeUri,
            $option,
            false,
            true
        );
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
//                self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
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
            '_token_issuer_'    => isset($params['_token_issuer_']) ? $params['_token_issuer_'] : 1,
            '_token_'           => isset($params['_token_']) ? $params['_token_'] : '',
        ];
        // unset header value from params
        unset($params['_token_issuer_']);
        unset($params['_token_']);

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        return  ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            self::$dealingApi[$apiName]['method'],
            self::$dealingApi[$apiName]['subUri'],
            $option
        );

    }

    public function rateBusiness($params) {
        $apiName = 'rateBusiness';
        array_walk_recursive($params, 'self::prepareData');
        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';

        // set headers
        $header = [
            '_token_issuer_'    => isset($params['_token_issuer_']) ? $params['_token_issuer_'] : 1,
            '_token_'           => isset($params['_token_']) ? $params['_token_'] : '',
        ];
        // unset header value from params
        unset($params['_token_issuer_']);
        unset($params['_token_']);

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        return  ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            self::$dealingApi[$apiName]['method'],
            self::$dealingApi[$apiName]['subUri'],
            $option
        );
    }

    public function commentBusiness($params) {
        $apiName = 'commentBusiness';
        array_walk_recursive($params, 'self::prepareData');
        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';

        // set headers
        $header = [
            '_token_issuer_'    => isset($params['_token_issuer_']) ? $params['_token_issuer_'] : 1,
            '_token_'           => isset($params['_token_']) ? $params['_token_'] : '',
        ];
        // unset header value from params
        unset($params['_token_issuer_']);
        unset($params['_token_']);

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        return  ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            self::$dealingApi[$apiName]['method'],
            self::$dealingApi[$apiName]['subUri'],
            $option
        );
    }

    public function businessFavorite($params) {
        $apiName = 'businessFavorite';
        array_walk_recursive($params, 'self::prepareData');
        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';
        // set headers
        $header = [
            '_token_issuer_'    => isset($params['_token_issuer_']) ? $params['_token_issuer_'] : 1,
            '_token_'           => isset($params['_token_']) ? $params['_token_'] : '',
        ];
        // unset header value from params
        unset($params['_token_issuer_']);
        unset($params['_token_']);

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        return  ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            self::$dealingApi[$apiName]['method'],
            self::$dealingApi[$apiName]['subUri'],
            $option
        );
    }

    public function userBusinessInfos($params) {
        $apiName = 'userBusinessInfos';
        array_walk_recursive($params, 'self::prepareData');
        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';
        $relativeUri = self::$dealingApi[$apiName]['subUri'];
        // set headers
        $header = [
            '_token_issuer_'    => isset($params['_token_issuer_']) ? $params['_token_issuer_'] : 1,
            '_token_'           => isset($params['_token_']) ? $params['_token_'] : '',
        ];
        // unset header value from params
        unset($params['_token_issuer_']);
        unset($params['_token_']);

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);

        return  ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            self::$dealingApi[$apiName]['method'],
            $relativeUri,
            $option,
            false,
            true
        );
    }

    public function commentBusinessList($params) {
        $apiName = 'commentBusinessList';
        array_walk_recursive($params, 'self::prepareData');
        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';

        // set headers
        $header = [
            '_token_issuer_'    => isset($params['_token_issuer_']) ? $params['_token_issuer_'] : 1,
            '_token_'           => isset($params['_token_']) ? $params['_token_'] : '',
        ];
        // unset header value from params
        unset($params['_token_issuer_']);
        unset($params['_token_']);

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        return  ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            self::$dealingApi[$apiName]['method'],
            self::$dealingApi[$apiName]['subUri'],
            $option
        );
    }

    public function confirmComment($params) {
        $apiName = 'confirmComment';
        array_walk_recursive($params, 'self::prepareData');
        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';

        // set headers
        $header = [
            '_token_issuer_'    => isset($params['_token_issuer_']) ? $params['_token_issuer_'] : 1,
            '_token_'           => isset($params['_token_']) ? $params['_token_'] : '',
        ];
        // unset header value from params
        unset($params['_token_issuer_']);
        unset($params['_token_']);

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        return  ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            self::$dealingApi[$apiName]['method'],
            self::$dealingApi[$apiName]['subUri'],
            $option
        );
    }

}