<?php
/**
 * PurchaseTest Test class for the Signifyd SDK
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
 * Class PurchaseTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class PurchaseTest extends TestCase
{
    /**
     * @var \PhpUnit\Framework\String
     */
    public $className = 'Signifyd\Models\Purchase';

    /**
     * @var \PhpUnit\Framework\String
     */
    public $validType = 'array';

    public $purchaseData = [
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
    ];
    /**
     * Testing purchase with no argument passed
     *
     * @return void
     */
    public function testInitPurchaseWithoutParams()
    {
        $purchase = new \Signifyd\Models\Purchase();
        $this->assertInstanceOf($this->className, $purchase);
    }

    /**
     * Testing purchase with sting params passed
     *
     * @return void
     */
    public function testInitPurchaseWithStringParam()
    {
        $purchase = new \Signifyd\Models\Purchase('signifyd');
        $this->assertInstanceOf($this->className, $purchase);
    }

    /**
     * Testing purchase with an empty purchase array passed
     *
     * @return void
     */
    public function testInitPurchaseWithEmptyArrayParam()
    {
        $purchase = new \Signifyd\Models\Purchase([]);
        $this->assertInstanceOf($this->className, $purchase);
    }

    /**
     * Testing purchase with an unknown properties passed
     *
     * @return void
     */
    public function testInitPurchaseWithUnknownProperties()
    {
        $purchaseData = [
            'wow' => 'test',
            'foo' => 'bar'
        ];
        $purchase = new \Signifyd\Models\Purchase($purchaseData);
        $this->assertInstanceOf($this->className, $purchase);
        $jsonPurchase = $purchase->toJson();
        $emptyJsonPurchase = json_encode([
            "orderSessionId" => null,
            "browserIpAddress" => null,
            "orderId" => null,
            "createdAt" => null,
            "paymentGateway" => null,
            "paymentMethod" => null,
            "currency" => "USD",
            "avsResponseCode" => null,
            "cvvResponseCode" => null,
            "transactionId" => null,
            "orderChannel" => null,
            "receivedBy" => null,
            "totalPrice" => null,
            "customerOrderRecommendation" => null,
            "products" => [],
            "shipments" => [],
            "discountCodes" => []
        ]);

        $this->assertEquals($jsonPurchase, $emptyJsonPurchase);
    }

    /**
     * Testing purchase with an empty purchase array passed
     *
     * @return void
     */
    public function testInitPurchaseWithCorrectParams()
    {
        $purchase = new \Signifyd\Models\Purchase($this->purchaseData);
        $this->assertInstanceOf($this->className, $purchase);
    }

    /**
     * Testing purchase with an empty purchase array passed
     *
     * @return void
     */
    public function testExpectedJsonWithCorrectParams()
    {

        $purchase = new \Signifyd\Models\Purchase($this->purchaseData);
        $jsonPurchaseData = json_encode($this->purchaseData);
        $jsonPurchase = $purchase->toJson();

        $this->assertEquals($jsonPurchaseData, $jsonPurchase);
    }

    /**
     * Testing purchase with an empty purchase array passed
     *
     * @return void
     */
    public function testValidatePurchaseWithCorrectParams()
    {

        $purchase = new \Signifyd\Models\Purchase($this->purchaseData);
        $valid = $purchase->validate();

        $this->assertTrue($valid);
    }

    /**
     * Testing purchase with a wrong avs code
     *
     * @return void
     */
    public function testValidatePurchaseWithWrongAvsParam()
    {
        $purchaseData = $this->purchaseData;
        $purchaseData['avsResponseCode'] = 'j';
        $purchase = new \Signifyd\Models\Purchase($purchaseData);
        $valid = $purchase->validate();

        $this->assertInternalType($this->validType, $valid);
        $this->assertEquals('Invalid AVS code', $valid[0]);
    }

    /**
     * Testing purchase with a wrong cvv code
     *
     * @return void
     */
    public function testValidatePurchaseWithWrongCvvParam()
    {
        $purchaseData = $this->purchaseData;
        $purchaseData['cvvResponseCode'] = 'j';
        $purchase = new \Signifyd\Models\Purchase($purchaseData);
        $valid = $purchase->validate();

        $this->assertInternalType($this->validType, $valid);
        $this->assertEquals('Invalid CVV code', $valid[0]);
    }

    /**
     * Testing purchase with a wrong cvv and avs code
     *
     * @return void
     */
    public function testValidatePurchaseWithWrongCvvAvsParam()
    {
        $purchaseData = $this->purchaseData;
        $purchaseData['avsResponseCode'] = 'j';
        $purchaseData['cvvResponseCode'] = 'j';
        $purchase = new \Signifyd\Models\Purchase($purchaseData);
        $valid = $purchase->validate();

        $this->assertInternalType($this->validType, $valid);
        $this->assertEquals('Invalid AVS code', $valid[0]);
        $this->assertEquals('Invalid CVV code', $valid[1]);
    }

    /**
     * Testing purchase with a wrong payment method
     *
     * @return void
     */
    public function testValidatePurchaseWithWrongPaymentMethodParam()
    {
        $purchaseData = $this->purchaseData;
        $purchaseData['paymentMethod'] = 'signifyd';
        $purchase = new \Signifyd\Models\Purchase($purchaseData);
        $valid = $purchase->validate();

        $this->assertInternalType($this->validType, $valid);
        $this->assertEquals('Invalid payment method', $valid[0]);
    }

    /**
     * Testing purchase with a wrong order channel
     *
     * @return void
     */
    public function testValidatePurchaseWithWrongOrderChannelParam()
    {
        $purchaseData = $this->purchaseData;
        $purchaseData['orderChannel'] = 'signifyd';
        $purchase = new \Signifyd\Models\Purchase($purchaseData);
        $valid = $purchase->validate();

        $this->assertInternalType($this->validType, $valid);
        $this->assertEquals('Invalid order channel', $valid[0]);
    }

    /**
     * Testing purchase with a wrong customer order recommendation
     *
     * @return void
     */
    public function testValidatePurchaseWithWrongOrderRecommendationParam()
    {
        $purchaseData = $this->purchaseData;
        $purchaseData['customerOrderRecommendation'] = 'signifyd';
        $purchase = new \Signifyd\Models\Purchase($purchaseData);
        $valid = $purchase->validate();

        $this->assertInternalType($this->validType, $valid);
        $this->assertEquals('Invalid customer order recommendation', $valid[0]);
    }

    /**
     * Testing purchase with a wrong validation params
     *
     * @return void
     */
    public function testValidatePurchaseWithWrongValidatedParams()
    {
        $purchaseData = $this->purchaseData;
        $purchaseData['paymentMethod'] = 'signifyd';
        $purchaseData['orderChannel'] = 'signifyd';
        $purchaseData['customerOrderRecommendation'] = 'signifyd';
        $purchaseData['avsResponseCode'] = 'j';
        $purchaseData['cvvResponseCode'] = 'j';
        $purchase = new \Signifyd\Models\Purchase($purchaseData);
        $valid = $purchase->validate();

        $this->assertInternalType($this->validType, $valid);
        $this->assertEquals('Invalid payment method', $valid[0]);
        $this->assertEquals('Invalid order channel', $valid[1]);
        $this->assertEquals('Invalid customer order recommendation', $valid[2]);
        $this->assertEquals('Invalid AVS code', $valid[3]);
        $this->assertEquals('Invalid CVV code', $valid[4]);
    }
}