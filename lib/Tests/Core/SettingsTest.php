<?php
/**
 * Settings Test class for the Signifyd SDK
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
use Signifyd\Core\Settings;

/**
 * Class SettingsTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class SettingsTest extends TestCase
{
    public $apiKey = 'your api key';

    /**
     * Testing settings with no argument passed
     *
     * @return void
     */
    public function testSettingsInitWithoutArray()
    {
        $settings = new Settings();
        $this->assertNull($settings->getApiKey());
    }

    /**
     * Testing settings with apiKey in array passed
     *
     * @return void
     */
    public function testSettingsInitWithArray()
    {
        $settings = new Settings(['apiKey' => $this->apiKey]);
        $this->assertSame($this->apiKey, $settings->getApiKey());
    }

    /**
     * Test sending array with key that does not exist
     *
     * @return void
     */
    public function testSettingsInitWithWrongArrayKey()
    {
        $settings = new Settings(['apiKey23423' => $this->apiKey]);
        $this->assertNull($settings->getApiKey());
    }

    /**
     * Test init with wrong parameter
     *
     * @return void
     */
    public function testSettingsInitWithWrongParamType()
    {
        $settings = new Settings('apiKey23423');
        $this->assertEquals('Signifyd\Core\Settings', get_class($settings));
    }

    /**
     * Test getting the api key
     *
     * @return void
     */
    public function testSettingsGetApiKey()
    {
        $settings = new Settings(['apiKey' => 'signifyd']);
        $this->assertEquals('signifyd', $settings->getApiKey());
    }

    /**
     * Test setting the api key
     *
     * @return void
     */
    public function testSettingsSetApiKey()
    {
        $settings = new Settings();
        $settings->setApiKey('signifyd');
        $this->assertEquals('signifyd', $settings->apiKey);
    }

    /**
     * Test getting the api address
     *
     * @return void
     */
    public function testSettingsGetApiAddress()
    {
        $settings = new Settings();
        $this->assertEquals('https://api.signifyd.com/v2/', $settings->getApiAddress());
    }

    /**
     * Test setting array with key that does not exist
     *
     * @return void
     */
    public function testSettingsSetApiAddress()
    {
        $settings = new Settings();
        $settings->setApiAddress('http://signifyd.com/');
        $this->assertEquals('http://signifyd.com/', $settings->apiAddress);
    }

    /**
     * Test getting the timeout
     *
     * @return void
     */
    public function testSettingsGetTimeout()
    {
        $settings = new Settings();
        $this->assertEquals(30, $settings->getTimeout());
    }

    /**
     * Test setting the timeout
     *
     * @return void
     */
    public function testSettingsSetTimeout()
    {
        $settings = new Settings();
        $settings->setTimeout(60);
        $this->assertEquals(60, $settings->timeout);
    }

    /**
     * Test getting the retry
     *
     * @return void
     */
    public function testSettingsGetRetry()
    {
        $settings = new Settings();
        $this->assertTrue($settings->getRetry());
    }

    /**
     * Test setting the retry
     *
     * @return void
     */
    public function testSettingsSetRetry()
    {
        $settings = new Settings();
        $settings->setRetry(false);
        $this->assertFalse($settings->retry);
    }

    /**
     * Test getting the SSL verification for curl
     *
     * @return void
     */
    public function testSettingsIsSSLVerification()
    {
        $settings = new Settings();
        $this->assertFalse($settings->isSSLVerification());
    }

    /**
     * Test setting the SSL verification for curl
     *
     * @return void
     */
    public function testSettingsSetSSLVerification()
    {
        $settings = new Settings();
        $settings->setSSLVerification(true);
        $this->assertTrue($settings->SSLVerification);
    }

    /**
     * Test getting the console out
     *
     * @return void
     */
    public function testSettingsIsConsoleOut()
    {
        $settings = new Settings();
        $this->assertFalse($settings->isConsoleOut());
    }

    /**
     * Test setting the console out
     *
     * @return void
     */
    public function testSettingsSetConsoleOut()
    {
        $settings = new Settings();
        $settings->setConsoleOut(true);
        $this->assertTrue($settings->consoleOut);
    }

    /**
     * Test getting log enabled
     *
     * @return void
     */
    public function testSettingsIsLogEnabled()
    {
        $settings = new Settings();
        $this->assertTrue($settings->isLogEnabled());
    }

    /**
     * Test setting log enabled
     *
     * @return void
     */
    public function testSettingsSetLogEnabled()
    {
        $settings = new Settings();
        $settings->setLogEnabled(false);
        $this->assertFalse($settings->logEnabled);
    }
}