<?php
/**
 * Setting for the Signifyd SDK
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

/**
 * Class Settings
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Settings
{
    /**
     * API key used for authorization with Signifyd service
     * You can find the key value at http://signifyd.com/settings/teams
     *
     * @var string $apiKey
     */
    public $apiKey;

    /**
     * The base address for all API calls.
     * Only needs modified in special circumstances
     *
     * @var string $apiAddress
     */
    public $apiAddress = "https://api.signifyd.com/";

    /**
     * CURL timeout value, in seconds.
     *
     * @var int $timeout
     */
    public $timeout = 30;

    /**
     * The retry option
     *
     * @var bool
     */
    public $retry = true;

    /**
     * SSLVerification for curl
     *
     * @var bool
     */
    public $SSLVerification = false;

    /**
     * The ability to display in the console the logs as they are written
     *
     * @var bool
     */
    public $consoleOut = false;

    /**
     * Logging enabled?
     *
     * @var bool
     */
    public $logEnabled = true;

    /*
     * The name of the log file
     */
    protected $logFileName = 'signifyd_core.log';

    /*
     * The location of the log file
     */
    protected $logLocation = '.';

    /**
     * Settings constructor.
     *
     * @param array $args Array with arguments for the class properties
     *
     * @return void
     */
    public function __construct($args = [])
    {
        if (!empty($args) && is_array($args)) {
            foreach (array_keys(get_object_vars($this)) as $var) {
                if (array_key_exists($var, $args)) {
                    $this->{'set' . ucfirst($var)}($args[$var]);
                }
            }
        }
    }

    /**
     * Get api key
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set api key
     *
     * @param string $apiKey The api key received from Signifyd
     *
     * @return void
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Get api web address
     *
     * @return string
     */
    public function getApiAddress($endpoint = null)
    {
        if (strpos($endpoint, 'orders') !== false ||
            strpos($endpoint, 'webhooks') !== false) {
            return $this->apiAddress . 'v3/';
        }

        return $this->apiAddress . 'v2/';
    }

    /**
     * Set api web address, in case Signifyd requests it
     *
     * @param string $apiAddress The web address provided by Signifyd
     *
     * @return void
     */
    public function setApiAddress($apiAddress)
    {
        $this->apiAddress = $apiAddress;
    }

    /**
     * Get curl timeout
     *
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * Set curl timeout
     *
     * @param int $timeout The time in seconds
     *
     * @return void
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    /**
     * Get retry active
     *
     * @return bool
     */
    public function getRetry()
    {
        return $this->retry;
    }

    /**
     * Set retry active
     *
     * @param bool $retry The bool value for retry
     *
     * @return void
     */
    public function setRetry($retry)
    {
        $this->retry = $retry;
    }

    /**
     * Get the state of the SSL verification
     *
     * @return bool
     */
    public function isSSLVerification()
    {
        return $this->SSLVerification;
    }

    /**
     * Set the state of the SSL verification
     *
     * @param bool $SSLVerification Value of SSL Verification
     *
     * @return void
     */
    public function setSSLVerification($SSLVerification)
    {
        $this->SSLVerification = $SSLVerification;
    }

    /**
     * Is logging to the console enabled
     *
     * @return bool
     */
    public function isConsoleOut()
    {
        return $this->consoleOut;
    }

    /**
     * Set the state console logging
     *
     * @param bool $consoleOut Value of the console logging
     *
     * @return void
     */
    public function setConsoleOut($consoleOut)
    {
        $this->consoleOut = $consoleOut;
    }

    /**
     * Is logging enabled
     *
     * @return bool
     */
    public function isLogEnabled()
    {
        return $this->logEnabled;
    }

    /**
     * Set the state of the enable logging
     *
     * @param bool $logEnabled Value of the enable logging
     *
     * @return void
     */
    public function setLogEnabled($logEnabled)
    {
        $this->logEnabled = $logEnabled;
    }

    /**
     * @return mixed|string
     */
    public function getLogFileName()
    {
        return $this->logFileName;
    }

    /**
     * @param $logFileName
     * @return void
     */
    public function setLogFileName($logFileName)
    {
        $this->logFileName = $logFileName;
    }

    /**
     * @return mixed|string
     */
    public function getLogLocation()
    {
        return $this->logLocation;
    }

    /**
     * @param $logLocation
     * @return void
     */
    public function setLogLocation($logLocation)
    {
        $this->logLocation = $logLocation;
    }
}