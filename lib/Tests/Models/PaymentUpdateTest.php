<?php
/**
 * PaymentUpdateTest Test class for the Signifyd SDK
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
 * Class PaymentUpdateTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class PaymentUpdateTest extends TestCase
{
    /**
     * @var \PhpUnit\Framework\String
     */
    public $className = 'Signifyd\Models\PaymentUpdate';

    /**
     * @var \PhpUnit\Framework\String
     */
    public $validType = 'array';

    /**
     * Testing payment update with no argument passed
     *
     * @return void
     */
    public function testInitPaymentUpdateWithoutParams()
    {
        $paymentUpdate = new \Signifyd\Models\PaymentUpdate();
        $this->assertInstanceOf($this->className, $paymentUpdate);
    }

    /**
     * Testing payment update with sting params passed
     *
     * @return void
     */
    public function testInitPaymentUpdateWithStringParam()
    {
        $paymentUpdate = new \Signifyd\Models\PaymentUpdate('signifyd');
        $this->assertInstanceOf($this->className, $paymentUpdate);
    }

    /**
     * Testing payment update with an empty payment update array passed
     *
     * @return void
     */
    public function testInitPaymentUpdateWithEmptyArrayParam()
    {
        $paymentUpdate = new \Signifyd\Models\PaymentUpdate([]);
        $this->assertInstanceOf($this->className, $paymentUpdate);
    }

    /**
     * Testing payment update with an unknown properties passed
     *
     * @return void
     */
    public function testInitPaymentUpdateWithUnknownProperties()
    {
        $paymentUpdateData = [
            'wow' => 'test',
            'foo' => 'bar'
        ];
        $paymentUpdate = new \Signifyd\Models\PaymentUpdate($paymentUpdateData);
        $this->assertInstanceOf($this->className, $paymentUpdate);
        $jsonPaymentUpdate = $paymentUpdate->toJson();
        $emptyJsonPaymentUpdate = json_encode([
            "caseId" => null,
            "paymentGateway" => null,
            "transactionId" => null,
            "avsResponseCode" => null,
            "cvvResponseCode" => null
        ]);

        $this->assertEquals($jsonPaymentUpdate, $emptyJsonPaymentUpdate);
    }

    /**
     * Testing payment update with an empty payment update array passed
     *
     * @return void
     */
    public function testInitPaymentUpdateWithCorrectParams()
    {
        $paymentUpdateData = [
            "caseId" => 12345,
            "paymentGateway" => "stripe",
            "transactionId" => "1a2sf3f44e21r1",
            "avsResponseCode" => "Y",
            "cvvResponseCode" => "M"
        ];
        $paymentUpdate = new \Signifyd\Models\PaymentUpdate($paymentUpdateData);
        $this->assertInstanceOf($this->className, $paymentUpdate);
    }

    /**
     * Testing payment update with an empty payment update array passed
     *
     * @return void
     */
    public function testExpectedJsonWithCorrectParams()
    {
        $paymentUpdateData = [
            "caseId" => 12345,
            "paymentGateway" => "stripe",
            "transactionId" => "1a2sf3f44e21r1",
            "avsResponseCode" => "Y",
            "cvvResponseCode" => "M"
        ];
        $paymentUpdate = new \Signifyd\Models\PaymentUpdate($paymentUpdateData);

        $jsonPaymentUpdateData = json_encode($paymentUpdateData);
        $jsonPaymentUpdate = $paymentUpdate->toJson();

        $this->assertEquals($jsonPaymentUpdateData, $jsonPaymentUpdate);
    }

    /**
     * Testing payment update with an empty payment update array passed
     *
     * @return void
     */
    public function testValidatePaymentUpdateWithCorrectParams()
    {
        $paymentUpdateData = [
            "caseId" => 12345,
            "paymentGateway" => "stripe",
            "transactionId" => "1a2sf3f44e21r1",
            "avsResponseCode" => "Y",
            "cvvResponseCode" => "M"
        ];
        $paymentUpdate = new \Signifyd\Models\PaymentUpdate($paymentUpdateData);
        $valid = $paymentUpdate->validate();

        $this->assertTrue($valid);
    }

    /**
     * Testing payment update with a wrong avs code
     *
     * @return void
     */
    public function testValidatePaymentUpdateWithWrongAvsParam()
    {
        $paymentUpdateData = [
            "caseId" => 12345,
            "paymentGateway" => "stripe",
            "transactionId" => "1a2sf3f44e21r1",
            "avsResponseCode" => "j",
            "cvvResponseCode" => "M"
        ];
        $paymentUpdate = new \Signifyd\Models\PaymentUpdate($paymentUpdateData);
        $valid = $paymentUpdate->validate();

        $this->assertInternalType($this->validType, $valid);
        $this->assertEquals('Invalid AVS code', $valid[0]);
    }

    /**
     * Testing payment update with a wrong cvv code
     *
     * @return void
     */
    public function testValidatePaymentUpdateWithWrongCvvParam()
    {
        $paymentUpdateData = [
            "caseId" => 12345,
            "paymentGateway" => "stripe",
            "transactionId" => "1a2sf3f44e21r1",
            "avsResponseCode" => "Y",
            "cvvResponseCode" => "j"
        ];
        $paymentUpdate = new \Signifyd\Models\PaymentUpdate($paymentUpdateData);
        $valid = $paymentUpdate->validate();

        $this->assertInternalType($this->validType, $valid);
        $this->assertEquals('Invalid CVV code', $valid[0]);
    }

    /**
     * Testing payment update with a wrong cvv and avs code
     *
     * @return void
     */
    public function testValidatePaymentUpdateWithWrongCvvAvsParam()
    {
        $paymentUpdateData = [
            "caseId" => 12345,
            "paymentGateway" => "stripe",
            "transactionId" => "1a2sf3f44e21r1",
            "avsResponseCode" => "j",
            "cvvResponseCode" => "j"
        ];
        $paymentUpdate = new \Signifyd\Models\PaymentUpdate($paymentUpdateData);
        $valid = $paymentUpdate->validate();

        $this->assertInternalType($this->validType, $valid);
        $this->assertEquals('Invalid AVS code', $valid[0]);
        $this->assertEquals('Invalid CVV code', $valid[1]);
    }

}