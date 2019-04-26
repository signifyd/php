<?php
/**
 * GuaranteeResponseTest Test class for the Signifyd SDK
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
 * Class GuaranteeResponseTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class GuaranteeResponseTest extends TestCase
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
    public function testGuaranteeResponseWithoutParam()
    {
        $response = new \Signifyd\Core\Response\GuaranteeResponse();
    }

    /**
     * Test guarantee response with invalid string param
     *
     * @expectedException        \Signifyd\Core\Exceptions\LoggerException
     * @expectedExceptionMessage Invalid logger parameter
     *
     * @return void
     */
    public function testGuaranteeResponseWithStringParam()
    {
        $response = new \Signifyd\Core\Response\GuaranteeResponse('signifyd');
    }

    /**
     * Test guarantee response with invalid object
     *
     * @expectedException        \Signifyd\Core\Exceptions\LoggerException
     * @expectedExceptionMessage Invalid logger parameter
     *
     * @return void
     */
    public function testGuaranteeResponseWithInvalidObjectParam()
    {
        $anObject = new \StdClass();
        $response = new \Signifyd\Core\Response\GuaranteeResponse($anObject);
    }

    /**
     * Test guarantee response with valid params
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testGuaranteeResponseWithValidParam()
    {
        $settings = new \Signifyd\Core\Settings();
        $anObject = new \Signifyd\Core\Logging($settings);
        $response = new \Signifyd\Core\Response\GuaranteeResponse($anObject);
        $this->assertEquals(
            'Signifyd\Core\Response\GuaranteeResponse', get_class($response)
        );
    }

    /**
     * Test guarantee response setError method without params
     *
     * @expectedException \ArgumentCountError
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testGuaranteeResponseSetErrorWithoutParam()
    {
        $settings = new \Signifyd\Core\Settings(['apiKey' => 'your api key']);
        $anObject = new \Signifyd\Core\Logging($settings);
        $response = new \Signifyd\Core\Response\GuaranteeResponse($anObject);
        $response->setError();
    }

    /**
     * Test guarantee response setError method without one param
     *
     * @expectedException \ArgumentCountError
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testGuaranteeResponseSetErrorWithoutOneParam()
    {
        $settings = new \Signifyd\Core\Settings(['apiKey' => 'your api key']);
        $anObject = new \Signifyd\Core\Logging($settings);
        $response = new \Signifyd\Core\Response\GuaranteeResponse($anObject);
        $response->setError(500);
    }

    /**
     * Test guarantee response setError method with valid params
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testGuaranteeResponseSetError()
    {
        $settings = new \Signifyd\Core\Settings(['apiKey' => 'your api key']);
        $anObject = new \Signifyd\Core\Logging($settings);
        $response = new \Signifyd\Core\Response\GuaranteeResponse($anObject);
        $response->setError(500, 'Signifyd Error');
        $this->assertTrue($response->isError());
        $this->assertEquals('Signifyd Error', $response->getErrorMessage());
    }

}