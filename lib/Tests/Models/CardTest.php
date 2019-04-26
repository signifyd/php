<?php
/**
 * CardTest Test class for the Signifyd SDK
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
 * Class CardTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class CardTest extends TestCase
{
    /**
     * The class name tested class
     *
     * @var \PhpUnit\Framework\String
     */
    public $className = 'Signifyd\Models\Card';

    /**
     * Testing card with no argument passed
     *
     * @return void
     */
    public function testInitCardWithoutParams()
    {
        $card = new \Signifyd\Models\Card();
        $this->assertInstanceOf($this->className, $card);
    }

    /**
     * Testing card with sting params passed
     *
     * @return void
     */
    public function testInitCardWithStringParam()
    {
        $card = new \Signifyd\Models\Card('signifyd');
        $this->assertInstanceOf($this->className, $card);
    }

    /**
     * Testing card with an empty card array passed
     *
     * @return void
     */
    public function testInitCardWithEmptyArrayParam()
    {
        $card = new \Signifyd\Models\Card([]);
        $this->assertInstanceOf($this->className, $card);
    }

    /**
     * Testing card with an unknown properties passed
     *
     * @return void
     */
    public function testInitCardWithUnknownProperties()
    {
        $cardData = [
            'wow' => 'test',
            'foo' => 'bar'
        ];
        $card = new \Signifyd\Models\Card($cardData);
        $this->assertInstanceOf($this->className, $card);
        $jsonCard = $card->toJson();
        $emptyJsonCard = json_encode(
            [
                "cardHolderName" => null,
                "bin" => null,
                "last4" => null,
                "expiryMonth" => null,
                "expiryYear" => null,
                "hash" => null,
                "billingAddress" => null
            ]
        );

        $this->assertEquals($jsonCard, $emptyJsonCard);
    }

    /**
     * Testing card with an empty card array passed
     *
     * @return void
     */
    public function testInitCardWithCorrectParams()
    {
        $cardData = [
            "cardHolderName" => "Robert Smith",
            "bin" => 407441,
            "last4" => "1234",
            "expiryMonth" => 12,
            "expiryYear" => 2015,
            "hash" => '2515wecx584cfavcx',
            "billingAddress" => [
                "streetAddress" => '123 State Street',
                "unit" => "2A",
                "city" => "Chicago",
                "provinceCode" => "IL",
                "postalCode" => "60622",
                "countryCode" => "US",
                'latitude' => '61.116',
                'longitude' => '10.047'
            ]
        ];
        $card = new \Signifyd\Models\Card($cardData);
        $this->assertInstanceOf($this->className, $card);
    }

    /**
     * Testing card with an empty card array passed
     *
     * @return void
     */
    public function testExpectedJsonWithCorrectParams()
    {
        $cardData = [
            "cardHolderName" => "Robert Smith",
            "bin" => 407441,
            "last4" => "1234",
            "expiryMonth" => 12,
            "expiryYear" => 2015,
            "hash" => '2515wecx584cfavcx',
            "billingAddress" => [
                "streetAddress" => '123 State Street',
                "unit" => "2A",
                "city" => "Chicago",
                "provinceCode" => "IL",
                "postalCode" => "60622",
                "countryCode" => "US",
                'latitude' => '61.116',
                'longitude' => '10.047'
            ]
        ];
        $card = new \Signifyd\Models\Card($cardData);

        $jsonCardData = json_encode($cardData);
        $jsonCard = $card->toJson();

        $this->assertEquals($jsonCardData, $jsonCard);
    }

    /**
     * Testing card with an empty card array passed
     *
     * @return void
     */
    public function testValidateCardWithCorrectParams()
    {
        $cardData = [
            "cardHolderName" => "Robert Smith",
            "bin" => 407441,
            "last4" => "1234",
            "expiryMonth" => 12,
            "expiryYear" => 2015,
            "hash" => '2515wecx584cfavcx',
            "billingAddress" => [
                "streetAddress" => '123 State Street',
                "unit" => "2A",
                "city" => "Chicago",
                "provinceCode" => "IL",
                "postalCode" => "60622",
                "countryCode" => "US",
                'latitude' => '61.116',
                'longitude' => '10.047'
            ]
        ];
        $card = new \Signifyd\Models\Card($cardData);
        $valid = $card->validate();

        $this->assertTrue($valid);
    }

    /* Disable until there is a real validation for Card */
    /**
     * Testing card with an empty card array passed
     *
     * @return void
     */
    //public function testValidateCardWithWrongParams()
    //{
        //$cardData = [];
        //$card = new \Signifyd\Models\Card($cardData);
        //$valid = $card->validate();

        //$this->assertNotTrue($valid);
    //}
    /* End disable until there is a real validation for Card */

}