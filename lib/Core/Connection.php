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
     * The setting of the SDK
     *
     * @var \Signifyd\Core\Settings
     */
    public $settings;

    /**
     * The default curl headers
     *
     * @var array
     */
    protected $headers = [
        "Accept: application/json",
        "Content-Type: application/json"
    ];

    /**
     * The curl that does the sending
     *
     * @var resource
     */
    protected $curl;

    /**
     * To have logging in a time o need
     *
     * @var Logging
     */
    protected $logger;

    /**
     * Connection constructor.
     *
     * @param \Signifyd\Core\Settings $settings The settings
     *
     * @throws Exceptions\LoggerException
     * @throws ConnectionException
     */
    public function __construct($settings)
    {
        if ($settings instanceOf \Signifyd\Core\Settings === false) {
            throw new ConnectionException(
                'Settings should be a \Signifyd\Core\Settings instance'
            );
        }

        $this->settings = $settings;
        $this->logger = new Logging($settings);
    }

    /**
     * Init the Curl resource
     *
     * @param string $url    The curl url
     * @param string $method The REST method type
     *
     * @return bool
     *
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
            throw new ConnectionException(
                'Method ' . $method . ' is not supported.'
            );
        }

        curl_setopt_array($this->curl, $options);

        return true;
    }

    /**
     * The main part that does the call to the Signifyd API
     *
     * @param string $endpoint The url where to send the request
     * @param string $payload  The data to be send
     * @param string $method   The REST method type
     *
     * @return bool|mixed
     */
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

        $responseObj = $this->handleResponse($info, $response, $error);

        return $responseObj;
    }

    /**
     * Making the url for the api call to Signifyd
     *
     * @param string $endpoint The resource from the Signifyd Api
     *
     * @return string
     */
    public function makeUrl($endpoint)
    {
        if (substr($this->settings->getApiAddress(), -1) != '/') {
            return $this->settings->getApiAddress() . '/' . $endpoint;
        }
        return $this->settings->getApiAddress() . $endpoint;
    }

    /**
     * Handle the response from Signifyd api
     *
     * @param array  $info     The curl info
     * @param array  $response The response received from Signifyd
     * @param string $error    The curl error
     *
     * @return object
     */
    public function handleResponse($info, $response, $error)
    {
        $responseObj = new \Signifyd\Core\Response();
        if ($info['http_code'] == 0) {
            $responseObj->setError($info['http_code'], $error);
        }

        if ($info['http_code'] >= 200 && $info['http_code'] < 300) {
            $responseObj->setObject($response);
        } else {
            $responseObj->setError($info['http_code'], $response);
        }

        return $responseObj;
    }

    /**
     * @return resource
     */
    public function getCurl()
    {
        return $this->curl;
    }

}