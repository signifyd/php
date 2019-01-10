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
    public $apiKey = 'your api key';

    /**
     * Test initialize the connection class without settings
     *
     * @expectedException        \Signifyd\Core\Exceptions\ConnectionException
     * @expectedExceptionMessage Settings should be a \Signifyd\Core\Settings instance
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testConnectionWithoutSettings()
    {
        $connection = new Connection([]);
    }

    /**
     * Test initialize the connection class without any parameter sent
     *
     * @expectedException \ArgumentCountError
     *
     * @return void
     *
     * @throws ConnectionException
     * @throws \Signifyd\Core\Exceptions\LoggerException
     */
    public function testConnectionWithoutSettingsAttribute()
    {
        $connection = new Connection();
    }

    /**
     * Test the making of the url without sending a parameter
     *
     * @covers \Signifyd\Core\Connection::makeUrl()
     *
     * @throws ConnectionException
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testMakeUrlEmpty()
    {
        $settings = new Settings(['apiKey' => $this->apiKey]);
        $connection = new Connection($settings);
        $result = $connection->makeUrl('');
        $this->assertEquals($settings->getApiAddress(), $result);
    }

    /**
     * Test the make url with an endpoint
     *
     * @covers \Signifyd\Core\Connection::makeUrl()
     *
     * @throws ConnectionException
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testMakeUrlWithEndpoint()
    {
        $endpoint = 'cases';
        $settings = new Settings(['apiKey' => $this->apiKey]);
        $connection = new Connection($settings);
        $result = $connection->makeUrl($endpoint);
        $this->assertEquals($settings->getApiAddress() . $endpoint, $result);
    }

    /**
     * Test init curl post method
     *
     * @throws ConnectionException
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testInitCurlPostMethodInit()
    {
        $settings = new Settings(['apiKey' => $this->apiKey]);
        $connection = new Connection($settings);
        $response = $connection->initCurl('endpoint', 'post');
        $this->assertTrue($response);
        $curl = $connection->getCurl();
        $this->assertInternalType('resource', $curl);
    }

    /**
     * Test init curl with no parameters
     *
     * @expectedException \ArgumentCountError
     *
     * @throws ConnectionException
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testInitCurlNoParams()
    {
        $settings = new Settings(['apiKey' => $this->apiKey]);
        $connection = new Connection($settings);
        $connection->initCurl();
    }

    /**
     * Test init curl with empty params
     *
     * @expectedException        \Signifyd\Core\Exceptions\ConnectionException
     * @expectedExceptionMessage Method  is not supported.
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testInitCurlEmptyParams()
    {
        $settings = new Settings(['apiKey' => $this->apiKey]);
        $connection = new Connection($settings);
        $connection->initCurl('', '');
    }

    /**
     * Test init curl with head method
     *
     * @expectedException        \Signifyd\Core\Exceptions\ConnectionException
     * @expectedExceptionMessage Method head is not supported.
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testInitCurlWithHeadMethod()
    {
        $settings = new Settings(['apiKey' => $this->apiKey]);
        $connection = new Connection($settings);
        $connection->initCurl('', 'head');
    }

    /**
     * Test init curl with patch method
     *
     * @expectedException        \Signifyd\Core\Exceptions\ConnectionException
     * @expectedExceptionMessage Method patch is not supported.
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testInitCurlWithPatchMethod()
    {
        $settings = new Settings(['apiKey' => $this->apiKey]);
        $connection = new Connection($settings);
        $connection->initCurl('', 'patch');
    }

    /**
     * Test init curl with delete method
     *
     * @expectedException        \Signifyd\Core\Exceptions\ConnectionException
     * @expectedExceptionMessage Method delete is not supported.
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     *
     * @return void
     */
    public function testInitCurlWithDeleteMethod()
    {
        $settings = new Settings(['apiKey' => $this->apiKey]);
        $connection = new Connection($settings);
        $connection->initCurl('', 'delete');
    }

}