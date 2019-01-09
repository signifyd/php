<?php
/**
 * AddressTest Test class for the Signifyd SDK
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
 * Class AddressTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class AddressTest extends TestCase
{
    /**
     * @var \PhpUnit\Framework\String
     */
    public $className = 'Signifyd\Models\Address';

    /**
     * Testing address with no argument passed
     *
     * @return void
     */
    public function testInitAddressWithoutParams()
    {
        $address = new \Signifyd\Models\Address();
        $this->assertInstanceOf($this->className, $address);
    }

    /**
     * Testing address with sting params passed
     *
     * @return void
     */
    public function testInitAddressWithStringParam()
    {
        $address = new \Signifyd\Models\Address('signifyd');
        $this->assertInstanceOf($this->className, $address);
    }

    /**
     * Testing address with an empty address array passed
     *
     * @return void
     */
    public function testInitAddressWithEmptyArrayParam()
    {
        $address = new \Signifyd\Models\Address([]);
        $this->assertInstanceOf($this->className, $address);
    }

    /**
     * Testing address with an unknown properties passed
     *
     * @return void
     */
    public function testInitAddressWithUnknownProperties()
    {
        $addressData = [
            'wow' => 'test',
            'foo' => 'bar'
        ];
        $address = new \Signifyd\Models\Address($addressData);
        $this->assertInstanceOf($this->className, $address);
        $jsonAddress = $address->toJson();
        $emptyJsonAddress = json_encode([
            'streetAddress' => null,
            'unit' => null,
            'city' => null,
            'provinceCode' => null,
            'postalCode' => null,
            'countryCode' => null,
            'latitude' => null,
            'longitude' => null
        ]);

        $this->assertEquals($jsonAddress, $emptyJsonAddress);
    }

    /**
     * Testing address with an empty address array passed
     *
     * @return void
     */
    public function testInitAddressWithCorrectParams()
    {
        $addressData = [
            'streetAddress' => '123 State Street',
            'unit' => '2A',
            'city' => 'Chicago',
            'provinceCode' => 'IL',
            'postalCode' => '60622',
            'countryCode' => 'US',
            'latitude' => '61.116',
            'longitude' => '10.047'
        ];
        $address = new \Signifyd\Models\Address($addressData);
        $this->assertInstanceOf($this->className, $address);
    }

    /**
     * Testing address with an empty address array passed
     *
     * @return void
     */
    public function testExpectedJsonWithCorrectParams()
    {
        $addressData = [
            'streetAddress' => '123 State Street',
            'unit' => '2A',
            'city' => 'Chicago',
            'provinceCode' => 'IL',
            'postalCode' => '60622',
            'countryCode' => 'US',
            'latitude' => '61.116',
            'longitude' => '10.047'
        ];
        $address = new \Signifyd\Models\Address($addressData);

        $jsonAddressData = json_encode($addressData);
        $jsonAddress = $address->toJson();

        $this->assertEquals($jsonAddressData, $jsonAddress);
    }

    /**
     * Testing address with an empty address array passed
     *
     * @return void
     */
    public function testValidateAddressWithCorrectParams()
    {
        $addressData = [
            'streetAddress' => '123 State Street',
            'unit' => '2A',
            'city' => 'Chicago',
            'provinceCode' => 'IL',
            'postalCode' => '60622',
            'countryCode' => 'US',
            'latitude' => '61.116',
            'longitude' => '10.047'
        ];
        $address = new \Signifyd\Models\Address($addressData);
        $valid = $address->validate();

        $this->assertTrue($valid);
    }

    /* Disable until there is a real validation for Address */
    /**
     * Testing address with an empty address array passed
     *
     * @return void
     */
//    public function testValidateAddressWithWrongParams()
//    {
//        $addressData = [];
//        $address = new \Signifyd\Models\Address($addressData);
//        $valid = $address->validate();
//
//        $this->assertNotTrue($valid);
//    }
    /* End disable until there is a real validation for Address */
}