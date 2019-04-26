<?php
/**
 * ShipmentTest Test class for the Signifyd SDK
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
 * Class ShipmentTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class ShipmentTest extends TestCase
{
    /**
     * The class name tested class
     *
     * @var \PhpUnit\Framework\String
     */
    public $className = 'Signifyd\Models\Shipment';

    /**
     * The validation type
     *
     * @var \PhpUnit\Framework\String
     */
    public $validType = 'array';

    /**
     * Testing shipment with no argument passed
     *
     * @return void
     */
    public function testInitShipmentWithoutParams()
    {
        $shipment = new \Signifyd\Models\Shipment();
        $this->assertInstanceOf($this->className, $shipment);
    }

    /**
     * Testing shipment with sting params passed
     *
     * @return void
     */
    public function testInitShipmentWithStringParam()
    {
        $shipment = new \Signifyd\Models\Shipment('signifyd');
        $this->assertInstanceOf($this->className, $shipment);
    }

    /**
     * Testing shipment with an empty shipment array passed
     *
     * @return void
     */
    public function testInitShipmentWithEmptyArrayParam()
    {
        $shipment = new \Signifyd\Models\Shipment([]);
        $this->assertInstanceOf($this->className, $shipment);
    }

    /**
     * Testing shipment with an unknown properties passed
     *
     * @return void
     */
    public function testInitShipmentWithUnknownProperties()
    {
        $shipmentData = [
            'wow' => 'test',
            'foo' => 'bar'
        ];
        $shipment = new \Signifyd\Models\Shipment($shipmentData);
        $this->assertInstanceOf($this->className, $shipment);
        $jsonShipment = $shipment->toJson();
        $emptyJsonShipment = json_encode(
            [
                "shipper" => null,
                "shippingMethod" => null,
                "shippingPrice" => null,
                "trackingNumber" => null
            ]
        );

        $this->assertEquals($jsonShipment, $emptyJsonShipment);
    }

    /**
     * Testing shipment with an empty shipment array passed
     *
     * @return void
     */
    public function testInitShipmentWithCorrectParams()
    {
        $shipmentData = [
            "shipper" => "UPS",
            "shippingMethod" => "ground",
            "shippingPrice" => 10,
            "trackingNumber" => "io89347890we78h8909sd"
        ];
        $shipment = new \Signifyd\Models\Shipment($shipmentData);
        $this->assertInstanceOf($this->className, $shipment);
    }

    /**
     * Testing shipment with an empty shipment array passed
     *
     * @return void
     */
    public function testExpectedJsonWithCorrectParams()
    {
        $shipmentData = [
            "shipper" => "UPS",
            "shippingMethod" => "ground",
            "shippingPrice" => 10,
            "trackingNumber" => "io89347890we78h8909sd"
        ];
        $shipment = new \Signifyd\Models\Shipment($shipmentData);

        $jsonShipmentData = json_encode($shipmentData);
        $jsonShipment = $shipment->toJson();

        $this->assertEquals($jsonShipmentData, $jsonShipment);
    }

    /**
     * Testing shipment with an empty shipment array passed
     *
     * @return void
     */
    public function testValidateShipmentWithCorrectParams()
    {
        $shipmentData = [
            "shipper" => "UPS",
            "shippingMethod" => "ground",
            "shippingPrice" => 10,
            "trackingNumber" => "io89347890we78h8909sd"
        ];
        $shipment = new \Signifyd\Models\Shipment($shipmentData);
        $valid = $shipment->validate();

        $this->assertTrue($valid);
    }

    /* Disable until there is a real validation for Shipment */
    /**
     * Testing shipment with an empty shipment array passed
     *
     * @return void
     */
    //public function testValidateShipmentWithWrongParams()
    //{
        //$shipmentData = [];
        //$shipment = new \Signifyd\Models\Shipment($shipmentData);
        //$valid = $shipment->validate();

        //$this->assertNotTrue($valid);
    //}
    /* End disable until there is a real validation for Shipment */

    /**
     * Testing shipment with a wrong shipper
     *
     * @return void
     */
    public function testValidateShipmentWithWrongShipperParam()
    {
        $shipmentData = [
            "shipper" => "signifyd",
            "shippingMethod" => "ground",
            "shippingPrice" => 10,
            "trackingNumber" => "io89347890we78h8909sd"
        ];
        $shipment = new \Signifyd\Models\Shipment($shipmentData);
        $valid = $shipment->validate();

        $this->assertInternalType($this->validType, $valid);
        $this->assertEquals('Invalid Shipper', $valid[0]);
    }

    /**
     * Testing shipment with a wrong shipping method
     *
     * @return void
     */
    public function testValidateShipmentWithWrongShippingMethodParam()
    {
        $shipmentData = [
            "shipper" => "UPS",
            "shippingMethod" => "signifyd",
            "shippingPrice" => 10,
            "trackingNumber" => "io89347890we78h8909sd"
        ];
        $shipment = new \Signifyd\Models\Shipment($shipmentData);
        $valid = $shipment->validate();

        $this->assertInternalType($this->validType, $valid);
        $this->assertEquals('Invalid Shipping Method', $valid[0]);
    }

    /**
     * Testing shipment with a wrong shipper and shipping method
     *
     * @return void
     */
    public function testValidateShipmentWithWrongShipperShippingMethodParam()
    {
        $shipmentData = [
            "shipper" => "signifyd",
            "shippingMethod" => "signifyd",
            "shippingPrice" => 10,
            "trackingNumber" => "io89347890we78h8909sd"
        ];
        $shipment = new \Signifyd\Models\Shipment($shipmentData);
        $valid = $shipment->validate();

        $this->assertInternalType($this->validType, $valid);
        $this->assertEquals('Invalid Shipper', $valid[0]);
        $this->assertEquals('Invalid Shipping Method', $valid[1]);
    }
}