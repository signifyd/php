<?php
/**
 * SellerTest Test class for the Signifyd SDK
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
 * Class SellerTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class SellerTest extends TestCase
{
    /**
     * The class name tested class
     *
     * @var \PhpUnit\Framework\String
     */
    public $className = 'Signifyd\Models\Seller';

    /**
     * Testing seller with no argument passed
     *
     * @return void
     */
    public function testInitSellerWithoutParams()
    {
        $seller = new \Signifyd\Models\Seller();
        $this->assertInstanceOf($this->className, $seller);
    }

    /**
     * Testing seller with sting params passed
     *
     * @return void
     */
    public function testInitSellerWithStringParam()
    {
        $seller = new \Signifyd\Models\Seller('signifyd');
        $this->assertInstanceOf($this->className, $seller);
    }

    /**
     * Testing seller with an empty seller array passed
     *
     * @return void
     */
    public function testInitSellerWithEmptyArrayParam()
    {
        $seller = new \Signifyd\Models\Seller([]);
        $this->assertInstanceOf($this->className, $seller);
    }

    /**
     * Testing seller with an unknown properties passed
     *
     * @return void
     */
    public function testInitSellerWithUnknownProperties()
    {
        $sellerData = [
            'wow' => 'test',
            'foo' => 'bar'
        ];
        $seller = new \Signifyd\Models\Seller($sellerData);
        $this->assertInstanceOf($this->className, $seller);
        $jsonSeller = $seller->toJson();
        $emptyJsonSeller = json_encode(
            [
                "name" => null,
                "domain" => null,
                "email" => null,
                "username" => null,
                "accountNumber" => null,
                "phone" => null,
                "createdDate" => null,
                "aggregateOrderCount" => null,
                "aggregateOrderDollars" => null,
                "lastUpdateDate" => null,
                "onboardingIpAddress" => null,
                "onboardingEmail" => null,
                "tags" => null,
                "shipFromAddress" => null,
                "corporateAddress" => null
            ]
        );

        $this->assertEquals($jsonSeller, $emptyJsonSeller);
    }

    /**
     * Testing seller with an empty seller array passed
     *
     * @return void
     */
    public function testInitSellerWithCorrectParams()
    {
        $sellerData = [
            "name" => "We sell awesome stuff, Inc.",
            "domain" => "wesellawesomestuff.com",
            "email" => "wesellawesomestuff@gmail.com",
            "username" => "awesomestuff1234",
            "accountNumber" => "54321",
            "phone" => "8883334545",
            "createdDate" => date(DATE_ATOM),
            "aggregateOrderCount" => 4000,
            "aggregateOrderDollars" => 3000000,
            "lastUpdateDate" => date(DATE_ATOM),
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
                "latitude" => "61.116",
                "longitude" => "10.047"
            ],
            "corporateAddress" => [
                "streetAddress" => "410 Terry Ave",
                "unit" => "3L",
                "city" => "Seattle",
                "provinceCode" => "WA",
                "postalCode" => "98109",
                "countryCode" => "US",
                "latitude" => "61.116",
                "longitude" => "10.047"
            ]
        ];
        $seller = new \Signifyd\Models\Seller($sellerData);
        $this->assertInstanceOf($this->className, $seller);
    }

    /**
     * Testing seller with an empty seller array passed
     *
     * @return void
     */
    public function testExpectedJsonWithCorrectParams()
    {
        $sellerData = [
            "name" => "We sell awesome stuff, Inc.",
            "domain" => "wesellawesomestuff.com",
            "email" => "wesellawesomestuff@gmail.com",
            "username" => "awesomestuff1234",
            "accountNumber" => "54321",
            "phone" => "8883334545",
            "createdDate" => date(DATE_ATOM),
            "aggregateOrderCount" => 4000,
            "aggregateOrderDollars" => 3000000,
            "lastUpdateDate" => date(DATE_ATOM),
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
                "latitude" => "61.116",
                "longitude" => "10.047"
            ],
            "corporateAddress" => [
                "streetAddress" => "410 Terry Ave",
                "unit" => "3L",
                "city" => "Seattle",
                "provinceCode" => "WA",
                "postalCode" => "98109",
                "countryCode" => "US",
                "latitude" => "61.116",
                "longitude" => "10.047"
            ]
        ];
        $seller = new \Signifyd\Models\Seller($sellerData);

        $jsonSellerData = json_encode($sellerData);
        $jsonSeller = $seller->toJson();

        $this->assertEquals($jsonSellerData, $jsonSeller);
    }

    /**
     * Testing seller with an empty seller array passed
     *
     * @return void
     */
    public function testValidateSellerWithCorrectParams()
    {
        $sellerData = [
            "name" => "We sell awesome stuff, Inc.",
            "domain" => "wesellawesomestuff.com",
            "email" => "wesellawesomestuff@gmail.com",
            "username" => "awesomestuff1234",
            "accountNumber" => "54321",
            "phone" => "8883334545",
            "createdDate" => date(DATE_ATOM),
            "aggregateOrderCount" => 4000,
            "aggregateOrderDollars" => 3000000,
            "lastUpdateDate" => date(DATE_ATOM),
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
                "latitude" => "61.116",
                "longitude" => "10.047"
            ],
            "corporateAddress" => [
                "streetAddress" => "410 Terry Ave",
                "unit" => "3L",
                "city" => "Seattle",
                "provinceCode" => "WA",
                "postalCode" => "98109",
                "countryCode" => "US",
                "latitude" => "61.116",
                "longitude" => "10.047"
            ]
        ];
        $seller = new \Signifyd\Models\Seller($sellerData);
        $valid = $seller->validate();

        $this->assertTrue($valid);
    }

    /* Disable until there is a real validation for Seller */
    /**
     * Testing seller with an empty seller array passed
     *
     * @return void
     */
    //public function testValidateSellerWithWrongParams()
    //{
        //$sellerData = [];
        //$seller = new \Signifyd\Models\Seller($sellerData);
        //$valid = $seller->validate();

        //$this->assertNotTrue($valid);
    //}
    /* End disable until there is a real validation for Seller */


}