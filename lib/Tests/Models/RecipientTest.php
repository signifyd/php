<?php
/**
 * RecipientTest Test class for the Signifyd SDK
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
 * Class RecipientTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class RecipientTest extends TestCase
{
    /**
     * The class name tested class
     *
     * @var \PhpUnit\Framework\String
     */
    public $className = 'Signifyd\Models\Recipient';

    /**
     * Testing recipient with no argument passed
     *
     * @return void
     */
    public function testInitRecipientWithoutParams()
    {
        $recipient = new \Signifyd\Models\Recipient();
        $this->assertInstanceOf($this->className, $recipient);
    }

    /**
     * Testing recipient with sting params passed
     *
     * @return void
     */
    public function testInitRecipientWithStringParam()
    {
        $recipient = new \Signifyd\Models\Recipient('signifyd');
        $this->assertInstanceOf($this->className, $recipient);
    }

    /**
     * Testing recipient with an empty recipient array passed
     *
     * @return void
     */
    public function testInitRecipientWithEmptyArrayParam()
    {
        $recipient = new \Signifyd\Models\Recipient([]);
        $this->assertInstanceOf($this->className, $recipient);
    }

    /**
     * Testing recipient with an unknown properties passed
     *
     * @return void
     */
    public function testInitRecipientWithUnknownProperties()
    {
        $recipientData = [
            'wow' => 'test',
            'foo' => 'bar'
        ];
        $recipient = new \Signifyd\Models\Recipient($recipientData);
        $this->assertInstanceOf($this->className, $recipient);
        $jsonRecipient = $recipient->toJson();
        $emptyJsonRecipient = json_encode(
            [
                'fullName' => null,
                'confirmationEmail' => null,
                'confirmationPhone' => null,
                'organization' => null,
                'deliveryAddress' => null
            ]
        );

        $this->assertEquals($jsonRecipient, $emptyJsonRecipient);
    }

    /**
     * Testing recipient with an empty recipient array passed
     *
     * @return void
     */
    public function testInitRecipientWithCorrectParams()
    {
        $recipientData = [
            'fullName' => "Bob Smith",
            'confirmationEmail' => "bob@gmail.com",
            'confirmationPhone' => "5047130000",
            'organization' => "SIGNIFYD",
            'deliveryAddress' => [
                "streetAddress" => "123 State Street",
                "unit" => "2A",
                "city" => "Chicago",
                "provinceCode" => "IL",
                "postalCode" => "60622",
                "countryCode" => "US",
                "latitude" => null,
                "longitude" => null
            ]
        ];
        $recipient = new \Signifyd\Models\Recipient($recipientData);
        $this->assertInstanceOf($this->className, $recipient);
    }

    /**
     * Testing recipient with an empty recipient array passed
     *
     * @return void
     */
    public function testExpectedJsonWithCorrectParams()
    {
        $recipientData = [
            'fullName' => "Bob Smith",
            'confirmationEmail' => "bob@gmail.com",
            'confirmationPhone' => "5047130000",
            'organization' => "SIGNIFYD",
            'deliveryAddress' => [
                "streetAddress" => "123 State Street",
                "unit" => "2A",
                "city" => "Chicago",
                "provinceCode" => "IL",
                "postalCode" => "60622",
                "countryCode" => "US",
                "latitude" => null,
                "longitude" => null
            ]
        ];
        $recipient = new \Signifyd\Models\Recipient($recipientData);

        $jsonRecipientData = json_encode($recipientData);
        $jsonRecipient = $recipient->toJson();

        $this->assertEquals($jsonRecipientData, $jsonRecipient);
    }

    /**
     * Testing recipient with an empty recipient array passed
     *
     * @return void
     */
    public function testValidateRecipientWithCorrectParams()
    {
        $recipientData = [
            'fullName' => "Bob Smith",
            'confirmationEmail' => "bob@gmail.com",
            'confirmationPhone' => "5047130000",
            'organization' => "SIGNIFYD",
            'deliveryAddress' => [
                "streetAddress" => "123 State Street",
                "unit" => "2A",
                "city" => "Chicago",
                "provinceCode" => "IL",
                "postalCode" => "60622",
                "countryCode" => "US",
                "latitude" => null,
                "longitude" => null
            ]
        ];
        $recipient = new \Signifyd\Models\Recipient($recipientData);
        $valid = $recipient->validate();

        $this->assertTrue($valid);
    }

    /* Disable until there is a real validation for Recipient */
    /**
     * Testing recipient with an empty recipient array passed
     *
     * @return void
     */
    //public function testValidateRecipientWithWrongParams()
    //{
        //$recipientData = [];
        //$recipient = new \Signifyd\Models\Recipient($recipientData);
        //$valid = $recipient->validate();

        //$this->assertNotTrue($valid);
    //}
    /* End disable until there is a real validation for Recipient */

}