<?php
/**
 * The Connection class for the Signifyd SDK
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
namespace Signifyd\Core;

use Signifyd\Core\Exceptions\ConnectionException;

/**
 * Class Connection
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Connection
{
    /**
     * @var \Signifyd\Core\Settings
     */
    public $settings;
    protected $headers = ["Accept: application/json", "Content-Type: application/json"];
    protected $curl;
    protected $logger;

    /**
     * Connection constructor.
     * @param $settings
     * @throws Exceptions\LoggerException
     */
    public function __construct($settings, $consoleOut = false)
    {
        $this->settings = $settings;
        $this->logger = new Logging($consoleOut);
    }

    /**
     * @param $url
     * @param $method
     * @return bool
     * @throws Exceptions\ConnectionException
     */
    public function initCurl($url, $method)
    {
        $this->curl = curl_init();
        $options = [
            CURLOPT_PORT => 443,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => $this->settings->getTimeout(),
            CURLOPT_CONNECTTIMEOUT => $this->settings->getTimeout(),
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => $this->settings->getApiKey(),
            CURLOPT_VERBOSE => 1,
            CURLOPT_HEADER => 1,
            CURLOPT_USERAGENT => 'Signifyd SDK',
            CURLOPT_HTTPHEADER => $this->headers,
            CURLOPT_URL => $url
        ];

        if ($this->settings->isSSLVerification() === false) {
            $options[CURLOPT_SSL_VERIFYPEER] = false;
            $options[CURLOPT_SSL_VERIFYHOST] = false;
        }

        if ($method == 'post') {
            $options[CURLOPT_POST] = true;
        } elseif ($method == 'put') {
            $options[CURLOPT_CUSTOMREQUEST] = "PUT";
        } elseif ($method != 'get') {
            $options[CURLOPT_CUSTOMREQUEST] = "GET";
        } else {
            throw new ConnectionException('Method ' . $method . ' is not supported.');
        }

        curl_setopt_array($this->curl, $options);

        return true;
    }

    public function callApi($endpoint, $payload, $method)
    {
        $url = $this->makeUrl($endpoint);
        $this->headers[] = "Content-length: " . strlen($payload);
        try {
            $this->initCurl($url, $method);
        } catch (ConnectionException $e) {
            $this->logger->error($e->__toString());
            return false;
        }

        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $payload);

        $response = curl_exec($this->curl);
        $info = curl_getinfo($this->curl);
        $error = curl_error($this->curl);
        curl_close($this->curl);

        $this->logger->info("Raw request: " . json_encode($info));
        $this->logger->info("Raw response: " . $response);
        $this->logger->error("Curl error: " . $error);

        if ($this->checkResultError($info['http_code'], $response, $error)) {
            return false;
        }

        return $response;
    }

    public function makeUrl($endpoint)
    {
        if (substr($this->settings->getApiAddress(), -1) != '/') {
            return $this->settings->getApiAddress() . '/' . $endpoint;
        }
        return $this->settings->getApiAddress() . $endpoint;
    }

    }
}