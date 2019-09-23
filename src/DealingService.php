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

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }
        else{
            $header['_token_issuer_'] = 1;
        }

        // set token in header
        if (isset($params['apiToken'])) {
            $header['_token_'] = $params['apiToken'];
            unset($params['apiToken']);
        }
        else{
            $header['_token_'] = '';
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);

        // prepare params to send
        $withBracketParams = [];
        if (isset($params['guildCode'])) {
            $withBracketParams['guildCode'] = $params['guildCode'];
            unset($params['guildCode']);
        }

        if(isset($params['tags']) && is_array($params['tags'])){
            $params['tags'] =  implode(',', $params['tags']);
        }

        if(isset($params['tagTrees']) && is_array($params['tagTrees'])){
            $params['tagTrees'] =  implode(',', $params['tagTrees']);
        }

        $option['withBracketParams'] = $withBracketParams;
        $option['withoutBracketParams'] = $params;
        //  unset `query` key because query string will be build in ApiRequestHandler and will be added to uri so dont need send again in query params
        unset($option['query']);

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

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }
        else{
            $header['_token_issuer_'] = 1;
        }

        // set token in header
        if (isset($params['apiToken'])) {
            $header['_token_'] = $params['apiToken'];
            unset($params['apiToken']);
        }
        else{
            $header['_token_'] = '';
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);

        // prepare params to send
        $withBracketParams = [];
        if (isset($params['guildCode'])) {
            $withBracketParams['guildCode'] = $params['guildCode'];
            unset($params['guildCode']);
        }
        $option['withBracketParams'] = $withBracketParams;
        $option['withoutBracketParams'] = $params;
        //  unset `query` key because query string will be build in ApiRequestHandler and will be added to uri so dont need send again in query params
        unset($option['query']);

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

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }
        else{
            $header['_token_issuer_'] = 1;
        }

        // set token in header
        if (isset($params['apiToken'])) {
            $header['_token_'] = $params['apiToken'];
            unset($params['apiToken']);
        }
        else{
            $header['_token_'] = '';
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);

        // prepare params to send
        $withBracketParams = [];
        if (isset($params['guildCode'])) {
            $withBracketParams['guildCode'] = $params['guildCode'];
            unset($params['guildCode']);
        }

        if(isset($params['tags']) && is_array($params['tags'])){
            $params['tags'] =  implode(',', $params['tags']);
        }

        if(isset($params['tagTrees']) && is_array($params['tagTrees'])){
            $params['tagTrees'] =  implode(',', $params['tagTrees']);
        }

        $option['withBracketParams'] = $withBracketParams;
        $option['withoutBracketParams'] = $params;
        //  unset `query` key because query string will be build in ApiRequestHandler and will be added to uri so dont need send again in query params
        unset($option['query']);

        return  ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            self::$dealingApi[$apiName]['method'],
            $relativeUri,
            $option,
            false,
            true
        );
    }

    public function getApiTokenForCreatedBusiness($params) {
        $apiName = 'getApiTokenForCreatedBusiness';
        array_walk_recursive($params, 'self::prepareData');
        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }
        else{
            $header['_token_issuer_'] = 1;
        }

        // set token in header
        if (isset($params['apiToken'])) {
            $header['_token_'] = $params['apiToken'];
            unset($params['apiToken']);
        }
        else{
            $header['_token_'] = '';
        }
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

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }
        else{
            $header['_token_issuer_'] = 1;
        }

        // set token in header
        if (isset($params['token'])) {
            $header['_token_'] = $params['token'];
            unset($params['token']);
        }
        else{
            $header['_token_'] = '';
        }

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

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }
        else{
            $header['_token_issuer_'] = 1;
        }

        // set token in header
        if (isset($params['token'])) {
            $header['_token_'] = $params['token'];
            unset($params['token']);
        }
        else{
            $header['_token_'] = '';
        }

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

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }
        else{
            $header['_token_issuer_'] = 1;
        }

        // set token in header
        if (isset($params['token'])) {
            $header['_token_'] = $params['token'];
            unset($params['token']);
        }
        else{
            $header['_token_'] = '';
        }

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

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }
        else{
            $header['_token_issuer_'] = 1;
        }

        // set token in header
        if (isset($params['token'])) {
            $header['_token_'] = $params['token'];
            unset($params['token']);
        }
        else{
            $header['_token_'] = '';
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);

        // prepare params to send
        $withBracketParams = [];
        if (isset($params['id'])) {
            $withBracketParams['id'] = $params['id'];
            unset($params['id']);
        }
        $option['withBracketParams'] = $withBracketParams;
        $option['withoutBracketParams'] = $params;
        //  unset `query` key because query string will be build in ApiRequestHandler and will be added to uri so dont need send again in query params
        unset($option['query']);

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

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }
        else{
            $header['_token_issuer_'] = 1;
        }

        // set token in header
        if (isset($params['token'])) {
            $header['_token_'] = $params['token'];
            unset($params['token']);
        }
        else{
            $header['_token_'] = '';
        }

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

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }
        else{
            $header['_token_issuer_'] = 1;
        }

        // set token in header
        if (isset($params['apiToken'])) {
            $header['_token_'] = $params['apiToken'];
            unset($params['apiToken']);
        }
        else{
            $header['_token_'] = '';
        }
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