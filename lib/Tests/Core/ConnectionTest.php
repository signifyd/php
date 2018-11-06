<?php
/**
 * ConnectionTest Test class for the Signifyd SDK
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
use Signifyd\Core\Connection;
use Signifyd\Core\Exceptions\ConnectionException;
use Signifyd\Core\Settings;

/**
 * Class ConnectionTest
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class ConnectionTest extends TestCase
{
    /**
     * Testing settings with no argument passed
     *
     * @return void
     */
//    public function testFailed()
//    {
//        $this->fail('Connection Test is working');
//    }

//    public function testConnectionWithoutSettings()
//    {
//        $connection = new Connection([]);
//        $this->expectException('Settings should be a \Signifyd\Core\Settings instance');
//    }

    public function testMakeUrlEmpty()
    {
        $settings = new Settings(['apiKey' => 'lkkdsbaiuhiu2h387y87fdyhwq4grsdfsadf']);
        $connection = new Connection($settings);
        $result = $connection->makeUrl('');
        $this->assertEquals($settings->getApiAddress(), $result);
    }

    public function testMakeUrlWithEndpoint()
    {
        $endpoint = 'cases';
        $settings = new Settings(['apiKey' => 'lkkdsbaiuhiu2h387y87fdyhwq4grsdfsadf']);
        $connection = new Connection($settings);
        $result = $connection->makeUrl($endpoint);
        $this->assertEquals($settings->getApiAddress() . $endpoint, $result);
    }

    public function testInitCurlPostMethodInit()
    {
        $settings = new Settings(['apiKey' => 'lkkdsbaiuhiu2h387y87fdyhwq4grsdfsadf']);
        $connection = new Connection($settings);
        $response = $connection->initCurl('endpoint', 'post');
        $this->assertTrue($response);
        $curl = $connection->getCurl();
        $this->assertInternalType('resource', $curl);
    }
}