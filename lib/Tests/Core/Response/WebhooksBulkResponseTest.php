<?php
/**
 * WebhooksBulkResponseTest Test class for the Signifyd SDK
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
 * Class WebhooksBulkResponseTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class WebhooksBulkResponseTest extends TestCase
{
    /**
     * Testing settings with no argument passed
     *
     * @expectedException \ArgumentCountError
     *
     * @return void
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     */
    public function testWebhooksBulkResponseWithoutParam()
    {
        $response = new \Signifyd\Core\Response\WebhooksBulkResponse();
    }

    /**
     * Test webhooks bulk response with invalid string param
     *
     * @expectedException        \Signifyd\Core\Exceptions\LoggerException
     * @expectedExceptionMessage Invalid logger parameter
     *
     * @return void
     */
    public function testWebhooksBulkResponseWithStringParam()
    {
        $response = new \Signifyd\Core\Response\WebhooksBulkResponse('signifyd');
    }

    /**
     * Test webhooks bulk response with invalid object param
     *
     * @expectedException        \Signifyd\Core\Exceptions\LoggerException
     * @expectedExceptionMessage Invalid logger parameter
     *
     * @return void
     */
    public function testWebhooksBulkResponseWithInvalidObjectParam()
    {
        $anObject = new \StdClass();
        $response = new \Signifyd\Core\Response\WebhooksBulkResponse($anObject);
    }

    /**
     * Test webhooks bulk response with valid params
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testWebhooksBulkResponseWithValidParam()
    {
        $settings = new \Signifyd\Core\Settings();
        $anObject = new \Signifyd\Core\Logging($settings);
        $response = new \Signifyd\Core\Response\WebhooksBulkResponse($anObject);
        $this->assertEquals(
            'Signifyd\Core\Response\WebhooksBulkResponse', get_class($response)
        );
    }

    /**
     * Test webhook bulk response setError method without params
     *
     * @expectedException \ArgumentCountError
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testWebhooksBulkResponseSetErrorWithoutParam()
    {
        $settings = new \Signifyd\Core\Settings(['apiKey' => 'your api key']);
        $anObject = new \Signifyd\Core\Logging($settings);
        $response = new \Signifyd\Core\Response\WebhooksBulkResponse($anObject);
        $response->setError();
    }

    /**
     * Test webhooks bulk response setError method without one param
     *
     * @expectedException \ArgumentCountError
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testWebhooksBulkResponseSetErrorWithoutOneParam()
    {
        $settings = new \Signifyd\Core\Settings(['apiKey' => 'your api key']);
        $anObject = new \Signifyd\Core\Logging($settings);
        $response = new \Signifyd\Core\Response\WebhooksBulkResponse($anObject);
        $response->setError(500);
    }

    /**
     * Test webhooks bulk response setError method with valid params
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testWebhooksBulkResponseSetError()
    {
        $settings = new \Signifyd\Core\Settings(['apiKey' => 'your api key']);
        $anObject = new \Signifyd\Core\Logging($settings);
        $response = new \Signifyd\Core\Response\WebhooksBulkResponse($anObject);
        $response->setError(500, 'Signifyd Error');
        $this->assertTrue($response->isError());
        $this->assertEquals('Signifyd Error', $response->getErrorMessage());
    }

}