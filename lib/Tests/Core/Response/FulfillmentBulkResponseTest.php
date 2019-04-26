<?php
/**
 * FulfillmentBulkResponseTest Test class for the Signifyd SDK
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
 * Class FulfillmentBulkResponseTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class FulfillmentBulkResponseTest extends TestCase
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
    public function testFulfillmentBulkResponseWithoutParam()
    {
        $response = new \Signifyd\Core\Response\FulfillmentBulkResponse();
    }

    /**
     * Test fulfillment bulk response with invalid string param
     *
     * @expectedException        \Signifyd\Core\Exceptions\LoggerException
     * @expectedExceptionMessage Invalid logger parameter
     *
     * @return void
     */
    public function testFulfillmentBulkResponseWithStringParam()
    {
        $response = new \Signifyd\Core\Response\FulfillmentBulkResponse('signifyd');
    }

    /**
     * Test fulfillment bulk response with invalid object
     *
     * @expectedException        \Signifyd\Core\Exceptions\LoggerException
     * @expectedExceptionMessage Invalid logger parameter
     *
     * @return void
     */
    public function testFulfillmentBulkResponseWithInvalidObjectParam()
    {
        $anObject = new \StdClass();
        $response = new \Signifyd\Core\Response\FulfillmentBulkResponse($anObject);
    }

    /**
     * Test fulfillment bulk response with valid params
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testFulfillmentBulkResponseWithValidParam()
    {
        $settings = new \Signifyd\Core\Settings();
        $anObject = new \Signifyd\Core\Logging($settings);
        $response = new \Signifyd\Core\Response\FulfillmentBulkResponse($anObject);
        $this->assertEquals(
            'Signifyd\Core\Response\FulfillmentBulkResponse', get_class($response)
        );
    }

    /**
     * Test fulfillment bulk response setError method without params
     *
     * @expectedException \ArgumentCountError
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testFulfillmentBulkResponseSetErrorWithoutParam()
    {
        $settings = new \Signifyd\Core\Settings(['apiKey' => 'your api key']);
        $anObject = new \Signifyd\Core\Logging($settings);
        $response = new \Signifyd\Core\Response\FulfillmentBulkResponse($anObject);
        $response->setError();
    }

    /**
     * Test fulfillment bulk response setError without one param
     *
     * @expectedException \ArgumentCountError
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testFulfillmentBulkResponseSetErrorWithoutOneParam()
    {
        $settings = new \Signifyd\Core\Settings(['apiKey' => 'your api key']);
        $anObject = new \Signifyd\Core\Logging($settings);
        $response = new \Signifyd\Core\Response\FulfillmentBulkResponse($anObject);
        $response->setError(500);
    }

    /**
     * Test fulfillment bulk response setError method with valid params
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testFulfillmentBulkResponseSetError()
    {
        $settings = new \Signifyd\Core\Settings(['apiKey' => 'your api key']);
        $anObject = new \Signifyd\Core\Logging($settings);
        $response = new \Signifyd\Core\Response\FulfillmentBulkResponse($anObject);
        $response->setError(500, 'Signifyd Error');
        $this->assertTrue($response->isError());
        $this->assertEquals('Signifyd Error', $response->getErrorMessage());
    }

}