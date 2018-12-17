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
use Signifyd\Core\Exceptions\InvalidClassException;

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

    private $retryIntervals = [0.25, 0.5, 1, 2, 3];

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
//            CURLOPT_HEADER => 1,
//            CURLINFO_HEADER_OUT => 1,
            CURLOPT_USERAGENT => 'Signifyd PHP SDK',
            CURLOPT_HTTPHEADER => $this->headers,
            CURLOPT_URL => $url
        ];
        if (true === $this->settings->isConsoleOut()) {
            $options[CURLOPT_VERBOSE] = 1;
        }

        if (false === $this->settings->isSSLVerification()) {
            $options[CURLOPT_SSL_VERIFYPEER] = false;
            $options[CURLOPT_SSL_VERIFYHOST] = false;
        }

        if ($method == 'post') {
            $options[CURLOPT_POST] = true;
        } elseif ($method == 'put') {
            $options[CURLOPT_CUSTOMREQUEST] = "PUT";
        } elseif ($method == 'get') {
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
     * @param string $type     Api type for response
     *
     * @return bool|mixed
     * @throws InvalidClassException
     */
    public function callApi($endpoint,$payload = '',$method = 'get',$type = 'case')
    {
        $url = $this->makeUrl($endpoint);
        $this->headers[] = "Content-length: " . strlen($payload);
        try {
            $this->initCurl($url, $method);
        } catch (ConnectionException $e) {
            $this->logger->error($e->__toString());
            return false;
        }

        $retryCurlErrorNumber = [
            1 => 'CURLE_UNSUPPORTED_PROTOCOL',
            2 => 'CURLE_FAILED_INIT',
            3 => 'CURLE_URL_MALFORMAT',
            4 => 'CURLE_URL_MALFORMAT_USER',
            5 => 'CURLE_COULDNT_RESOLVE_PROXY',
            6 => 'CURLE_COULDNT_RESOLVE_HOST',
            7 => 'CURLE_COULDNT_CONNECT',
            8 => 'CURLE_FTP_WEIRD_SERVER_REPLY',
            9 => 'CURLE_REMOTE_ACCESS_DENIED',
            23 => 'CURLE_WRITE_ERROR',
            25 => 'CURLE_UPLOAD_FAILED',
            26 => 'CURLE_READ_ERROR',
            27 => 'CURLE_OUT_OF_MEMORY',
            28 => 'CURLE_OPERATION_TIMEDOUT',
            34 => 'CURLE_HTTP_POST_ERROR',
            51 => 'CURLE_PEER_FAILED_VERIFICATION',
            55 => 'CURLE_SEND_ERROR',
            56 => 'CURLE_RECV_ERROR',
            65 => 'CURLE_SEND_FAIL_REWIND',
            67 => 'CURLE_LOGIN_DENIED'
        ];

        $retry = 0;
        while($retry <= 4) {
            $status = true;
            $this->logger->info("Raw payload: " . $payload);
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, $payload);
            $response = curl_exec($this->curl);
            $this->logger->info("Raw response: " . $response);
            $info = curl_getinfo($this->curl);
            $this->logger->info("Raw request: " . json_encode($info));
            $error = curl_error($this->curl);
            $this->logger->error("Curl error: " . $error);
            $curlErrorNo = curl_error($this->curl);
            $this->logger->error("Curl errorNo: " . $curlErrorNo);
            curl_close($this->curl);

            if ($info['http_code'] == 409 || $info['http_code'] > 500) {
                $status = false;
            }

            if (!isset($retryCurlErrorNumber[$curlErrorNo]) && $status === true) {
                break;
            }

            $this->logger->info("Retry in effect No: " . $retry);
            sleep($this->retryIntervals[$retry]);
            $retry++;
        }



        $responseObj = $this->handleResponse($info, $response, $error, $type);

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
     * @param string $response The response received from Signifyd
     * @param string $error    The curl error
     * @param string $type     The response type
     *
     * @return object
     *
     * @throws InvalidClassException
     */
    public function handleResponse($info, $response, $error, $type)
    {
        $responseClass = '\Signifyd\Core\Response\\' . ucfirst($type) . 'Response';
        try {
            // The definition is for Response class because all the other response
            // classes extend the Response class
            /**
             * The response object based on type
             *
             * @var \Signifyd\Core\Response $responseObj
             */
            $responseObj = new $responseClass($this->logger);
        } catch (\Exception $e) {
            throw new InvalidClassException(
                'The class' . $responseClass . ' was not found'
            );
        }

        if ($info['http_code'] == 0) {
            $responseObj->setError($info['http_code'], $error);
            return $responseObj;
        }

        if ($info['http_code'] >= 200 && $info['http_code'] < 300) {
            $responseObj->setObject($response);
        } else {
            $responseObj->setError($info['http_code'], $response);
        }

        return $responseObj;
    }

    /**
     * Get the curl resource
     *
     * @return resource
     */
    public function getCurl()
    {
        return $this->curl;
    }

    /**
     * Return an array of HTTP response headers
     *
     * @param string $rawHeaders The raw response headers
     *
     * @return array $headers Array of HTTP response headers
     */
    protected function buildResponseHeaders($rawHeaders)
    {
        // ref/credit:
        // http://php.net/manual/en/function.http-parse-headers.php#112986
        $headers = array();
        $key = '';

        foreach (explode("\n", $rawHeaders) as $i => $h) {
            $h = explode(':', $h, 2);
            if (isset($h[1])) {
                if (!isset($headers[$h[0]])) {
                    $headers[$h[0]] = trim($h[1]);
                } elseif (is_array($headers[$h[0]])) {
                    $headers[$h[0]] = array_merge(
                        $headers[$h[0]],
                        array(trim($h[1]))
                    );
                } else {
                    $headers[$h[0]] = array_merge(
                        array($headers[$h[0]]),
                        array(trim($h[1]))
                    );
                }

                $key = $h[0];
            } else {
                if (substr($h[0], 0, 1) == "\t") {
                    $headers[$key] .= "\r\n\t".trim($h[0]);
                } elseif (!$key) {
                    $headers[0] = trim($h[0]);trim($h[0]);
                }
            }
        }

        return $headers;
    }

}