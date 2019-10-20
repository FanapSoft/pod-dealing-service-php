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
    private $header;
    private static $dealingApi;
    private static $serviceProductId;

    public function __construct($baseInfo)
    {
        parent::__construct();
        self::$jsonSchema = json_decode(file_get_contents(__DIR__ . '/../config/validationSchema.json'), true);
        self::$dealingApi = require __DIR__ . '/../config/apiConfig.php';
        self::$serviceProductId = require __DIR__ . '/../config/serviceProductId.php';
        $this->header = [
            '_token_issuer_'    =>  $baseInfo->getTokenIssuer(),
            '_token_'           => $baseInfo->getToken()
        ];
    }

    public function addDealer($params) {
        $apiName = 'addDealer';
        $header = $this->header;
        # for array params that need to send by get method
        $optionHasArray = false;

        array_walk_recursive($params, 'self::prepareData');
        $method = self::$dealingApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['apiToken'])) {
            $header['_token_'] = $params['apiToken'];
            unset($params['apiToken']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        # prepare params to send
        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            $method,
            self::$dealingApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function dealerList($params) {
        $apiName = 'dealerList';
        $header = $this->header;
        # for array params that need to send by get method
        $optionHasArray = false;
        array_walk_recursive($params, 'self::prepareData');
        $method = self::$dealingApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['apiToken'])) {
            $header['_token_'] = $params['apiToken'];
            unset($params['apiToken']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        # prepare params to send
        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            $method,
            self::$dealingApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function enableDealer($params) {
        $apiName = 'enableDealer';
        $header = $this->header;
        # for array params that need to send by get method
        $optionHasArray = false;
        array_walk_recursive($params, 'self::prepareData');
        $method = self::$dealingApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';
        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['apiToken'])) {
            $header['_token_'] = $params['apiToken'];
            unset($params['apiToken']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        # prepare params to send
        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            $method,
            self::$dealingApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function disableDealer($params) {
        $apiName = 'disableDealer';
        $header = $this->header;
        # for array params that need to send by get method
        $optionHasArray = false;

        array_walk_recursive($params, 'self::prepareData');
        $method = self::$dealingApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['apiToken'])) {
            $header['_token_'] = $params['apiToken'];
            unset($params['apiToken']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        # prepare params to send
        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            $method,
            self::$dealingApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function businessDealingList($params) {
        $apiName = 'businessDealingList';
        $header = $this->header;
        # for array params that need to send by get method
        $optionHasArray = false;

        array_walk_recursive($params, 'self::prepareData');
        $method = self::$dealingApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['apiToken'])) {
            $header['_token_'] = $params['apiToken'];
            unset($params['apiToken']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        # prepare params to send
        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            $method,
            self::$dealingApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function addUserAndBusiness($params) {
        $apiName = 'addUserAndBusiness';
        $header = $this->header;
        array_walk_recursive($params, 'self::prepareData');
//        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';
        $paramKey = 'query';
        $relativeUri = self::$dealingApi[$apiName]['subUri'];

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['apiToken'])) {
            $header['_token_'] = $params['apiToken'];
            unset($params['apiToken']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);

        // prepare params to send
        # set service call product Id
        $params['scProductId'] = self::$serviceProductId[$apiName];
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
        unset($option[$paramKey]);

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
        $header = $this->header;
        array_walk_recursive($params, 'self::prepareData');
#        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';
        $paramKey = 'query';
        $relativeUri = self::$dealingApi[$apiName]['subUri'];

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['apiToken'])) {
            $header['_token_'] = $params['apiToken'];
            unset($params['apiToken']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);

        // prepare params to send
        # set service call product Id
        $params['scProductId'] = self::$serviceProductId[$apiName];
        $withBracketParams = [];
        if (isset($params['guildCode'])) {
            $withBracketParams['guildCode'] = $params['guildCode'];
            unset($params['guildCode']);
        }
        $option['withBracketParams'] = $withBracketParams;
        $option['withoutBracketParams'] = $params;
        //  unset `query` key because query string will be build in ApiRequestHandler and will be added to uri so dont need send again in query params
        unset($option[$paramKey]);

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
        $header = $this->header;
        array_walk_recursive($params, 'self::prepareData');
        $paramKey = self::$dealingApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';
        $relativeUri = self::$dealingApi[$apiName]['subUri'];

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['apiToken'])) {
            $header['_token_'] = $params['apiToken'];
            unset($params['apiToken']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);

        // prepare params to send
        # set service call product Id
        $params['scProductId'] = self::$serviceProductId[$apiName];
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
        $header = $this->header;
        # for array params that need to send by get method
        $optionHasArray = false;
        array_walk_recursive($params, 'self::prepareData');
        $method = self::$dealingApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['apiToken'])) {
            $header['_token_'] = $params['apiToken'];
            unset($params['apiToken']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        # prepare params to send
        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            $method,
            self::$dealingApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );

    }

    public function rateBusiness($params) {
        $apiName = 'rateBusiness';
        $header = $this->header;
        # for array params that need to send by get method
        $optionHasArray = false;
        array_walk_recursive($params, 'self::prepareData');
        $method = self::$dealingApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['token'])) {
            $header['_token_'] = $params['token'];
            unset($params['token']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        # prepare params to send
        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            $method,
            self::$dealingApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function commentBusiness($params) {
        $apiName = 'commentBusiness';
        $header = $this->header;
        # for array params that need to send by get method
        $optionHasArray = false;
        array_walk_recursive($params, 'self::prepareData');
        $method = self::$dealingApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['token'])) {
            $header['_token_'] = $params['token'];
            unset($params['token']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        # prepare params to send
        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            $method,
            self::$dealingApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function businessFavorite($params) {
        $apiName = 'businessFavorite';
        $header = $this->header;
        # for array params that need to send by get method
        $optionHasArray = false;
        array_walk_recursive($params, 'self::prepareData');
        $method = self::$dealingApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['token'])) {
            $header['_token_'] = $params['token'];
            unset($params['token']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        # prepare params to send
        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            $method,
            self::$dealingApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function userBusinessInfos($params) {
        $apiName = 'userBusinessInfos';
        $header = $this->header;

        array_walk_recursive($params, 'self::prepareData');
        $method = self::$dealingApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';
        $relativeUri = self::$dealingApi[$apiName]['subUri'];

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['token'])) {
            $header['_token_'] = $params['token'];
            unset($params['token']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);

        // prepare params to send
        $withBracketParams = [];
        # set service call product Id
        $params['scProductId'] = self::$serviceProductId[$apiName];
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
        $header = $this->header;
        # for array params that need to send by get method
        $optionHasArray = false;

        array_walk_recursive($params, 'self::prepareData');
        $method = self::$dealingApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['token'])) {
            $header['_token_'] = $params['token'];
            unset($params['token']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        # prepare params to send
        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            $method,
            self::$dealingApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function confirmComment($params) {
        $apiName = 'confirmComment';
        $header = $this->header;
        # for array params that need to send by get method
        $optionHasArray = false;

        array_walk_recursive($params, 'self::prepareData');
        $method = self::$dealingApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['apiToken'])) {
            $header['_token_'] = $params['apiToken'];
            unset($params['apiToken']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        # prepare params to send
        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            $method,
            self::$dealingApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function unConfirmComment($params) {
        $apiName = 'unConfirmComment';
        $header = $this->header;
        # for array params that need to send by get method
        $optionHasArray = false;

        array_walk_recursive($params, 'self::prepareData');
        $method = self::$dealingApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['apiToken'])) {
            $header['_token_'] = $params['apiToken'];
            unset($params['apiToken']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        # prepare params to send
        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            $method,
            self::$dealingApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function addDealerProductPermission($params) {
        $apiName = 'addDealerProductPermission';
        $header = $this->header;
        # for array params that need to send by get method
        $optionHasArray = false;

        array_walk_recursive($params, 'self::prepareData');
        $method = self::$dealingApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['apiToken'])) {
            $header['_token_'] = $params['apiToken'];
            unset($params['apiToken']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        # prepare params to send
        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            $method,
            self::$dealingApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function dealerProductPermissionList($params) {
        $apiName = 'dealerProductPermissionList';
        $header = $this->header;
        # for array params that need to send by get method
        $optionHasArray = false;

        array_walk_recursive($params, 'self::prepareData');
        $method = self::$dealingApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['apiToken'])) {
            $header['_token_'] = $params['apiToken'];
            unset($params['apiToken']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        # prepare params to send
        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            $method,
            self::$dealingApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );

    }

    public function dealingProductPermissionList($params) {
        $apiName = 'dealingProductPermissionList';
        $header = $this->header;
        # for array params that need to send by get method
        $optionHasArray = false;

        array_walk_recursive($params, 'self::prepareData');
        $method = self::$dealingApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['apiToken'])) {
            $header['_token_'] = $params['apiToken'];
            unset($params['apiToken']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        # prepare params to send
        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            $method,
            self::$dealingApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function disableDealerProductPermission($params) {
        $apiName = 'disableDealerProductPermission';
        $header = $this->header;
        # for array params that need to send by get method
        $optionHasArray = false;

        array_walk_recursive($params, 'self::prepareData');
        $method = self::$dealingApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['apiToken'])) {
            $header['_token_'] = $params['apiToken'];
            unset($params['apiToken']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        # prepare params to send
        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            $method,
            self::$dealingApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    public function enableDealerProductPermission($params) {
        $apiName = 'enableDealerProductPermission';
        $header = $this->header;
        # for array params that need to send by get method
        $optionHasArray = false;

        array_walk_recursive($params, 'self::prepareData');
        $method = self::$dealingApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['apiToken'])) {
            $header['_token_'] = $params['apiToken'];
            unset($params['apiToken']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($apiName, $option, $paramKey);
        # prepare params to send
        # set service call product Id
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];

        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }

        return ApiRequestHandler::Request(
            self::$config[self::$serverType][self::$dealingApi[$apiName]['baseUri']],
            $method,
            self::$dealingApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );

    }
}