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
     * @expectedException \Signifyd\Core\Exceptions\ConnectionException
     * @expectedExceptionMessage Settings should be a \Signifyd\Core\Settings instance
     */
    public function testConnectionWithoutSettings()
    {
        $connection = new Connection([]);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testConnectionWithoutSettingsAttribute()
    {
        $connection = new Connection();
    }

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

    /**
     * @expectedException ArgumentCountError
     */
    public function testInitCurlNoParams()
    {
        $settings = new Settings(['apiKey' => 'lkkdsbaiuhiu2h387y87fdyhwq4grsdfsadf']);
        $connection = new Connection($settings);
        $connection->initCurl();
    }

    /**
     * @expectedException \Signifyd\Core\Exceptions\ConnectionException
     * @expectedExceptionMessage Method  is not supported.
     */
    public function testInitCurlEmptyParams()
    {
        $settings = new Settings(['apiKey' => 'lkkdsbaiuhiu2h387y87fdyhwq4grsdfsadf']);
        $connection = new Connection($settings);
        $connection->initCurl('','');
    }

    /**
     * @expectedException \Signifyd\Core\Exceptions\ConnectionException
     * @expectedExceptionMessage Method head is not supported.
     */
    public function testInitCurlWithHeadMethod()
    {
        $settings = new Settings(['apiKey' => 'lkkdsbaiuhiu2h387y87fdyhwq4grsdfsadf']);
        $connection = new Connection($settings);
        $connection->initCurl('','head');
    }

    /**
     * @expectedException \Signifyd\Core\Exceptions\ConnectionException
     * @expectedExceptionMessage Method patch is not supported.
     */
    public function testInitCurlWithPatchMethod()
    {
        $settings = new Settings(['apiKey' => 'lkkdsbaiuhiu2h387y87fdyhwq4grsdfsadf']);
        $connection = new Connection($settings);
        $connection->initCurl('','patch');
    }

    /**
     * @expectedException \Signifyd\Core\Exceptions\ConnectionException
     * @expectedExceptionMessage Method delete is not supported.
     */
    public function testInitCurlWithDeleteMethod()
    {
        $settings = new Settings(['apiKey' => 'lkkdsbaiuhiu2h387y87fdyhwq4grsdfsadf']);
        $connection = new Connection($settings);
        $connection->initCurl('','delete');
    }

}