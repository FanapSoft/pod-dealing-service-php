<?php
/**
 * Created by PhpStorm.
 * User: keshtgar
 * Date: 11/11/19
 * Time: 9:49 AM
 */
use PHPUnit\Framework\TestCase;
use Pod\Dealing\Service\DealingService;
use Pod\Base\Service\BaseInfo;
use Pod\Base\Service\Exception\ValidationException;
use Pod\Base\Service\Exception\PodException;

final class DealingTest extends TestCase
{
//    public static $apiToken;
    public static $dealingService;
    const TOKEN_ISSUER = 1;
    const API_TOKEN = '4d3d6b85e2e844b0ade83cc2ec5b4c85';
    const API_TOKEN_12582 = '954e58d14f544bd0b5daa7f9401ed3ea';
    const ACCESS_TOKEN = '7e1044745ba543ce97231dafa200859f';
    const CLIENT_ID = '6257411i38cb46e0ae26be4629583b22';
    const CLIENT_SECRET = 'd33b5e71';
    const CONFIRM_CODE = '2007431';

    public function setUp(): void
    {
        parent::setUp();
        # set serverType to SandBox or Production
        BaseInfo::initServerType(BaseInfo::SANDBOX_SERVER);

        $baseInfo = new BaseInfo();
        $baseInfo->setTokenIssuer(self::TOKEN_ISSUER);
        $baseInfo->setToken(self::API_TOKEN);

        self::$dealingService = new DealingService($baseInfo);
    }

