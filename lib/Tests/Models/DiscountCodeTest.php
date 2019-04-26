<?php
/**
 * DiscountCodeTest Test class for the Signifyd SDK
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
 * Class DiscountCodeTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class DiscountCodeTest extends TestCase
{
    /**
     * The class name tested class
     *
     * @var \PhpUnit\Framework\String
     */
    public $className = 'Signifyd\Models\DiscountCode';

    /**
     * Testing discount code with no argument passed
     *
     * @return void
     */
    public function testInitDiscountCodeWithoutParams()
    {
        $discountCode = new \Signifyd\Models\DiscountCode();
        $this->assertInstanceOf($this->className, $discountCode);
    }

    /**
     * Testing discount code with sting params passed
     *
     * @return void
     */
    public function testInitDiscountCodeWithStringParam()
    {
        $discountCode = new \Signifyd\Models\DiscountCode('signifyd');
        $this->assertInstanceOf($this->className, $discountCode);
    }

    /**
     * Testing discount code with an empty discount code array passed
     *
     * @return void
     */
    public function testInitDiscountCodeWithEmptyArrayParam()
    {
        $discountCode = new \Signifyd\Models\DiscountCode([]);
        $this->assertInstanceOf($this->className, $discountCode);
    }

    /**
     * Testing discount code with an unknown properties passed
     *
     * @return void
     */
    public function testInitDiscountCodeWithUnknownProperties()
    {
        $discountCodeData = [
            'wow' => 'test',
            'foo' => 'bar'
        ];
        $discountCode = new \Signifyd\Models\DiscountCode($discountCodeData);
        $this->assertInstanceOf($this->className, $discountCode);
        $jsonDiscountCode = $discountCode->toJson();
        $emptyJsonDiscountCode = json_encode(
            [
                'code' => null,
                'amount' => null,
                'percentage' => null
            ]
        );

        $this->assertEquals($jsonDiscountCode, $emptyJsonDiscountCode);
    }

    /**
     * Testing discount code with an empty discount code array passed
     *
     * @return void
     */
    public function testInitDiscountCodeWithCorrectParams()
    {
        $discountCodeData = [
            'code' => "TENDOLLARSOFF",
            'amount' => 10,
            'percentage' => null
        ];
        $discountCode = new \Signifyd\Models\DiscountCode($discountCodeData);
        $this->assertInstanceOf($this->className, $discountCode);
    }

    /**
     * Testing discount code with an empty discount code array passed
     *
     * @return void
     */
    public function testExpectedJsonWithCorrectParams()
    {
        $discountCodeData = [
            'code' => "TENDOLLARSOFF",
            'amount' => 10,
            'percentage' => null
        ];
        $discountCode = new \Signifyd\Models\DiscountCode($discountCodeData);

        $jsonDiscountCodeData = json_encode($discountCodeData);
        $jsonDiscountCode = $discountCode->toJson();

        $this->assertEquals($jsonDiscountCodeData, $jsonDiscountCode);
    }

    /**
     * Testing discount code with an empty discount code array passed
     *
     * @return void
     */
    public function testValidateDiscountCodeWithCorrectParams()
    {
        $discountCodeData = [
            'code' => "TENDOLLARSOFF",
            'amount' => 10,
            'percentage' => null
        ];
        $discountCode = new \Signifyd\Models\DiscountCode($discountCodeData);
        $valid = $discountCode->validate();

        $this->assertTrue($valid);
    }

    /* Disable until there is a real validation for DiscountCode */
    /**
     * Testing discount code with an empty discount code array passed
     *
     * @return void
     */
    //public function testValidateDiscountCodeWithWrongParams()
    //{
        //$discountCodeData = [];
        //$discountCode = new \Signifyd\Models\DiscountCode($discountCodeData);
        //$valid = $discountCode->validate();

        //$this->assertNotTrue($valid);
    //}
    /* End disable until there is a real validation for DiscountCode */

}