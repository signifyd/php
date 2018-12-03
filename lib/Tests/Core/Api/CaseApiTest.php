<?php
/**
 * CaseApiTest Test class for the Signifyd SDK
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
namespace Signifyd\Tests\Core\Api;

use PHPUnit\Framework\TestCase;

/**
 * Class CaseApiTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class CaseApiTest extends TestCase
{

    public $caseData = [];

    /**
     * Testing settings with no argument passed
     *
     * @return void
     */
    public function testFile()
    {
        $this->fail('Case api test is working');
    }

    public function setUp()
    {
        $this->caseData = [
            "purchase" => [
                "orderSessionId" => "uha3d98weicm20eufhlqe",
                "browserIpAddress" => "192.168.1.1",
                "orderId" => "19418",
                "createdAt" => "2016-07-11T17:54:31-05:00",
                "paymentGateway" => "stripe",
                "paymentMethod" => "credit_card",
                "transactionId" => "1a2sf3f44f21s1",
                "currency" => "USD",
                "avsResponseCode" => "Y",
                "cvvResponseCode" => "M",
                "orderChannel" => "PHONE",
                "receivedBy" => "John Doe",
                "totalPrice" => 74.99,
                "customerOrderRecommendation" => "REJECT",
                "products" => [
                    [
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
                    [
                        "itemId" => "2",
                        "itemName" => "Summer tank top",
                        "itemIsDigital" => false,
                        "itemCategory" => "apparel",
                        "itemSubCategory" => "shirts",
                        "itemUrl" => "http://mydomain.com/summer-tank",
                        "itemImage" => "http://mydomain.com/images/summer-tank.jpeg",
                        "itemQuantity" => 1,
                        "itemPrice" => 19.99,
                        "itemWeight" => 2
                    ]
                ],
                "discountCodes" => [
                    [
                        "amount" => 10,
                        "code" => "TENDOLLARSOFF"
                    ],
                    [
                    "percentage" => 20,
                    "code" => "20PERCENTOFF"
                    ]
                ],
                "shipments" => [
                    [
                    "shipper" => "UPS",
                    "shippingMethod" => "ground",
                    "shippingPrice" => 10
                    ],
                    [
                    "shipper" => "USPS",
                    "shippingMethod" => "international",
                    "shippingPrice" => 20
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
                    "countryCode" => "US"
                ]
            ],
            "card" => [
                "cardHolderName" => "Robert Smith",
                "bin" => 407441,
                "last4" => "1234",
                "expiryMonth" => 12,
                "expiryYear" => 2015,
                "billingAddress" => [
                    "streetAddress" => null,
                    "unit" => "2A",
                    "city" => "Chicago",
                    "provinceCode" => "IL",
                    "postalCode" => "60622",
                    "countryCode" => "US"
                ]
            ],
            "userAccount" => [
                "email" => "bob@gmail.com",
                "username" => "bobbo",
                "phone" => "5555551212",
                "createdDate" => "2013-01-18T17:54:31-05:00",
                "accountNumber" => "54321",
                "lastOrderId" => "4321",
                "aggregateOrderCount" => 40,
                "aggregateOrderDollars" => 5000,
                "lastUpdateDate" => "2013-01-18T17:54:31-05:00"
            ],
            "seller" => [
                "name" => "We sell awesome stuff, Inc.",
                "email" => "wesellawesomestuff@gmail.com",
                "username" => "awesomestuff1234",
                "phone" => "8883334545",
                "domain" => "wesellawesomestuff.com",
                "createdDate" => "2012-01-09T12:33:34-04:00",
                "accountNumber" => "54321",
                "aggregateOrderCount" => 4000,
                "aggregateOrderDollars" => 3000000,
                "lastUpdateDate" => "2016-07-22T07:22:33-04:00",
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
                    "countryCode" => "US"
                ],
                "corporateAddress" => [
                    "streetAddress" => "410 Terry Ave",
                    "unit" => "3L",
                    "city" => "Seattle",
                    "provinceCode" => "WA",
                    "postalCode" => "98109",
                    "countryCode" => "US"
                ]
            ]
        ];

    }

}