<?php
/**
 * CaseResponseTest Test class for the Signifyd SDK
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
 * Class CaseResponseTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class CaseResponseTest extends TestCase
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
    public function testCaseResponseWithoutParam()
    {
        $caseResponse = new \Signifyd\Core\Response\CaseResponse();
    }

    /**
     * Test case response with invalid string param
     *
     * @expectedException        \Signifyd\Core\Exceptions\LoggerException
     * @expectedExceptionMessage Invalid logger parameter
     *
     * @return void
     */
    public function testCaseResponseWithStringParam()
    {
        $caseResponse = new \Signifyd\Core\Response\CaseResponse('signifyd');
    }

    /**
     * Test case response with invalid object
     *
     * @expectedException        \Signifyd\Core\Exceptions\LoggerException
     * @expectedExceptionMessage Invalid logger parameter
     *
     * @return void
     */
    public function testCaseResponseWithInvalidObjectParam()
    {
        $anObject = new \StdClass();
        $caseResponse = new \Signifyd\Core\Response\CaseResponse($anObject);
    }

    /**
     * Test case response with valid params
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testCaseResponseWithValidParam()
    {
        $settings = new \Signifyd\Core\Settings();
        $anObject = new \Signifyd\Core\Logging($settings);
        $caseResponse = new \Signifyd\Core\Response\CaseResponse($anObject);
        $this->assertEquals(
            'Signifyd\Core\Response\CaseResponse', get_class($caseResponse)
        );
    }

    /**
     * Test case response set error without params
     *
     * @expectedException \ArgumentCountError
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testCaseResponseSetErrorWithoutParam()
    {
        $settings = new \Signifyd\Core\Settings(['apiKey' => 'your api key']);
        $anObject = new \Signifyd\Core\Logging($settings);
        $caseResponse = new \Signifyd\Core\Response\CaseResponse($anObject);
        $caseResponse->setError();
    }

    /**
     * Test case response setError method without one param
     *
     * @expectedException \ArgumentCountError
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testCaseResponseSetErrorWithoutOneParam()
    {
        $settings = new \Signifyd\Core\Settings(['apiKey' => 'your api key']);
        $anObject = new \Signifyd\Core\Logging($settings);
        $caseResponse = new \Signifyd\Core\Response\CaseResponse($anObject);
        $caseResponse->setError(500);
    }

    /**
     * Test Case response setError with correct params
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testCaseResponseSetError()
    {
        $settings = new \Signifyd\Core\Settings(['apiKey' => 'your api key']);
        $anObject = new \Signifyd\Core\Logging($settings);
        $caseResponse = new \Signifyd\Core\Response\CaseResponse($anObject);
        $caseResponse->setError(500, 'Signifyd Error');
        $this->assertTrue($caseResponse->isError());
        $this->assertEquals('Signifyd Error', $caseResponse->getErrorMessage());
    }
}