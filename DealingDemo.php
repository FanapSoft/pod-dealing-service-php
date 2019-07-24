<?php
require __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL);
ini_set("display_errors", 1);

# ================================================ Dealing SERVICES ====================================================
# required classes
use Pod\Dealing\Service\DealingService;

# set serverType to SandBox or Production
$serverType = "Production";
#  instantiates a DealingService
$dealingService = new DealingService($serverType);

# ================================================ add User And Business ===============================================
function addUserAndBusiness()
{
    echo "======================================== add User And Business =================================" .PHP_EOL;
    global $dealingService;

    $param =
        [
        ## ======================================== *Required Parameters  ==============================================
            "_token_"               => '4d3d6b85e2e844b0ade83cc2ec5b4c85',      # Api_Token
            "username"              => 'testFanapMashhad12',
            "businessName"          => 'testFanapMashhad12',
            "email"                 => 'TEST@TEST.COM',
            "guildCode"             => ['INFORMATION_TECHNOLOGY_GUILD'],
            "country"               => 'ایران',
            "state"                 => 'خراسان رضوی',
            "city"                  => 'مشهد',
            "address"               => 'ADDRESS',
            "description"           => 'DESCRIPTION',
            "agentFirstName"        => 'test1',
            "agentLastName"         => 'test2',
            "agentCellphoneNumber"  => '09157351412',
        ## ========================================= Optional Parameters  ==============================================
             "_token_issuer_"       => 1,
#             "firstName"            => 'FIRST NAME',
#             "lastName"             => 'LAST NAME',
#             "sheba"                => 'SHEBA WITHOUT IR',
#             "nationalCode"         => 'CODE',
#             "economicCode"         => 'CODE',
#             "registrationNumber"   => 'REGISTER NUMBER',
#             "cellphone"            => '09120000000',
#             "phone"                => '051322222222',
#             "fax"                  => 'FAX',
#             "postalCode"           => '9185175673',
#             "newsReader"           => 'true/false',
#             "logoImage"            => 'LOGO',
#             "coverImage"           => 'COVER',
#             "tags"                 => 'TAG1,TAG2',
#             "tagTrees"             => 'TREE1,TREE2',
#             "tagTreeCategoryName"  => 'CATEGORY',
#             "link"                 => 'LINK',
#             "lat"                  => 0,
#             "lng"                  => 0,
#             "agentNationalCode"    => 'CODE',

        ];
    try {
        $result = $dealingService->addUserAndBusiness($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
    }
}

addUserAndBusiness();
die();

# ============================================ list User Created Business ==============================================
function listUserCreatedBusiness()
{
    echo "==================================== list User Created Business =================================" .PHP_EOL;
    global $dealingService;

    $param =
        [
        ## ======================================== *Required Parameters  ==============================================
            "_token_"               => '4d3d6b85e2e844b0ade83cc2ec5b4c85',  # Api_Token
        ## ========================================= Optional Parameters  ==============================================
#            "_token_issuer_"        => 1,
#            "bizId"                 => 'Business Id',
#            "username"              => 'testFanapMashhad1',
#            "businessName"          => 'testFanapMashhad1',
#            "email"                 => 'TEST@TEST.COM',
#            "guildCode"             => ['INFORMATION_TECHNOLOGY_GUILD'],   # لیست کد صنف کسب و کار
#            "country"               => 'ایران',
#            "state"                 => 'خراسان رضوی',
#            "city"                  => 'مشهد',
#            "active"                => true,
#            "offset"                => 0,
#            "size"                  => 10,
#            "ssoId"                 => 'ssoId',             # شناسه sso کاربر
#            "query"                 => 'query',            # مورد جستجو روی بیزینس های موجود
#            "sheba"                 => 'SHEBA WITHOUT IR',
#            "nationalCode"          => 'CODE',
#            "economicCode"          => 'CODE',
#            "cellphone"             => '09120000000',
#            "tags"                  => 'TAG1,TAG2',            # لیست تگ
#            "tagTrees"              => 'TREE1,TREE2',              # لیست درخت تگ

        ];
    try {
        $result = $dealingService->listUserCreatedBusiness($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
    }
}

#listUserCreatedBusiness();
#die();


# ==================================================== update Business =================================================
function updateBusiness()
{
    echo "============================================ update Business =================================" .PHP_EOL;
    global $dealingService;

    $param =
        [
        ## ======================================== *Required Parameters  ==============================================
            "_token_"               => '4d3d6b85e2e844b0ade83cc2ec5b4c85',  # Api_Token
            "bizId"                 => 4812,                        # شناسه کسب و کار
            "businessName"          => 'Keshtgar',                  # نام کسب و کار
            "guildCode"             => ['INFORMATION_TECHNOLOGY_GUILD', 'TOILETRIES_GUILD', 'FOOD_GUILD'], # لیست کد اصناف
            "country"               => 'ایران',
            "state"                 => 'خراسان رضوی',
            "city"                  => 'مشهد',
            "address"               => 'ADDRESS',
            "description"           => 'DESCRIPTION',
        ## ========================================= Optional Parameters  ==============================================
#            "_token_issuer_"         => 1,
#            "email"                  => 'keshtgar@fanap.ir',
#            "companyName"            => 'فناپ کشت گر',               # نام شرکت
#            "shopName"               => 'فروشگاه مرکزی',
#            "shopNameEn"             => 'Shopping Center',           # نام انگلیسی فروشگاه
#            "dateEstablishing"       => '1398/01/27',                          # تاریخ شمسی تاسیس yyyy/mm/dd
#            "website"                => 'website',                 # وبسایت
#            "sheba"                  => '',  # شبا که به صورت عددی وارد می شود. (بدون IR)
#            "firstName"              => 'FIRST NAME',              # نام شخص نماینده کسب و کار
#            "lastName"               => 'LAST NAME',               # نام خانوادگی شخص نماینده کسب و کار
#            "nationalCode"           => 'CODE',                    # شناسه ملی کسب و کار
#            "economicCode"           => 'CODE',                    # کد اقتصادی کسب و کار
#            "registrationNumber"     => 'REGISTER NUMBER',         # شماره ثبت کسب و کار
#            "cellphone"              => '09120000000',             # شماره موبایل نماینده کسب و کار
#            "phone"                  => '051322222222',
#            "fax"                    => 'FAX',
#            "postalCode"             => '9185175673',
#            "newsReader"             => 'true/false',
#            "changeLogo"             => 'LOGO',                    # در صورتی که بخواهید تصویر لوگو را تغییر دهید true وارد کنید
#            "changeCover"            => 'COVER',                   # در صورتی که بخواهید تصویر کاور را تغییر دهید true وارد کنید
#            "logoImage"              => 'LOGO',                    # logo image url
#            "coverImage"             => 'COVER',                   # cover image url
#            "tags"                   => 'TAG1,TAG2',               # تگ های آیتم که با , از هم جدا شده اند
#            "tagTrees"               => 'TREE1,TREE2',
#            "tagTreeCategoryName"    => 'CATEGORY',                # دسته درخت تگ
#            "link"                   => 'link',                    # لینک دسترسی به کسب و کار از طریق sso
#            "lat"                    => 0,
#            "lng"                    => 0,
#            "agentFirstName"         => 'FIRST NAME'               # نام نماینده
#            "agentLastName"          =>  'LAST NAME'               # نام خانوادگی نماینده
#            "agentCellphoneNumber"   =>  'MOBILE'                  # شماره تلفن نماینده
#            "agentNationalCode"      =>  'CODE'                    # کد ملی نماینده
#            "changeAgent"            =>  true | false              # در صورتی که بخواهید نماینده را تغییر دهید true وارد نمایید


    ];
    try {
        $result = $dealingService->updateBusiness($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
    }
}

#updateBusiness();
#die();

# =================================== get Api Token For Created Business ===============================================
function getApiTokenForCreatedBusiness()
{
    echo "=========================== get Api Token For Created Business =================================" .PHP_EOL;
    global $dealingService;

    $param =
        [
        ## ======================================== *Required Parameters  ==============================================
            "_token_"               => '4d3d6b85e2e844b0ade83cc2ec5b4c85',  # Api_Token
            'businessId'            => 4812,            # id of business
        ## ========================================= Optional Parameters  ==============================================
            "_token_issuer_"        => 1,

        ];
    try {
        $result = $dealingService->getApiTokenForCreatedBusiness($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
    }
}

#getApiTokenForCreatedBusiness();
#die();


# ================================================ rate Business =======================================================
function rateBusiness()
{
    echo "======================================== rate Business ===================================" .PHP_EOL;
    global $dealingService;

    $param =
        [
        ## ======================================== *Required Parameters  ==============================================
            "_token_"       => '06934dd766f94ab2be287a6385e79e6f',  # Access_Token
            'businessId'    => 3605,            # id of business
            'rate'          => 10,                   # [user rate between 0 and 10]
        ## ========================================= Optional Parameters  ==============================================
            "_token_issuer_"        => 1,

        ];
    try {
        $result = $dealingService->rateBusiness($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
    }
}

#rateBusiness();
#die();


# ============================================== comment Business ======================================================
function commentBusiness()
{
    echo "====================================== comment Business ===================================" .PHP_EOL;
    global $dealingService;

    $param =
        [
        ## ======================================== *Required Parameters  ==============================================
            "_token_"       => '833d3fe02d9c4bb7b3295deaa7c024f5',  # Access_Token
            'businessId'    => 4812,            # id of business
            'text'          => "کیفیت محصول معمولی",                   # [user rate between 0 and 10]
        ## ========================================= Optional Parameters  ==============================================
            "_token_issuer_"        => 1,

        ];
    try {
        $result = $dealingService->commentBusiness($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
    }
}

#commentBusiness();
#die();


# ============================================= business Favorite ======================================================
function businessFavorite()
{
    echo "====================================== business Favorite ===================================" .PHP_EOL;
    global $dealingService;

    $param =
        [
        ## ======================================== *Required Parameters  ==============================================
            "_token_"       => '06934dd766f94ab2be287a6385e79e6f',   # Access_Token
            'businessId'    => 3605,            # id of business
            'disfavorite'          => false, # or true
        ## ========================================= Optional Parameters  ==============================================
            "_token_issuer_"        => 1,

        ];
    try {
        $result = $dealingService->businessFavorite($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
    }
}

#businessFavorite();
#die();


# ============================================= user BusinessInfos =====================================================
function userBusinessInfos()
{
    echo "===================================== user BusinessInfos ===================================" .PHP_EOL;
    global $dealingService;

    $param =
        [
        ## ======================================== *Required Parameters  ==============================================
            "_token_"       => '4d3d6b85e2e844b0ade83cc2ec5b4c85',  # [ACCESS_TOKEN] یا [ACCESS_TOKEN]
            'id'    => [3605],            # id of business
        ## ========================================= Optional Parameters  ==============================================
            "_token_issuer_"        => 1,

        ];
    try {
        $result = $dealingService->userBusinessInfos($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
    }
}

#userBusinessInfos();
#die();


# ============================================= comment Business List ==================================================
function commentBusinessList()
{
    echo "===================================== comment Business List ================================" .PHP_EOL;
    global $dealingService;

    $param =
        [
        ## ======================================== *Required Parameters  ==============================================
            "_token_"       => '4d3d6b85e2e844b0ade83cc2ec5b4c85',  # [API_TOKEN] یا [ACCESS_TOKEN]
            'businessId'    => 3605,            # id of business
            'offset'          => 0,                   # [user rate between 0 and 10]
        ## ========================================= Optional Parameters  ==============================================
            "_token_issuer_"        => 1,
            # "size": 10,
            # "firstId": ID,
            # "lastId" : ID,


        ];
    try {
        $result = $dealingService->commentBusinessList($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
    }
}

#commentBusinessList();
#die();


# =============================================== confirm Comment ======================================================
function confirmComment()
{
    echo "======================================= confirm Comment ===================================" .PHP_EOL;
    global $dealingService;

    $param =
        [
        ## ======================================== *Required Parameters  ==============================================
            "_token_"       => '4d3d6b85e2e844b0ade83cc2ec5b4c85',  # Api_Token
            'commentId'    => 4812,            # id of business
        ## ========================================= Optional Parameters  ==============================================
            "_token_issuer_"        => 1,

        ];
    try {
        $result = $dealingService->confirmComment($param);
        print_r($result);
    }
    catch (CustomException $e) {
        print_r(
            $e->GetResult()
        );
    }
}

#confirmComment();
#die();

