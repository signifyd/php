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
use Signifyd\Models\Fingerprint;

/**
 * Class Device
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Device extends Model
{
    /**
     * The IP Address of the device or browser.
     * You must provide a valid IP address syntax.
     *
     * @var string
     */
    public $clientIpAddress;

    /**
     * The unique id for the user's session.
     * This is to be used in conjunction with the Signifyd fingerprinting javascript.
     *
     * @var string
     */
    public $sessionId;

    /**
     * A device fingerprinting payload you supply to Signifyd for use in decisioning.
     * Some integrations with Signifyd perform device profiling
     * before this API call and provide the profiling payload here.
     *
     * @var Fingerprint
     */
    public $fingerprint;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'clientIpAddress',
        'sessionId',
        'fingerprint',
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'clientIpAddress' => [],
        'sessionId' => [],
        'fingerprint' => [],
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

                if ($field == 'fingerprint') {
                    if (isset($data['fingerprint'])) {
                        if ($data['fingerprint'] instanceof Fingerprint) {
                            $this->setFingerprint($data['fingerprint']);
                        } else {
                            $fingerprint = new Fingerprint($data['fingerprint']);
                            $this->setFingerprint($fingerprint);
                        }
                    }
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

    public function getClientIpAddress()
    {
        return $this->clientIpAddress;
    }

    public function setClientIpAddress($clientIpAddress)
    {
        $this->clientIpAddress = $clientIpAddress;
    }

    public function getSessionId()
    {
        return $this->sessionId;
    }

    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    public function getFingerprint()
    {
        return $this->fingerprint;
    }

    public function setFingerprint($fingerprint)
    {
        $this->fingerprint = $fingerprint;
    }
}