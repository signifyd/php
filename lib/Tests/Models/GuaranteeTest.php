<?php
/**
 * GuaranteeTest Test class for the Signifyd SDK
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
 * Class GuaranteeTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class GuaranteeTest extends TestCase
{
    /**
     * The class name tested class
     *
     * @var \PhpUnit\Framework\String
     */
    public $className = 'Signifyd\Models\Guarantee';

    /**
     * Testing guarantee with no argument passed
     *
     * @return void
     */
    public function testInitGuaranteeWithoutParams()
    {
        $guarantee = new \Signifyd\Models\Guarantee();
        $this->assertInstanceOf($this->className, $guarantee);
    }

    /**
     * Testing guarantee with sting params passed
     *
     * @return void
     */
    public function testInitGuaranteeWithStringParam()
    {
        $guarantee = new \Signifyd\Models\Guarantee('signifyd');
        $this->assertInstanceOf($this->className, $guarantee);
    }

    /**
     * Testing guarantee with an empty guarantee array passed
     *
     * @return void
     */
    public function testInitGuaranteeWithEmptyArrayParam()
    {
        $guarantee = new \Signifyd\Models\Guarantee([]);
        $this->assertInstanceOf($this->className, $guarantee);
    }

    /**
     * Testing guarantee with an unknown properties passed
     *
     * @return void
     */
    public function testInitGuaranteeWithUnknownProperties()
    {
        $guaranteeData = [
            'wow' => 'test',
            'foo' => 'bar'
        ];
        $guarantee = new \Signifyd\Models\Guarantee($guaranteeData);
        $this->assertInstanceOf($this->className, $guarantee);
        $jsonGuarantee = $guarantee->toJson();
        $emptyJsonGuarantee = json_encode(
            [
                "caseId" => null
            ]
        );

        $this->assertEquals($jsonGuarantee, $emptyJsonGuarantee);
    }

    /**
     * Testing guarantee with an empty guarantee array passed
     *
     * @return void
     */
    public function testInitGuaranteeWithCorrectParams()
    {
        $guaranteeData = [
            "caseId" => 125155418741
        ];
        $guarantee = new \Signifyd\Models\Guarantee($guaranteeData);
        $this->assertInstanceOf($this->className, $guarantee);
    }

    /**
     * Testing guarantee with an empty guarantee array passed
     *
     * @return void
     */
    public function testExpectedJsonWithCorrectParams()
    {
        $guaranteeData = [
            "caseId" => 125155418741
        ];
        $guarantee = new \Signifyd\Models\Guarantee($guaranteeData);

        $jsonGuaranteeData = json_encode($guaranteeData);
        $jsonGuarantee = $guarantee->toJson();

        $this->assertEquals($jsonGuaranteeData, $jsonGuarantee);
    }

    /**
     * Testing guarantee with an empty guarantee array passed
     *
     * @return void
     */
    public function testValidateGuaranteeWithCorrectParams()
    {
        $guaranteeData = [
            "caseId" => 125155418741
        ];
        $guarantee = new \Signifyd\Models\Guarantee($guaranteeData);
        $valid = $guarantee->validate();

        $this->assertTrue($valid);
    }

    /* Disable until there is a real validation for Guarantee */
    /**
     * Testing guarantee with an empty guarantee array passed
     *
     * @return void
     */
    //public function testValidateGuaranteeWithWrongParams()
    //{
        //$guaranteeData = [];
        //$guarantee = new \Signifyd\Models\Guarantee($guaranteeData);
        //$valid = $guarantee->validate();

        //$this->assertNotTrue($valid);
    //}
    /* End disable until there is a real validation for Guarantee */

}