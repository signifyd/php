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
     * Test sending array with key that does not exist
     *
     * @return void
     */
    public function testSettingsInitWithWrongParamType()
    {
        $settings = new Settings('apiKey23423');
        $this->assertEquals('Signifyd\Core\Settings', get_class($settings));
    }

}