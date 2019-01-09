<?php
/**
 * WebhookTest Test class for the Signifyd SDK
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
 * Class WebhookTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class WebhookTest extends TestCase
{
    /**
     * @var \PhpUnit\Framework\String
     */
    public $className = 'Signifyd\Models\Webhook';

    /**
     * Testing webhook with no argument passed
     *
     * @return void
     */
    public function testInitWebhookWithoutParams()
    {
        $webhook = new \Signifyd\Models\Webhook();
        $this->assertInstanceOf($this->className, $webhook);
    }

    /**
     * Testing webhook with sting params passed
     *
     * @return void
     */
    public function testInitWebhookWithStringParam()
    {
        $webhook = new \Signifyd\Models\Webhook('signifyd');
        $this->assertInstanceOf($this->className, $webhook);
    }

    /**
     * Testing webhook with an empty webhook array passed
     *
     * @return void
     */
    public function testInitWebhookWithEmptyArrayParam()
    {
        $webhook = new \Signifyd\Models\Webhook([]);
        $this->assertInstanceOf($this->className, $webhook);
    }

    /**
     * Testing webhook with an unknown properties passed
     *
     * @return void
     */
    public function testInitWebhookWithUnknownProperties()
    {
        $webhookData = [
            'wow' => 'test',
            'foo' => 'bar'
        ];
        $webhook = new \Signifyd\Models\Webhook($webhookData);
        $this->assertInstanceOf($this->className, $webhook);
        $jsonWebhook = $webhook->toJson();
        $emptyJsonWebhook = json_encode([
            "event" => null,
            "url" => null
        ]);

        $this->assertEquals($jsonWebhook, $emptyJsonWebhook);
    }

    /**
     * Testing webhook with an empty webhook array passed
     *
     * @return void
     */
    public function testInitWebhookWithCorrectParams()
    {
        $webhookData = [
            "event" => "CASE_CREATE",
            "url" => "http://myurl.myurl"
        ];
        $webhook = new \Signifyd\Models\Webhook($webhookData);
        $this->assertInstanceOf($this->className, $webhook);
    }

    /**
     * Testing webhook with an empty webhook array passed
     *
     * @return void
     */
    public function testExpectedJsonWithCorrectParams()
    {
        $webhookData = [
            "event" => "CASE_CREATE",
            "url" => "http://myurl.myurl"
        ];
        $webhook = new \Signifyd\Models\Webhook($webhookData);

        $jsonWebhookData = json_encode($webhookData);
        $jsonWebhook = $webhook->toJson();

        $this->assertEquals($jsonWebhookData, $jsonWebhook);
    }

    /**
     * Testing webhook with an empty webhook array passed
     *
     * @return void
     */
    public function testValidateWebhookWithCorrectParams()
    {
        $webhookData = [
            "event" => "CASE_CREATE",
            "url" => "http://myurl.myurl"
        ];
        $webhook = new \Signifyd\Models\Webhook($webhookData);
        $valid = $webhook->validate();

        $this->assertTrue($valid);
    }

    /* Disable until there is a real validation for Webhook */
    /**
     * Testing webhook with an empty webhook array passed
     *
     * @return void
     */
//    public function testValidateWebhookWithWrongParams()
//    {
//        $webhookData = [];
//        $webhook = new \Signifyd\Models\Webhook($webhookData);
//        $valid = $webhook->validate();
//
//        $this->assertNotTrue($valid);
//    }
    /* End disable until there is a real validation for Webhook */


}