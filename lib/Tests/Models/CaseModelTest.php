<?php
/**
 * CaseModelTest Test class for the Signifyd SDK
 *
 * PHP version 5.6
 *
 * @category  Signifyd_Fraud_Protection
 * @package   Signifyd\Core
 * @author    Signifyd <info@signifyd.com>
 * @copyright 2018 SIGNIFYD Inc. All rights reserved.
 * @license   See LICENSE.txt for license details.
 * @link      https://www.signifyd.com/
 */
namespace Signifyd\Tests\Core;

use PHPUnit\Framework\TestCase;

/**
 * Class CaseModelTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class CaseModelTest extends TestCase
{
    /**
     * @var \PhpUnit\Framework\String
     */
    public $className = 'Signifyd\Models\CaseModel';

    /**
     * @var \PhpUnit\Framework\String
     */
    public $validType = 'array';

    /**
     * @var array
     */
    public $caseData = [
        "purchase" => [
            "orderSessionId" => "uha3d98weicm20eufhlqe",
            "browserIpAddress" => "192.168.1.1",
            "orderId" => "19418",
            "createdAt" => "2016-07-11T17:54:31-05:00",
            "paymentGateway" => "stripe",
            "paymentMethod" => "credit_card",
            "currency" => "USD",
            "avsResponseCode" => "Y",
            "cvvResponseCode" => "M",
            "transactionId" => "1a2sf3f44f21s1",
            "orderChannel" => "PHONE",
            "receivedBy" => "John Doe",
            "totalPrice" => 74.99,
            "customerOrderRecommendation" => "REJECT",
            "products" => [
                [
                    "itemId" => "1",
                    "itemName" => "Sparkly sandals",
                    "itemUrl" => "http://mydomain.com/sparkly-sandals",
                    "itemImage" => "http://mydomain.com/images/sparkly-sandals.jpeg",
                    "itemQuantity" => 1,
                    "itemPrice" => 49.99,
                    "itemWeight" => 5,
                    "itemIsDigital" => false,
                    "itemCategory" => "apparel",
                    "itemSubCategory" => "footwear"
                ],
                [
                    "itemId" => "2",
                    "itemName" => "Summer tank top",
                    "itemUrl" => "http://mydomain.com/summer-tank",
                    "itemImage" => "http://mydomain.com/images/summer-tank.jpeg",
                    "itemQuantity" => 1,
                    "itemPrice" => 19.99,
                    "itemWeight" => 2,
                    "itemIsDigital" => false,
                    "itemCategory" => "apparel",
                    "itemSubCategory" => "shirts"
                ]
            ],
            "shipments" => [
                [
                    "shipper" => "UPS",
                    "shippingMethod" => "ground",
                    "shippingPrice" => 10,
                    "trackingNumber" => '98254yrweauh87423qfed'
                ],
                [
                    "shipper" => "USPS",
                    "shippingMethod" => "international",
                    "shippingPrice" => 20,
                    "trackingNumber" => '98254yrweauh87423qfed'
                ]
            ],
            "discountCodes" => [
                [
                    "code" => "TENDOLLARSOFF",
                    "amount" => 10,
                    "percentage" => null
                ],
                [
                    "code" => "20PERCENTOFF",
                    "amount" => null,
                    "percentage" => 20
                ]
            ]
        ],
        "recipient" => [
            "fullName" => "Bob Smith",
            "confirmationEmail" => "bob@gmail.com",
            "confirmationPhone" => "5047130000",
            "organization" => "SIGNIFYD",
            "deliveryAddress" => [
                "streetAddress" => "123 State Street",
                "unit" => "2A",
                "city" => "Chicago",
                "provinceCode" => "IL",
                "postalCode" => "60622",
                "countryCode" => "US",
                "latitude" => null,
                "longitude" => null
            ]
        ],
        "card" => [
            "cardHolderName" => "Robert Smith",
            "bin" => 407441,
            "last4" => "1234",
            "expiryMonth" => 12,
            "expiryYear" => 2015,
            "hash" => null,
            "billingAddress" => [
                "streetAddress" => null,
                "unit" => "2A",
                "city" => "Chicago",
                "provinceCode" => "IL",
                "postalCode" => "60622",
                "countryCode" => "US",
                "latitude" => null,
                "longitude" => null
            ]
        ],
        "userAccount" => [
            "email" => "bob@gmail.com",
            "username" => "bobbo",
            "phone" => "5555551212",
            "createdDate" => "2016-07-11T17:54:31-05:00",
            "accountNumber" => "54321",
            "lastOrderId" => "4321",
            "aggregateOrderCount" => 40,
            "aggregateOrderDollars" => 5000,
            "lastUpdateDate" => "2016-07-11T17:54:31-05:00"
        ],
        "seller" => [
            "name" => "We sell awesome stuff, Inc.",
            "domain" => "wesellawesomestuff.com",
            "email" => "wesellawesomestuff@gmail.com",
            "username" => "awesomestuff1234",
            "accountNumber" => "54321",
            "phone" => "8883334545",
            "createdDate" => "2016-07-11T17:54:31-05:00",
            "aggregateOrderCount" => 4000,
            "aggregateOrderDollars" => 3000000,
            "lastUpdateDate" => "2016-07-11T17:54:31-05:00",
            "onboardingIpAddress" => "192.122.1.1",
            "onboardingEmail" => "wesellawesomestuff@gmail.com",
            "tags" => [
                "Enterprise Account",
                "Gold Plan"
            ],
            "shipFromAddress" => [
                "streetAddress" => "1850 Mercer Rd",
                "unit" => null,
                "city" => "Lexington",
                "provinceCode" => "KY",
                "postalCode" => "40511",
                "countryCode" => "US",
                "latitude" => null,
                "longitude" => null
            ],
            "corporateAddress" => [
                "streetAddress" => "410 Terry Ave",
                "unit" => "3L",
                "city" => "Seattle",
                "provinceCode" => "WA",
                "postalCode" => "98109",
                "countryCode" => "US",
                "latitude" => null,
                "longitude" => null
            ]
        ]
    ];



    /**
     * Testing case model with no argument passed
     *
     * @return void
     */
    public function testInitCaseModelWithoutParams()
    {
        $caseModel = new \Signifyd\Models\CaseModel();
        $this->assertInstanceOf($this->className, $caseModel);
    }

    /**
     * Testing case model with sting params passed
     *
     * @return void
     */
    public function testInitCaseModelWithStringParam()
    {
        $caseModel = new \Signifyd\Models\CaseModel('signifyd');
        $this->assertInstanceOf($this->className, $caseModel);
    }

    /**
     * Testing case model with an empty case model array passed
     *
     * @return void
     */
    public function testInitCaseModelWithEmptyArrayParam()
    {
        $caseModel = new \Signifyd\Models\CaseModel([]);
        $this->assertInstanceOf($this->className, $caseModel);
    }

    /**
     * Testing case model with an unknown properties passed
     *
     * @return void
     */
    public function testInitCaseModelWithUnknownProperties()
    {
        $caseModelData = [
            'wow' => 'test',
            'foo' => 'bar'
        ];
        $caseModel = new \Signifyd\Models\CaseModel($caseModelData);
        $this->assertInstanceOf($this->className, $caseModel);
        $jsonCaseModel = $caseModel->toJson();
        $emptyJsonCaseModel = json_encode([
            "purchase" => null,
            "recipient" => null,
            "card" => null,
            "userAccount" => null,
            "seller" => null
        ]);

        $this->assertEquals($jsonCaseModel, $emptyJsonCaseModel);
    }

    /**
     * Testing case model with an empty case model array passed
     *
     * @return void
     */
    public function testInitCaseModelWithCorrectParams()
    {
        $caseModel = new \Signifyd\Models\CaseModel($this->caseData);
        $this->assertInstanceOf($this->className, $caseModel);
    }

    /**
     * Testing case model with an empty case model array passed
     *
     * @return void
     */
    public function testExpectedJsonWithCorrectParams()
    {

        $caseModel = new \Signifyd\Models\CaseModel($this->caseData);

        $jsonCaseModelData = json_encode($this->caseData);
        $jsonCaseModel = $caseModel->toJson();

        $this->assertEquals($jsonCaseModelData, $jsonCaseModel);
    }

    /**
     * Testing case model with an empty case model array passed
     *
     * @return void
     */
    public function testValidateCaseModelWithCorrectParams()
    {
        $caseModel = new \Signifyd\Models\CaseModel($this->caseData);
        $valid = $caseModel->validate();

        $this->assertTrue($valid);
    }

    /**
     * Testing purchase with a wrong avs code
     *
     * @return void
     */
    public function testValidateCaseModelPurchaseWithWrongAvsParam()
    {
        $caseData = $this->caseData;
        $caseData['purchase']['avsResponseCode'] = 'j';
        $case = new \Signifyd\Models\CaseModel($caseData);
        $valid = $case->validate();
//        var_dump($valid);
        $this->assertInternalType($this->validType, $valid);
        $this->assertEquals('Invalid AVS code', $valid[0][0]);
    }

    /**
     * Testing purchase with a wrong cvv code
     *
     * @return void
     */
    public function testValidateCaseModelPurchaseWithWrongCvvParam()
    {
        $caseData = $this->caseData;
        $caseData['purchase']['cvvResponseCode'] = 'j';
        $case = new \Signifyd\Models\CaseModel($caseData);
        $valid = $case->validate();

        $this->assertInternalType($this->validType, $valid);
        $this->assertEquals('Invalid CVV code', $valid[0][0]);
    }

    /**
     * Testing purchase with a wrong cvv and avs code
     *
     * @return void
     */
    public function testValidateCaseModelPurchaseWithWrongCvvAvsParam()
    {
        $caseData = $this->caseData;
        $caseData['purchase']['avsResponseCode'] = 'j';
        $caseData['purchase']['cvvResponseCode'] = 'j';
        $case = new \Signifyd\Models\CaseModel($caseData);
        $valid = $case->validate();

        $this->assertInternalType($this->validType, $valid);
        $this->assertEquals('Invalid AVS code', $valid[0][0]);
        $this->assertEquals('Invalid CVV code', $valid[0][1]);
    }

    /**
     * Testing purchase with a wrong payment method
     *
     * @return void
     */
    public function testValidateCaseModelPurchaseWithWrongPaymentMethodParam()
    {
        $caseData = $this->caseData;
        $caseData['purchase']['paymentMethod'] = 'signifyd';
        $case = new \Signifyd\Models\CaseModel($caseData);
        $valid = $case->validate();

        $this->assertInternalType($this->validType, $valid);
        $this->assertEquals('Invalid payment method', $valid[0][0]);
    }

    /**
     * Testing purchase with a wrong order channel
     *
     * @return void
     */
    public function testValidateCaseModelPurchaseWithWrongOrderChannelParam()
    {
        $caseData = $this->caseData;
        $caseData['purchase']['orderChannel'] = 'signifyd';
        $case = new \Signifyd\Models\CaseModel($caseData);
        $valid = $case->validate();

        $this->assertInternalType($this->validType, $valid);
        $this->assertEquals('Invalid order channel', $valid[0][0]);
    }

    /**
     * Testing purchase with a wrong customer order recommendation
     *
     * @return void
     */
    public function testValidateCaseModelPurchaseWithWrongOrderRecommendationParam()
    {
        $caseData = $this->caseData;
        $caseData['purchase']['customerOrderRecommendation'] = 'signifyd';
        $case = new \Signifyd\Models\CaseModel($caseData);
        $valid = $case->validate();

        $this->assertInternalType($this->validType, $valid);
        $this->assertEquals('Invalid customer order recommendation', $valid[0][0]);
    }

    /**
     * Testing purchase with a wrong validation params
     *
     * @return void
     */
    public function testValidateCaseModelPurchaseWithWrongValidatedParams()
    {
        $caseData = $this->caseData;
        $caseData['purchase']['paymentMethod'] = 'signifyd';
        $caseData['purchase']['orderChannel'] = 'signifyd';
        $caseData['purchase']['customerOrderRecommendation'] = 'signifyd';
        $caseData['purchase']['avsResponseCode'] = 'j';
        $caseData['purchase']['cvvResponseCode'] = 'j';
        $case = new \Signifyd\Models\CaseModel($caseData);
        $valid = $case->validate();

        $this->assertInternalType($this->validType, $valid);
        $this->assertEquals('Invalid payment method', $valid[0][0]);
        $this->assertEquals('Invalid order channel', $valid[0][1]);
        $this->assertEquals('Invalid customer order recommendation', $valid[0][2]);
        $this->assertEquals('Invalid AVS code', $valid[0][3]);
        $this->assertEquals('Invalid CVV code', $valid[0][4]);
    }


}