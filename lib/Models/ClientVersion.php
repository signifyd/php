<?php

namespace Signifyd\Models;

use Signifyd\Core\Model;

class ClientVersion extends Model
{
    public $storePlatformVersion;

    public $signifydClientApp;

    public $storePlatform;

    public $signifydClientAppVersion;

    /**
     * The class attributes
     *
     * @var array $fields The list of fields
     */
    protected $fields = [
        'storePlatformVersion',
        'signifydClientApp',
        'storePlatform',
        'signifydClientAppVersion'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'storePlatformVersion' => [],
        'signifydClientApp' => [],
        'storePlatform' => [],
        'signifydClientAppVersion' => []
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

        //TODO add code to validate the client version
        return (!isset($valid[0]))? true : false;
    }

    public function getStorePlatformVersion()
    {
        return $this->storePlatformVersion;
    }

    public function setStorePlatformVersion($storePlatformVersion)
    {
        $this->storePlatformVersion = $storePlatformVersion;
    }

    public function getSignifydClientApp()
    {
        return $this->signifydClientApp;
    }

    public function setSignifydClientApp($signifydClientApp)
    {
        $this->signifydClientApp = $signifydClientApp;
    }

    public function getStorePlatform()
    {
        return $this->storePlatform;
    }

    public function setStorePlatform($storePlatform)
    {
        $this->storePlatform = $storePlatform;
    }

    public function getSignifydClientAppVersion()
    {
        return $this->signifydClientAppVersion;
    }

    public function setSignifydClientAppVersion($signifydClientAppVersion)
    {
        $this->signifydClientAppVersion = $signifydClientAppVersion;
    }
}