<?php
/**
 * UserAccount model for the Signifyd SDK
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
namespace Signifyd\Models;

use Signifyd\Core\Model;

/**
 * Class Fingerprint
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Fingerprint extends Model
{
    /**
     * The name of the device fingerprint provider (threatmetrix, inauth, iovation).
     *
     * @var string
     */
    public $provider;

    /**
     * Base64 encoding of the device fingerprint response given by the provider.
     *
     * @var string
     */
    public $payload;

    /**
     * The character encoding of the payload, e.g. UTF8 or ASCII.
     *
     * @var string
     */
    public $payloadEncoding;

    /**
     * The version number for the payload's structure/schema,
     * if the provider has given one.
     *
     * @var string
     */
    public $payloadVersion;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'provider',
        'payload',
        'payloadEncoding',
        'payloadVersion'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'provider' => [],
        'payload' => [],
        'payloadEncoding' => [],
        'payloadVersion' => []
    ];

    /**
     * UserAccount constructor.
     *
     * @param array $data The user account data
     */
    public function __construct($data = [])
    {
        if (!empty($data) && is_array($data)) {
            foreach ($data as $field => $value) {
                if (!in_array($field, $this->fields)) {
                    continue;
                }

                $this->{'set' . ucfirst($field)}($value);
            }
        }
    }

    /**
     * Validate the user account
     *
     * @return bool
     */
    public function validate()
    {
        $valid = [];

        //TODO add code to validate the user account
        return (!isset($valid[0]))? true : false;
    }

    /**
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param $provider
     * @return void
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return string
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param $payload
     * @return void
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }

    /**
     * @return string
     */
    public function getPayloadEncoding()
    {
        return $this->payloadEncoding;
    }

    /**
     * @param $payloadEncoding
     * @return void
     */
    public function setPayloadEncoding($payloadEncoding)
    {
        $this->payloadEncoding = $payloadEncoding;
    }

    /**
     * @return string
     */
    public function getPayloadVersion()
    {
        return $this->payloadVersion;
    }

    /**
     * @param $payloadVersion
     * @return void
     */
    public function setPayloadVersion($payloadVersion)
    {
        $this->payloadVersion = $payloadVersion;
    }
}