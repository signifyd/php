<?php

namespace Signifyd\Models;

use Signifyd\Core\Model;

class DeviceFingerprints extends Model
{
    /**
     * The name of the device fingerprint provider (threatmetrix, inauth, iovation)
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
     *The character encoding of the payload, e.g. utf8 or ascii.
     *
     * @var string
     */
    public $payloadEncoding;

    /**
     * The version number for the payload's structure/schema, if the provider has given one.
     * This is used to identify changes in response structure when a provider introduces changes to their API.
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
     * @param array $data The device fingerprints data
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
     * @param string $provider
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
     * @param string $payload
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
     * @param string $payloadEncoding
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
     * @param string $payloadVersion
     */
    public function setPayloadVersion($payloadVersion)
    {
        $this->payloadVersion = $payloadVersion;
    }
}