    public function testAddDealerAllParameters()
    {
        $params =
            [
                ## ============== Required Parameters  ====================
                'dealerBizId'           => 12582,
                ## ============== Optional Parameters  ====================
                'apiToken'              => self::API_TOKEN,
                'tokenIssuer'           => self::TOKEN_ISSUER,
                'allProductAllow'       => true,             # دسترسی به همه محصولات
                'scVoucherHash'         => ['{Put Service Call Voucher Hashes}'],
                'scApiKey'              => '{Put service call Api Key}',
            ];

        try {
            $result = self::$dealingService->addDealer($params);
            $this->assertFalse($result['hasError']);

        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testAddDealerRequiredParameters()
    {
        $params =
            [
                ## ============== Required Parameters  ====================
                'dealerBizId'              => 12121,
        ];
        try {
            $result = self::$dealingService->addDealer($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testAddDealerValidationError()
    {
        $params = [];
        try {
            self::$dealingService->addDealer($params);
        } catch (ValidationException $e) {

            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);

            $result = $e->getResult();
            $this->assertArrayHasKey('dealerBizId', $validation);
            $this->assertEquals('The property dealerBizId is required', $validation['dealerBizId'][0]);

            $this->assertEquals(887, $result['code']);
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }
    
    public function testDealerListAllParameters()
    {
        $params =
            [
                ## =============== Optional Parameters  ==================
                'apiToken'      => self::API_TOKEN,
                'tokenIssuer'   => self::TOKEN_ISSUER,
                'dealerBizId'   => 12121,
                'enable'        => true,
                'size'          => 10,
                'offset'        => 0,
            ];
        try {
            $result = self::$dealingService->dealerList($params);

            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testDealerListRequiredParameters()
    {
        $params = [];
        try {
            $result = self::$dealingService->dealerList($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testDealerListRequiredParametersValidation()
    {
        $params = [
            'offset' => -1,
            'size' => 0,
        ];
        try {
            self::$dealingService->dealerList($params);
        } catch (ValidationException $e) {

            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);

            $result = $e->getResult();
            $this->assertArrayHasKey('offset', $validation);
            $this->assertEquals('Must have a minimum value of 0', $validation['offset'][0]);
            $this->assertArrayHasKey('size', $validation);
            $this->assertEquals('Must have a minimum value of 1', $validation['size'][0]);


            $this->assertEquals(887, $result['code']);
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }
    
    public function testEnableDealerAllParameters()
    {
        $params =
            [
            ## =================== *Required Parameters  ========================
                'dealerBizId'            => 12121,            # id of business
            ## =================== Optional Parameters  =========================
                'apiToken'              => self::API_TOKEN,
                'tokenIssuer'           => self::TOKEN_ISSUER,
                'scVoucherHash'         => ['{Put Service Call Voucher Hashes}'],
                'scApiKey'              => '{Put service call Api Key}',
            ];
        try {
            $result = self::$dealingService->enableDealer($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testEnableDealerRequiredParameters()
    {
        $params = [
            # =================== *Required Parameters  ========================
            'dealerBizId'            => 12121,            # id of business
        ];
        try {
            $result = self::$dealingService->enableDealer($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testEnableDealerRequiredValidationError()
    {
        $params = [];
        try {
            $result = self::$dealingService->enableDealer($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {

            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);

            $this->assertArrayHasKey('dealerBizId', $validation);
            $this->assertEquals('The property dealerBizId is required', $validation['dealerBizId'][0]);
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testDisableDealerAllParameters()
    {
        $params =
            [
            ## =================== *Required Parameters  ========================
                'dealerBizId'            => 12121,            # id of business
            ## =================== Optional Parameters  =========================
                'apiToken'              => self::API_TOKEN,
                'tokenIssuer'           => self::TOKEN_ISSUER,
                'scVoucherHash'         => ['{Put Service Call Voucher Hashes}'],
                'scApiKey'              => '{Put service call Api Key}',
            ];
        try {
            $result = self::$dealingService->disableDealer($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testDisableDealerRequiredParameters()
    {
        $params = [
            # =================== *Required Parameters  ========================
            'dealerBizId'            => 12121,            # id of business
        ];
        try {
            $result = self::$dealingService->disableDealer($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testDisableDealerRequiredValidationError()
    {
        $params = [];
        try {
            $result = self::$dealingService->disableDealer($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {

            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);

            $this->assertArrayHasKey('dealerBizId', $validation);
            $this->assertEquals('The property dealerBizId is required', $validation['dealerBizId'][0]);
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testBusinessDealingListAllParameters()
    {
        $params =
            [
                ## ================ Optional Parameters  ===============
                'dealingBusinessId' => 4821,
                'enable'            => true,
                'size'              => 10,
                'offset'            => 0,
                "apiToken"          => self::API_TOKEN,
                "tokenIssuer"       => self::TOKEN_ISSUER,
                'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
                'scApiKey'          => '{Put service call Api Key}',
            ];
        try {
            $result = self::$dealingService->businessDealingList($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testBusinessDealingListRequiredParameters()
    {
        $params = [];
        try {
            $result = self::$dealingService->businessDealingList($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testAddDealerProductPermissionAllParameters()
    {
        $params =
            [
                ## ============== Required Parameters  ====================
                'productEntityId'       => 31427,            # شناسه محصول
                'dealerBizId'           => 12582,    # شناسه کسب و کار واسط
                ## ============== Optional Parameters  ====================
                'apiToken'              => self::API_TOKEN,
                'tokenIssuer'           => self::TOKEN_ISSUER,
                'scVoucherHash'         => ['{Put Service Call Voucher Hashes}'],
                'scApiKey'              => '{Put service call Api Key}',
            ];

        try {
            $result = self::$dealingService->addDealerProductPermission($params);
            $this->assertFalse($result['hasError']);

        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testAddDealerProductPermissionRequiredParameters()
    {
        $params =
            [
                ## ============== Required Parameters  ====================
                'productEntityId'       => 31427,            # شناسه محصول
                'dealerBizId'           => 12582,    # شناسه کسب و کار واسط
        ];
        try {
            $result = self::$dealingService->addDealerProductPermission($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testAddDealerProductPermissionValidationError()
    {
        $params = [];
        try {
            self::$dealingService->addDealerProductPermission($params);
        } catch (ValidationException $e) {

            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);

            $result = $e->getResult();
            $this->assertArrayHasKey('dealerBizId', $validation);
            $this->assertEquals('The property dealerBizId is required', $validation['dealerBizId'][0]);

            $this->assertArrayHasKey('productEntityId', $validation);
            $this->assertEquals('The property productEntityId is required', $validation['productEntityId'][0]);

            $this->assertEquals(887, $result['code']);
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testDealerProductPermissionListAllParameters()
    {
        $params =
            [
                ## =============== Optional Parameters  ==================
                'apiToken'          => self::API_TOKEN,
                'tokenIssuer'       => self::TOKEN_ISSUER,
                'dealerBizId'       => 12582,
                'productEntityId'   => 31427,
                'enable'            => true,
                'size'              => 10,
                'offset'            => 0,
            ];
        try {
            $result = self::$dealingService->dealerProductPermissionList($params);

            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testDealerProductPermissionListRequiredParameters()
    {
        $params = [];
        try {
            $result = self::$dealingService->dealerProductPermissionList($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testDealerProductPermissionListRequiredParametersValidation()
    {
        $params = [
            'offset' => -1,
            'size' => 0,
        ];
        try {
            self::$dealingService->dealerProductPermissionList($params);
        } catch (ValidationException $e) {

            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);

            $result = $e->getResult();
            $this->assertArrayHasKey('offset', $validation);
            $this->assertEquals('Must have a minimum value of 0', $validation['offset'][0]);
            $this->assertArrayHasKey('size', $validation);
            $this->assertEquals('Must have a minimum value of 1', $validation['size'][0]);


            $this->assertEquals(887, $result['code']);
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testDealingProductPermissionListAllParameters()
    {
        $params =
            [
                ## =============== Optional Parameters  ==================
                'apiToken'          => self::API_TOKEN_12582,
                'tokenIssuer'       => self::TOKEN_ISSUER,
                'dealingBusinessId' => 4821,
                'productEntityId'   => 31427,
                'enable'            => true,
                'size'              => 10,
                'offset'            => 0,
            ];
        try {
            $result = self::$dealingService->dealingProductPermissionList($params);

            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testDealingProductPermissionListRequiredParameters()
    {
        $params = [];
        try {
            $result = self::$dealingService->dealingProductPermissionList($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testDealingProductPermissionListRequiredParametersValidation()
    {
        $params = [
            'offset' => -1,
            'size' => 0,
        ];
        try {
            self::$dealingService->dealingProductPermissionList($params);
        } catch (ValidationException $e) {

            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);

            $result = $e->getResult();
            $this->assertArrayHasKey('offset', $validation);
            $this->assertEquals('Must have a minimum value of 0', $validation['offset'][0]);
            $this->assertArrayHasKey('size', $validation);
            $this->assertEquals('Must have a minimum value of 1', $validation['size'][0]);


            $this->assertEquals(887, $result['code']);
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testEnableDealerProductPermissionAllParameters()
    {
        $params =
            [
            ## =================== *Required Parameters  ========================
                'dealerBizId'           => 12582,            # id of business
                'productEntityId'       => 31427,
            ## =================== Optional Parameters  =========================
                'apiToken'              => self::API_TOKEN,
                'tokenIssuer'           => self::TOKEN_ISSUER,
                'scVoucherHash'         => ['{Put Service Call Voucher Hashes}'],
                'scApiKey'              => '{Put service call Api Key}',
            ];
        try {
            $result = self::$dealingService->enableDealerProductPermission($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testEnableDealerProductPermissionRequiredParameters()
    {
        $params = [
            # =================== *Required Parameters  ========================
            'dealerBizId'           => 12582,            # id of business
            'productEntityId'       => 31427,
        ];
        try {
            $result = self::$dealingService->enableDealerProductPermission($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testEnableDealerProductPermissionRequiredValidationError()
    {
        $params = [];
        try {
            $result = self::$dealingService->enableDealerProductPermission($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {

            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);

            $this->assertArrayHasKey('dealerBizId', $validation);
            $this->assertEquals('The property dealerBizId is required', $validation['dealerBizId'][0]);


            $this->assertArrayHasKey('productEntityId', $validation);
            $this->assertEquals('The property productEntityId is required', $validation['productEntityId'][0]);
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testDisableDealerProductPermissionAllParameters()
    {
        $params =
            [
            ## =================== *Required Parameters  ========================
                'dealerBizId'           => 12582,            # id of business
                'productEntityId'       => 31427,
            ## =================== Optional Parameters  =========================
                'apiToken'              => self::API_TOKEN,
                'tokenIssuer'           => self::TOKEN_ISSUER,
                'scVoucherHash'         => ['{Put Service Call Voucher Hashes}'],
                'scApiKey'              => '{Put service call Api Key}',
            ];
        try {
            $result = self::$dealingService->disableDealerProductPermission($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testDisableDealerProductPermissionRequiredParameters()
    {
        $params = [
            # =================== *Required Parameters  ========================
            'dealerBizId'           => 12582,            # id of business
            'productEntityId'       => 31427,
        ];
        try {
            $result = self::$dealingService->disableDealerProductPermission($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testDisableDealerProductPermissionRequiredValidationError()
    {
        $params = [];
        try {
            $result = self::$dealingService->disableDealerProductPermission($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {

            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);

            $this->assertArrayHasKey('dealerBizId', $validation);
            $this->assertEquals('The property dealerBizId is required', $validation['dealerBizId'][0]);

            $this->assertArrayHasKey('productEntityId', $validation);
            $this->assertEquals('The property productEntityId is required', $validation['productEntityId'][0]);
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }
}