<?php
/**
 * FulfillmentTest Test class for the Signifyd SDK
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
 * Class FulfillmentTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class FulfillmentTest extends TestCase
{
    /**
     * The class name tested class
     *
     * @var \PhpUnit\Framework\String
     */
    public $className = 'Signifyd\Models\Fulfillment';

    /**
     * Testing fulfillment with no argument passed
     *
     * @return void
     */
    public function testInitFulfillmentWithoutParams()
    {
        $fulfillment = new \Signifyd\Models\Fulfillment();
        $this->assertInstanceOf($this->className, $fulfillment);
    }

    /**
     * Testing fulfillment with sting params passed
     *
     * @return void
     */
    public function testInitFulfillmentWithStringParam()
    {
        $fulfillment = new \Signifyd\Models\Fulfillment('signifyd');
        $this->assertInstanceOf($this->className, $fulfillment);
    }

    /**
     * Testing fulfillment with an empty fulfillment array passed
     *
     * @return void
     */
    public function testInitFulfillmentWithEmptyArrayParam()
    {
        $fulfillment = new \Signifyd\Models\Fulfillment([]);
        $this->assertInstanceOf($this->className, $fulfillment);
    }

    /**
     * Testing fulfillment with an unknown properties passed
     *
     * @return void
     */
    public function testInitFulfillmentWithUnknownProperties()
    {
        $fulfillmentData = [
            'wow' => 'test',
            'foo' => 'bar'
        ];
        $fulfillment = new \Signifyd\Models\Fulfillment($fulfillmentData);
        $this->assertInstanceOf($this->className, $fulfillment);
        $jsonFulfillment = $fulfillment->toJson();
        $emptyJsonFulfillment = json_encode(
            [
                "id" => null,
                "orderId" => null,
                "createdAt" => null,
                "products" => [],
                "recipientName" => null,
                "deliveryAddress" => null,
                "fulfillmentStatus" => null,
                "shipmentStatus" => null,
                "shippingCarrier" => null,
                "trackingNumbers" => [],
                "trackingUrls" => [],
                "deliveryEmail" => null,
                "confirmationName" => null,
                "confirmationPhone" => null
            ]
        );

        $this->assertEquals($jsonFulfillment, $emptyJsonFulfillment);
    }

    /**
     * Testing fulfillment with an empty fulfillment array passed
     *
     * @return void
     */
    public function testInitFulfillmentWithCorrectParams()
    {
        $fulfillmentData = [
            "id" => 1002,
            "orderId" => 19418,
            "createdAt" => date(DATE_ATOM),
            "products" => [
                "itemId" => "1",
                "itemName" => "Sparkly sandals",
                "itemIsDigital" => false,
                "itemCategory" => "apparel",
                "itemSubCategory" => "footwear",
                "itemUrl" => "http://mydomain.com/sparkly-sandals",
                "itemImage" => "http://mydomain.com/images/sparkly-sandals.jpeg",
                "itemQuantity" => 1,
                "itemPrice" => 49.99,
                "itemWeight" => 5
            ],
            "recipientName" => 'Bob Smith',
            "deliveryAddress" => [
                "streetAddress" => "1850 Mercer Rd",
                "unit" => null,
                "city" => "Lexington",
                "provinceCode" => "KY",
                "postalCode" => "40511",
                "countryCode" => "US"
            ],
            "fulfillmentStatus" => "partial",
            "shipmentStatus" => "delivered",
            "shippingCarrier" => "UPS",
            "trackingNumbers" => [
                "1Z827wk74630"
            ],
            "trackingUrls" => [
                "http://wwwapps.ups.com/etracking/tracking.cgi?1Z827wk74630"
            ],
            "deliveryEmail" => "bob@gmail.com",
            "confirmationName" => "ACME Ware House",
            "confirmationPhone" => "1231232"
        ];
        $fulfillment = new \Signifyd\Models\Fulfillment($fulfillmentData);
        $this->assertInstanceOf($this->className, $fulfillment);
    }

    /**
     * Testing fulfillment with an empty fulfillment array passed
     *
     * @return void
     */
    public function testExpectedJsonWithCorrectParams()
    {
        $fulfillmentData = [
            "id" => 1002,
            "orderId" => 19418,
            "createdAt" => date(DATE_ATOM),
            "products" => [
                "itemId" => "1",
                "itemName" => "Sparkly sandals",
                "itemIsDigital" => false,
                "itemCategory" => "apparel",
                "itemSubCategory" => "footwear",
                "itemUrl" => "http://mydomain.com/sparkly-sandals",
                "itemImage" => "http://mydomain.com/images/sparkly-sandals.jpeg",
                "itemQuantity" => 1,
                "itemPrice" => 49.99,
                "itemWeight" => 5
            ],
            "recipientName" => 'Bob Smith',
            "deliveryAddress" => [
                "streetAddress" => "1850 Mercer Rd",
                "unit" => null,
                "city" => "Lexington",
                "provinceCode" => "KY",
                "postalCode" => "40511",
                "countryCode" => "US",
                "latitude" => "61.116",
                "longitude" => "10.047"
            ],
            "fulfillmentStatus" => "partial",
            "shipmentStatus" => "delivered",
            "shippingCarrier" => "UPS",
            "trackingNumbers" => [
                "1Z827wk74630"
            ],
            "trackingUrls" => [
                "http://wwwapps.ups.com/etracking/tracking.cgi?1Z827wk74630"
            ],
            "deliveryEmail" => "bob@gmail.com",
            "confirmationName" => "ACME Ware House",
            "confirmationPhone" => "1231232"
        ];
        $fulfillment = new \Signifyd\Models\Fulfillment($fulfillmentData);

        $jsonFulfillmentData = json_encode($fulfillmentData);
        $jsonFulfillment = $fulfillment->toJson();

        $this->assertEquals($jsonFulfillmentData, $jsonFulfillment);
    }

    /**
     * Testing fulfillment with an empty fulfillment array passed
     *
     * @return void
     */
    public function testValidateFulfillmentWithCorrectParams()
    {
        $fulfillmentData = [
            "id" => 1002,
            "orderId" => 19418,
            "createdAt" => date(DATE_ATOM),
            "products" => [
                "itemId" => "1",
                "itemName" => "Sparkly sandals",
                "itemIsDigital" => false,
                "itemCategory" => "apparel",
                "itemSubCategory" => "footwear",
                "itemUrl" => "http://mydomain.com/sparkly-sandals",
                "itemImage" => "http://mydomain.com/images/sparkly-sandals.jpeg",
                "itemQuantity" => 1,
                "itemPrice" => 49.99,
                "itemWeight" => 5
            ],
            "recipientName" => 'Bob Smith',
            "deliveryAddress" => [
                "streetAddress" => "1850 Mercer Rd",
                "unit" => null,
                "city" => "Lexington",
                "provinceCode" => "KY",
                "postalCode" => "40511",
                "countryCode" => "US"
            ],
            "fulfillmentStatus" => "partial",
            "shipmentStatus" => "delivered",
            "shippingCarrier" => "UPS",
            "trackingNumbers" => [
                "1Z827wk74630"
            ],
            "trackingUrls" => [
                "http://wwwapps.ups.com/etracking/tracking.cgi?1Z827wk74630"
            ],
            "deliveryEmail" => "bob@gmail.com",
            "confirmationName" => "ACME Ware House",
            "confirmationPhone" => "1231232"
        ];
        $fulfillment = new \Signifyd\Models\Fulfillment($fulfillmentData);
        $valid = $fulfillment->validate();

        $this->assertTrue($valid);
    }

    /* Disable until there is a real validation for Fulfillment */
    /**
     * Testing fulfillment with an empty fulfillment array passed
     *
     * @return void
     */
    //public function testValidateFulfillmentWithWrongParams()
    //{
        //$fulfillmentData = [];
        //$fulfillment = new \Signifyd\Models\Fulfillment($fulfillmentData);
        //$valid = $fulfillment->validate();

        //$this->assertNotTrue($valid);
    //}
    /* End disable until there is a real validation for Fulfillment */


}