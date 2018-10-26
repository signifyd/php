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
    public $apiAddress = "https://api.signifyd.com/v2/";

    /**
     * Whether or not to validate inputs before executing API calls.
     *
     * @var bool $validateData
     */
    public $validateData = true;

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
    public $retry = false;

    /**
     * Settings constructor.
     *
     * @param array $args Array with arguments for the class properties
     *
     * @return void
     */
    public function __construct($args = [])
    {
        if (!empty($args)) {
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
    public function getApiAddress()
    {
        return $this->apiAddress;
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

}