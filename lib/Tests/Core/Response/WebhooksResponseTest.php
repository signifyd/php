<?php
/**
 * WebhooksResponseTest Test class for the Signifyd SDK
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
 * Class WebhooksResponseTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class WebhooksResponseTest extends TestCase
{
    /**
     * Testing settings with no argument passed
     *
     * @expectedException \ArgumentCountError
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testWebhooksResponseWithoutParam()
    {
        $webhooksResponse = new \Signifyd\Core\Response\WebhooksResponse();
    }

    /**
     * Test webooks response with invalid string param
     *
     * @expectedException        \Signifyd\Core\Exceptions\LoggerException
     * @expectedExceptionMessage Invalid logger parameter
     *
     * @return void
     */
    public function testWebhooksResponseWithStringParam()
    {
        $webhooksResponse = new \Signifyd\Core\Response\WebhooksResponse('signifyd');
    }

    /**
     * Test webhooks response with invalid object param
     *
     * @expectedException        \Signifyd\Core\Exceptions\LoggerException
     * @expectedExceptionMessage Invalid logger parameter
     *
     * @return void
     */
    public function testWebhooksResponseWithInvalidObjectParam()
    {
        $anObject = new \StdClass();
        $webhooksResponse = new \Signifyd\Core\Response\WebhooksResponse($anObject);
    }

    /**
     * Test webhooks response with valid params
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testWebhooksResponseWithValidParam()
    {
        $settings = new \Signifyd\Core\Settings();
        $anObject = new \Signifyd\Core\Logging($settings);
        $webhooksResponse = new \Signifyd\Core\Response\WebhooksResponse($anObject);
        $this->assertEquals(
            'Signifyd\Core\Response\WebhooksResponse', get_class($webhooksResponse)
        );
    }

    /**
     * Test webhooks response setError method without params
     *
     * @expectedException \ArgumentCountError
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testWebhooksResponseSetErrorWithoutParam()
    {
        $settings = new \Signifyd\Core\Settings(['apiKey' => 'your api key']);
        $anObject = new \Signifyd\Core\Logging($settings);
        $webhooksResponse = new \Signifyd\Core\Response\WebhooksResponse($anObject);
        $webhooksResponse->setError();
    }

    /**
     * Test webhooks response setError method with one param
     *
     * @expectedException \ArgumentCountError
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testWebhooksResponseSetErrorWithoutOneParam()
    {
        $settings = new \Signifyd\Core\Settings(['apiKey' => 'your api key']);
        $anObject = new \Signifyd\Core\Logging($settings);
        $webhooksResponse = new \Signifyd\Core\Response\WebhooksResponse($anObject);
        $webhooksResponse->setError(500);
    }

    /**
     * Test webhooks response setError method with valid params
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testWebhooksResponseSetError()
    {
        $settings = new \Signifyd\Core\Settings(['apiKey' => 'your api key']);
        $anObject = new \Signifyd\Core\Logging($settings);
        $webhooksResponse = new \Signifyd\Core\Response\WebhooksResponse($anObject);
        $webhooksResponse->setError(500, 'Signifyd Error');
        $this->assertTrue($webhooksResponse->isError());
        $this->assertEquals('Signifyd Error', $webhooksResponse->getErrorMessage());
    }

}