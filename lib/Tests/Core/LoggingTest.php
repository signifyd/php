<?php
/**
 * LoggingTest Test class for the Signifyd SDK
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
 * Class LoggingTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class LoggingTest extends TestCase
{
    public $apiKey = 'your api key';

    /**
     * Testing settings with no argument passed
     *
     * @expectedException \ArgumentCountError
     *
     * @return void
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     */
    public function testLoggingWithoutParam()
    {
        $logging = new \Signifyd\Core\Logging();
    }

    /**
     * Testing settings with apiKey in array passed
     *
     * @expectedException        \Signifyd\Core\Exceptions\LoggerException
     * @expectedExceptionMessage Settings should be a \Signifyd\Core\Settings instance
     *
     * @return void
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     */
    public function testSettingsInitWithArray()
    {
        $logging = new \Signifyd\Core\Logging([]);
    }

    /**
     * Testing settings with apiKey in array passed
     *
     * @return void
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     */
    public function testLoggingInitwithCorrectParam()
    {
        $settings = new \Signifyd\Core\Settings(['apiKey' => 'asjdfs9oa8u349821q9rqw']);
        $logging = new \Signifyd\Core\Logging($settings);
        $this->assertEquals('Signifyd\Core\Logging', get_class($logging));
    }

}