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

final class BusinessOperationTest extends TestCase
{
//    public static $apiToken;
    public static $dealingService;
    const TOKEN_ISSUER = 1;
    const API_TOKEN = '{Put APi Token}';
    const API_TOKEN_12582 = '{Put Another APi Token}';
    const ACCESS_TOKEN = '{Put Access Token}';
    const CLIENT_ID = '{Put Client Id}';
    const CLIENT_SECRET = '{Put Client Secret}';
    const CONFIRM_CODE = '{Put confirm code}';
    const INFORMATION_TECHNOLOGY_GUILD = 'INFORMATION_TECHNOLOGY_GUILD';
    const TOILETRIES_GUILD = 'TOILETRIES_GUILD';

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

    public function testAddUserAndBusinessAllParameters()
    {
        $businessName = uniqid('Functional Test');
        $userName = uniqid('Functional_Test');
        $nationalCode = '1111551111'; // نباید تکراری باشد
        $params =
            [
                ## ============== Required Parameters  ====================
                'username'              => $userName,
                'businessName'          => $businessName,
                'email'                 => 't@t.com',
                'guildCode'             => [self::INFORMATION_TECHNOLOGY_GUILD, self::TOILETRIES_GUILD],
                'country'               => 'ایران',
                'state'                 => 'خراسان',
                'city'                  => 'مشهد',
                'address'               => 'تقی آباد خیابان هفتم',
                'description'           => 'تست کد',
                'agentFirstName'        => 'AGENT FIRST NAME',
                'agentLastName'         => 'AGENT LAST NAME',
                'agentCellphoneNumber'  => '09151234567',
                ## ============== Optional Parameters  ====================
                'apiToken'              => self::API_TOKEN,
                'tokenIssuer'           => self::TOKEN_ISSUER,
                'firstName'             => 'FIRST NAME',
                'lastName'              => 'LAST NAME',
                'sheba'                 => '980570100680013557234101',
                'nationalCode'          => $nationalCode,
                'economicCode'          => '123',
                'registrationNumber'    => '1234fa',
                'cellphone'             => '09150000000',
                'phone'                 => '05132222222',
                'fax'                   => '05133333333',
                'postalCode'            => '9185175673',
                'newsReader'            => true,
                'logoImage'             => 'LOGO',
                'coverImage'            => 'COVER',
                'tags'                  => 'TAG1,TAG2',
//                'tagTrees'              => ['TestTagCategory5dbfefe86b953'],
                'tagTreeCategoryName'   => 'TestTagCategory5dc12fabea220',
                'link'                  => 'LINK',
                'lat'                   => 35.12345,
                'lng'                   => 35.12345,
                'agentNationalCode'     => '1111221111',
                'scVoucherHash'         => ['{Put Service Call Voucher Hashes}'],
                'scApiKey'              => '{Put service call Api Key}',
            ];

        try {
            $result = self::$dealingService->addUserAndBusiness($params);
            $this->assertFalse($result['hasError']);

            $this->assertNotEmpty($result['result']['guilds']);
            $this->assertEquals('INFORMATION_TECHNOLOGY_GUILD' ,$result['result']['guilds'][0]['code']);
            $this->assertEquals('TOILETRIES_GUILD' ,$result['result']['guilds'][1]['code']);

            $this->assertNotEmpty($result['result']['tags']);
            $this->assertEquals('TAG1' ,$result['result']['tags'][0]);
            $this->assertEquals('TAG2' ,$result['result']['tags'][1]);

        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testAddUserAndBusinessRequiredParameters()
    {
        $businessName = uniqid('Functional Test');
        $userName = uniqid('Functional_Test');
        $params =
            [
                ## ============== Required Parameters  ====================
                'username'              => $userName,
                'businessName'          => $businessName,
                'email'                 => 't@t1.com',
                'guildCode'             => [self::INFORMATION_TECHNOLOGY_GUILD, self::TOILETRIES_GUILD],
                'country'               => 'ایران',
                'state'                 => 'خراسان',
                'city'                  => 'مشهد',
                'address'               => 'تقی آباد خیابان هفتم',
                'description'           => 'تست کد',
                'agentFirstName'        => 'AGENT FIRST NAME',
                'agentLastName'         => 'AGENT LAST NAME',
                'agentCellphoneNumber'  => '09158107405',
        ];
        try {
            $result = self::$dealingService->addUserAndBusiness($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testAddUserAndBusinessValidationError()
    {
        $params = [
            'email'    => 'tt',
            'username' => 'W1',
        ];
        try {
            self::$dealingService->addUserAndBusiness($params);
        } catch (ValidationException $e) {

            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);

            $result = $e->getResult();
            $this->assertArrayHasKey('username', $validation);
            $this->assertEquals('Must be at least 3 characters long', $validation['username'][0]);
            $this->assertArrayHasKey('businessName', $validation);
            $this->assertArrayHasKey('email', $validation);
            $this->assertArrayHasKey('guildCode', $validation);
            $this->assertArrayHasKey('country', $validation);
            $this->assertArrayHasKey('state', $validation);
            $this->assertArrayHasKey('city', $validation);
            $this->assertArrayHasKey('address', $validation);
            $this->assertArrayHasKey('description', $validation);
            $this->assertArrayHasKey('agentFirstName', $validation);
            $this->assertArrayHasKey('agentLastName', $validation);
            $this->assertArrayHasKey('agentCellphoneNumber', $validation);

            $this->assertEquals(887, $result['code']);
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }
    
    public function testUpdateBusinessAllParameters()
    {
        $businessName = uniqid('Functional Test');
        $nationalCode = '1111441111'; // نباید تکراری باشد
        $params =
            [
                ## ============== Required Parameters  ====================
                'bizId'                 => 12582,
                'businessName'          => $businessName,
                'guildCode'             => [self::INFORMATION_TECHNOLOGY_GUILD, self::TOILETRIES_GUILD],
                'country'               => 'ایران',
                'state'                 => 'خراسان',
                'city'                  => 'مشهد',
                'address'               => 'تقی آباد خیابان هفتم',
                'description'           => 'تست کد',
                ## ============== Optional Parameters  ====================
                'apiToken'              => self::API_TOKEN,
                'tokenIssuer'           => self::TOKEN_ISSUER,
                'firstName'             => 'FIRST NAME',
                'lastName'              => 'LAST NAME',
                'email'                 => 't@t.com',
                'companyName'           => 'فناپ کشت گر',               # نام شرکت
                'sheba'                 => '980570100680013557234101',
                'shopName'              => 'فروشگاه مرکزی',
                'shopNameEn'            => 'Shopping Center',           # نام انگلیسی فروشگاه
                'dateEstablishing'      => '1398/01/27',                          # تاریخ شمسی تاسیس yyyy/mm/dd
                'website'               => 'website',                 # وبسایت
                'nationalCode'          => $nationalCode,
                'economicCode'          => '123',
                'registrationNumber'    => '1234fa',
                'cellphone'             => '09150000000',
                'phone'                 => '05132222222',
                'fax'                   => '05133333333',
                'postalCode'            => '9185175673',
                'changeLogo'            => true,                    # در صورتی که بخواهید تصویر لوگو را تغییر دهید true وارد کنید
                'changeCover'           => true,                   # در صورتی که بخواهید تصویر کاور را تغییر دهید true وارد کنید
                'logoImage'             => 'LOGO',
                'coverImage'            => 'COVER',
                'tags'                  => 'TAG1,TAG2',
//                'tagTrees'              => ['TestTagCategory5dbfefe86b953'],
                'tagTreeCategoryName'   => 'TestTagCategory5dc12fabea220',
                'link'                  => 'LINK',
                'lat'                   => 35.12345,
                'lng'                   => 35.12345,
                'agentFirstName'        => 'FIRST NAME',               # نام نماینده
                'agentLastName'         =>  'LAST NAME' ,              # نام خانوادگی نماینده
                'agentCellphoneNumber'  =>  'MOBILE',                  # شماره تلفن نماینده
                'agentNationalCode'     => '1111221111',
                'changeAgent'           =>  true,             # در صورتی که بخواهید نماینده را تغییر دهید true وارد نمایید         
                'scVoucherHash'         => ['{Put Service Call Voucher Hashes}'],
                'scApiKey'              => '{Put service call Api Key}',
            ];

        try {
            $result = self::$dealingService->updateBusiness($params);
            $this->assertFalse($result['hasError']);
print_r($result);die;
            $this->assertNotEmpty($result['result']['guilds']);
            $this->assertEquals('INFORMATION_TECHNOLOGY_GUILD' ,$result['result']['guilds'][1]['code']);
            $this->assertEquals('TOILETRIES_GUILD' ,$result['result']['guilds'][0]['code']);

            $this->assertNotEmpty($result['result']['tags']);
            $this->assertEquals('TAG1' ,$result['result']['tags'][0]);
            $this->assertEquals('TAG2' ,$result['result']['tags'][1]);

        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testUpdateBusinessRequiredParameters()
    {
        $businessName = uniqid('Functional Test');
        $nationalCode = '1111441111'; //در صورت تایید شدن کسب و کار قابل ویرایش نیست همان مقدار قبلی فرستاده شود
        $params =
            [
                ## ============== Required Parameters  ====================
                'bizId'                 => 12582,
                'businessName'          => $businessName,
                'guildCode'             => [self::INFORMATION_TECHNOLOGY_GUILD, self::TOILETRIES_GUILD],
                'country'               => 'ایران',
                'state'                 => 'خراسان',
                'city'                  => 'مشهد',
                'address'               => 'تقی آباد خیابان هفتم',
                'description'           => 'تست کد',
                'nationalCode'           => $nationalCode,
        ];
        try {
            $result = self::$dealingService->updateBusiness($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testUpdateBusinessValidationError()
    {
        $params = [
            'email' => 'tt',
        ];
        try {
            self::$dealingService->updateBusiness($params);
        } catch (ValidationException $e) {

            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);

            $result = $e->getResult();
            $this->assertArrayHasKey('bizId', $validation);
            $this->assertEquals('The property bizId is required', $validation['bizId'][0]);
            $this->assertArrayHasKey('businessName', $validation);
            $this->assertEquals('The property businessName is required', $validation['businessName'][0]);
            $this->assertArrayHasKey('guildCode', $validation);
            $this->assertEquals('The property guildCode is required', $validation['guildCode'][0]);
            $this->assertArrayHasKey('country', $validation);
            $this->assertEquals('The property country is required', $validation['country'][0]);
            $this->assertArrayHasKey('state', $validation);
            $this->assertEquals('The property state is required', $validation['state'][0]);
            $this->assertArrayHasKey('city', $validation);
            $this->assertEquals('The property city is required', $validation['city'][0]);
            $this->assertArrayHasKey('address', $validation);
            $this->assertEquals('The property address is required', $validation['address'][0]);
            $this->assertArrayHasKey('description', $validation);
            $this->assertEquals('The property description is required', $validation['description'][0]);
            $this->assertArrayHasKey('email', $validation);
            $this->assertEquals('Invalid email', $validation['email'][0]);

            $this->assertEquals(887, $result['code']);
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }
    
    public function testListUserCreatedBusinessAllParameters()
    {
        $nationalCode = '1111441111'; // نباید تکراری باشد
        $params =
            [
                ## =============== Optional Parameters  ==================
                'apiToken'              => self::API_TOKEN,
                'tokenIssuer'           => self::TOKEN_ISSUER,
                'bizId'                 => [12121],
                'username'              => 'USER_NAME',
                'businessName'          => 'BUSINESS_NAME',
                'email'                 => 't@t.com',
                'guildCode'             => [self::INFORMATION_TECHNOLOGY_GUILD, self::TOILETRIES_GUILD],
//                'country'               => 'ایران',
//                'state'                 => 'خراسان رضوی',
//                'city'                  => 'مشهد',
                'active'                => false,
                'offset'                => 0,
                'size'                  => 10,
                'ssoId'                 => '1234',
                'query'                 => 'QUERY',
                'sheba'                 => '980570100680013557234101',
                'nationalCode'          => $nationalCode,
                'economicCode'          => 'CODE',
                'cellphone'             => '09120000000',
                'tags'                  => ['TAG1', 'TAG2'],
                'tagTrees'              => ['TREE1', 'TREE2'],
                'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
                'scApiKey'           => '{Put service call Api Key}',
            ];
        try {
            $result = self::$dealingService->listUserCreatedBusiness($params);

            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testListUserCreatedBusinessRequiredParameters()
    {
        $params = [];
        try {
            $result = self::$dealingService->listUserCreatedBusiness($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testListUserCreatedBusinessRequiredParametersValidation()
    {
        $params = [
            'email' => 'tt',
            'nationalCode' => 'tt',
            'cellphone' => 'tt',
            'sheba' => 'tt',
        ];
        try {
            self::$dealingService->listUserCreatedBusiness($params);
        } catch (ValidationException $e) {

            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);

            $result = $e->getResult();
            $this->assertArrayHasKey('email', $validation);
            $this->assertArrayHasKey('nationalCode', $validation);
            $this->assertArrayHasKey('cellphone', $validation);
            $this->assertArrayHasKey('sheba', $validation);

            $this->assertEquals(887, $result['code']);
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }
    
    public function testGetApiTokenForCreatedBusinessAllParameters()
    {

        $params =
            [
            ## =================== *Required Parameters  ========================
                'businessId'            => 12582,            # id of business
            ## =================== Optional Parameters  =========================
                'apiToken'              => self::API_TOKEN,
                'tokenIssuer'           => self::TOKEN_ISSUER,
                'scVoucherHash'         => ['{Put Service Call Voucher Hashes}'],
                'scApiKey'              => '{Put service call Api Key}',
            ];
        try {
            $result = self::$dealingService->getApiTokenForCreatedBusiness($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testGetApiTokenForCreatedBusinessRequiredParameters()
    {
        $params = [
            # =================== *Required Parameters  ========================
            'businessId'            => 12582,            # id of business
        ];
        try {
            $result = self::$dealingService->getApiTokenForCreatedBusiness($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testRateBusinessAllParameters()
    {
        $params =
            [
            ## =================== *Required Parameters  ========================
                'businessId'            => 12582,            # id of business
                'rate'                  => 5,                   # [user rate between 0 and 5]
            ## =================== Optional Parameters  =========================
                'token'                 => self::API_TOKEN,
                'tokenIssuer'           => self::TOKEN_ISSUER,
                'scVoucherHash'         => ['{Put Service Call Voucher Hashes}'],
                'scApiKey'              => '{Put service call Api Key}',
            ];
        try {
            $result = self::$dealingService->rateBusiness($params);
            $this->assertTrue($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->assertEquals('نمی توانید این کسب و کار را امتیاز دهی کنید', $error['message']);
        }
    }

    public function testRateBusinessRequiredParameters()
    {
        $params = [
            # =================== *Required Parameters  ========================
            'businessId'            => 3605,            # id of business
            'rate'                  => 5,                   # [user rate between 0 and 5]
        ];
        try {
            self::$dealingService->rateBusiness($params);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->assertEquals('نمی توانید این کسب و کار را امتیاز دهی کنید', $error['message']);
        }
    }

    public function testRateBusinessRequiredParametersValidation()
    {
        $withoutRequiredParams = [];
        $wrongParams = [
            # =================== *Required Parameters  ========================
            'businessId'            => '3605',            # id of business
            'rate'                  => 7,                   # [user rate between 0 and 5]
        ];

        try {
            self::$dealingService->rateBusiness($wrongParams);
        } catch (ValidationException $e) {
            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);
            $this->assertArrayHasKey('businessId', $validation);
            $this->assertEquals('String value found, but an integer is required', $validation['businessId'][0]);
            $this->assertArrayHasKey('rate', $validation);
            $this->assertEquals('Must have a maximum value of 5', $validation['rate'][0]);

            $result = $e->getResult();
            $this->assertEquals(887,$result['code']);

        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
        try {
            self::$dealingService->rateBusiness($withoutRequiredParams);
        } catch (ValidationException $e) {
            $validation = $e->getErrorsAsArray();

            $this->assertNotEmpty($validation);

            $this->assertArrayHasKey('businessId', $validation);
            $this->assertEquals('The property businessId is required', $validation['businessId'][1]);
            $this->assertArrayHasKey('rate', $validation);
            $this->assertEquals('The property rate is required', $validation['rate'][1]);

            $result = $e->getResult();
            $this->assertEquals(887,$result['code']);

        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testCommentBusinessAllParameters()
    {
        $params =
            [
            ## =================== *Required Parameters  ========================
                'businessId'            => 12582,            # id of business
                'text'                  => 'unit test comment',                   # [user rate between 0 and 5]
            ## =================== Optional Parameters  =========================
                'token'              => self::API_TOKEN,
                'tokenIssuer'           => self::TOKEN_ISSUER,
                'scVoucherHash'         => ['{Put Service Call Voucher Hashes}'],
                'scApiKey'              => '{Put service call Api Key}',
            ];
        try {
            $result = self::$dealingService->commentBusiness($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testCommentBusinessRequiredParameters()
    {
        $params = [
            # =================== *Required Parameters  ========================
            'businessId'            => 12582,            # id of business
            'text'                  => 'unit test comment',                   # [user rate between 0 and 5]
        ];
        try {
            $result = self::$dealingService->commentBusiness($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testCommentBusinessRequiredParametersValidation()
    {
        $withoutRequiredParams = [];
        $wrongParams = [
            # =================== *Required Parameters  ========================
            'businessId'            => '4812',            # id of business
            'text'                  => 10,                   # [user rate between 0 and 5]
        ];

        try {
            self::$dealingService->commentBusiness($wrongParams);
        } catch (ValidationException $e) {
            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);
            $this->assertArrayHasKey('businessId', $validation);
            $this->assertEquals('String value found, but an integer is required', $validation['businessId'][0]);
            $this->assertArrayHasKey('text', $validation);
            $this->assertEquals('Integer value found, but a string is required', $validation['text'][0]);

            $result = $e->getResult();
            $this->assertEquals(887,$result['code']);

        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }

        try {
            self::$dealingService->commentBusiness($withoutRequiredParams);
        } catch (ValidationException $e) {
            $validation = $e->getErrorsAsArray();

            $this->assertNotEmpty($validation);

            $this->assertNotEmpty($validation['businessId'][1]);
            $this->assertEquals('The property businessId is required', $validation['businessId'][1]);
            $this->assertNotEmpty($validation['text'][1]);
            $this->assertEquals('The property text is required', $validation['text'][1]);

            $result = $e->getResult();
            $this->assertEquals(887,$result['code']);

        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testBusinessFavoriteAllParameters()
    {
        $params =
            [
            ## =================== *Required Parameters  ========================
                'businessId'            => 12121,            # id of business
                'disfavorite'           => false,
            ## =================== Optional Parameters  =========================
                'token'              => self::API_TOKEN,
                'tokenIssuer'           => self::TOKEN_ISSUER,
                'scVoucherHash'         => ['{Put Service Call Voucher Hashes}'],
                'scApiKey'              => '{Put service call Api Key}',
            ];
        try {
            $result = self::$dealingService->businessFavorite($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testBusinessFavoriteRequiredParameters()
    {
        $params = [
            # =================== *Required Parameters  ========================
            'businessId'            => 12582,            # id of business
            'disfavorite'           => true,
        ];
        try {
            $result = self::$dealingService->businessFavorite($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testBusinessFavoriteRequiredParametersValidation()
    {
        $withoutRequiredParams = [];
        $wrongParams = [
            # =================== *Required Parameters  ========================
            'businessId'            => '4812',            # id of business
            'disfavorite'           => 10,                   # [user rate between 0 and 5]
        ];

        try {
            self::$dealingService->businessFavorite($wrongParams);
        } catch (ValidationException $e) {
            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);
            $this->assertArrayHasKey('businessId', $validation);
            $this->assertEquals('String value found, but an integer is required', $validation['businessId'][0]);
            $this->assertArrayHasKey('disfavorite', $validation);
            $this->assertEquals('Integer value found, but a string is required', $validation['disfavorite'][0]);

            $result = $e->getResult();
            $this->assertEquals(887,$result['code']);

        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }

        try {
            self::$dealingService->businessFavorite($withoutRequiredParams);
        } catch (ValidationException $e) {

            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);

            $this->assertNotEmpty($validation['businessId'][1]);
            $this->assertEquals('The property businessId is required', $validation['businessId'][1]);

            $result = $e->getResult();
            $this->assertEquals(887,$result['code']);

        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testUserBusinessInfosAllParameters()
    {
        $params =
            [
                ## ================ *Required Parameters  ==============
                'id'                => [12582, 12583],            # id of business
                ## ================ Optional Parameters  ===============
                "token"             => self::API_TOKEN,  # [ACCESS_TOKEN] یا [ACCESS_TOKEN]
                "tokenIssuer"       => self::TOKEN_ISSUER,
                'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
                'scApiKey'          => '{Put service call Api Key}',
            ];
        try {
            $result = self::$dealingService->userBusinessInfos($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testUserBusinessInfosRequiredParameters()
    {
        $params = [
            ## ============ *Required Parameters  ================
            'id'    => [5624, 4812],            # id of business
        ];
        try {
            $result = self::$dealingService->userBusinessInfos($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testUserBusinessInfosValidationError()
    {
        $params1 = [];
        $params2 = [
            ## ============ *Required Parameters  ================
            'id'    => 5624,            # id of business
        ];
        try {
            self::$dealingService->userBusinessInfos($params1);
        } catch (ValidationException $e) {

            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);

            $result = $e->getResult();
            $this->assertArrayHasKey('id', $validation);
            $this->assertEquals('The property id is required', $validation['id'][0]);

            $this->assertEquals(887, $result['code']);
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }

        try {
            self::$dealingService->userBusinessInfos($params2);
        } catch (ValidationException $e) {

            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);

            $result = $e->getResult();
            $this->assertArrayHasKey('id', $validation);
            $this->assertEquals('Integer value found, but an array is required', $validation['id'][1]);

            $this->assertEquals(887, $result['code']);
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testCommentBusinessListAllParameters()
    {
        $reqParams1 =
            [
                ## ================ *Required Parameters  ==============
                'businessId'        => 12582,
                'offset'            => 0,
                ## ================ Optional Parameters  ===============
                "token"             => self::API_TOKEN,  # [ACCESS_TOKEN] یا [ACCESS_TOKEN]
                "tokenIssuer"       => self::TOKEN_ISSUER,
                'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
                'scApiKey'          => '{Put service call Api Key}',
            ];
            $reqParams2 =
            [
                ## ================ *Required Parameters  ==============
                'businessId'        => 12582,
                'firstId'            => 0,
                ## ================ Optional Parameters  ===============
                "token"             => self::API_TOKEN,  # [ACCESS_TOKEN] یا [ACCESS_TOKEN]
                "tokenIssuer"       => self::TOKEN_ISSUER,
                'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
                'scApiKey'          => '{Put service call Api Key}',
            ];
            $reqParams3 =
            [
                ## ================ *Required Parameters  ==============
                'businessId'        => 12582,
                'lastId'            => 1000,
                ## ================ Optional Parameters  ===============
                "token"             => self::API_TOKEN,  # [ACCESS_TOKEN] یا [ACCESS_TOKEN]
                "tokenIssuer"       => self::TOKEN_ISSUER,
                'scVoucherHash'     => ['{Put Service Call Voucher Hashes}'],
                'scApiKey'          => '{Put service call Api Key}',
            ];
        try {
            $result1 = self::$dealingService->commentBusinessList($reqParams1);
            $this->assertFalse($result1['hasError']);

            $result2 = self::$dealingService->commentBusinessList($reqParams2);
            $this->assertFalse($result2['hasError']);

            $result3 = self::$dealingService->commentBusinessList($reqParams3);
            $this->assertFalse($result3['hasError']);

        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testCommentBusinessListRequiredParameters()
    {
        $reqParams1 =
            [
                ## =============== *Required Parameters  ==============
                'businessId'        => 12582,
                'offset'            => 0,
            ];
        $reqParams2 =
            [
                ## =============== *Required Parameters  ==============
                'businessId'        => 12582,
                'firstId'            => 0,
            ];
        $reqParams3 =
            [
                ## =============== *Required Parameters  ==============
                'businessId'        => 12582,
                'lastId'            => 1000,
            ];
        try {
            $result1 = self::$dealingService->commentBusinessList($reqParams1);
            $this->assertFalse($result1['hasError']);

            $result2 = self::$dealingService->commentBusinessList($reqParams2);
            $this->assertFalse($result2['hasError']);

            $result3 = self::$dealingService->commentBusinessList($reqParams3);
            $this->assertFalse($result3['hasError']);

        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testCommentBusinessListValidationError()
    {
        $params1 = [];
        $params2 = [
            ## ============ *Required Parameters  ================
            'businessId'    => 're12',
            'lastId'        => 're12',
            'firstId'       => 're12',
            'offset'        => '05',
        ];
        try {
            self::$dealingService->commentBusinessList($params1);
        } catch (ValidationException $e) {

            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);

            $this->assertEquals('The property businessId is required', $validation['businessId'][0]);
            $this->assertEquals('The property offset is required', $validation['offset'][0]);
            $this->assertEquals('The property firstId is required', $validation['firstId'][0]);
            $this->assertEquals('The property lastId is required', $validation['lastId'][0]);
            $this->assertEquals('Failed to match exactly one schema', $validation['oneOf'][0]);

            $result = $e->getResult();
            $this->assertEquals(887, $result['code']);
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }

        try {
            self::$dealingService->commentBusinessList($params2);
        } catch (ValidationException $e) {

            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);

            $this->assertEquals('String value found, but an integer is required', $validation['businessId'][1]);
            $this->assertEquals('String value found, but an integer is required', $validation['firstId'][1]);
            $this->assertEquals('String value found, but an integer is required', $validation['lastId'][1]);
            $this->assertEquals('String value found, but an integer is required', $validation['offset'][1]);

            $result = $e->getResult();
            $this->assertEquals(887, $result['code']);
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testConfirmCommentAllParameters()
    {
        $params =
            [
                ## =================== *Required Parameters  ========================
                'commentId'            => 7251,
                ## =================== Optional Parameters  =========================
                'apiToken'              => self::API_TOKEN_12582,
                'tokenIssuer'           => self::TOKEN_ISSUER,
                'scVoucherHash'         => ['{Put Service Call Voucher Hashes}'],
                'scApiKey'              => '{Put service call Api Key}',
            ];
        try {
            $result = self::$dealingService->confirmComment($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testConfirmCommentRequiredParameters()
    {
        $params = [
            ## =================== *Required Parameters  ========================
            'commentId'            => 7250,
            'apiToken'              => self::API_TOKEN_12582,
        ];
        try {
            $result = self::$dealingService->confirmComment($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: ' . $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

    public function testConfirmCommentRequiredParametersValidation()
    {
        $withoutRequiredParams = [];
        $wrongParams = [
            # =================== *Required Parameters  ========================
            'commentId'            => 'qw',
        ];

        try {
            self::$dealingService->confirmComment($wrongParams);
        } catch (ValidationException $e) {
            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);
            $this->assertArrayHasKey('commentId', $validation);
            $this->assertEquals('String value found, but an integer is required', $validation['commentId'][0]);

            $result = $e->getResult();
            $this->assertEquals(887,$result['code']);

        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }

        try {
            self::$dealingService->confirmComment($withoutRequiredParams);
        } catch (ValidationException $e) {
            $validation = $e->getErrorsAsArray();

            $this->assertNotEmpty($validation);

            $this->assertNotEmpty($validation['commentId'][1]);
            $this->assertEquals('The property commentId is required', $validation['commentId'][1]);

            $result = $e->getResult();
            $this->assertEquals(887,$result['code']);

        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: ' . $error['message']);
        }
    }

}