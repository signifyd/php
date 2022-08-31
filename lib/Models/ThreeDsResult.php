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
 * Class ThreeDsResult
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class ThreeDsResult extends Model
{
    /**
     * The Electronic Commerce Indicator returned from the schemes for the 3DS payment session.
     *
     * @var string
     */
    public $eci;

    /**
     * The Cardholder Authentication Verification Value (CAVV)
     * for the 3D Secure authentication session. (base64 encoded, 20 bytes in a decoded form)
     *
     * @var string
     */
    public $cavv;

    /**
     * The 3D Secure version.
     *
     * @var string
     */
    public $version;

    /**
     * This is the transStatus value as defined in the 3D Secure 2 specification.
     *
     * @var string
     */
    public $transStatus;

    /**
     * Additional information on why the status field has the specified value.
     * This the transStatusReason value as defined in the 3D Secure 2 specification.
     *
     * @var string
     */
    public $transStatusReason;

    /**
     * Directory server assigned access control server identifier.
     *
     * @var string
     */
    public $acsOperatorId;

    /**
     * Universally unique identifier assigned by the directory server to identifier a single transaction.
     *
     * @var string
     */
    public $dsTransId;

    /**
     * Universally Unique identifier assigned by the 3DS Server to identify a single transaction.
     *
     * @var string
     */
    public $threeDsServerTransId;

    /**
     * The CAVV algorithm used for authentication.
     *
     * @var string
     */
    public $cavvAlgorithm;

    /**
     * The exemption applied by the issuing bank while processing the payment via Authentication.
     *
     * @var string
     */
    public $exemptionIndicator;

    /**
     * A timestamp of the 3DS authentication.
     *
     * @var string
     */
    public $timestamp;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'eci',
        'cavv',
        'version',
        'transStatus',
        'transStatusReason',
        'acsOperatorId',
        'dsTransId',
        'threeDsServerTransId',
        'cavvAlgorithm',
        'exemptionIndicator',
        'timestamp',
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'eci' => [],
        'cavv' => [],
        'version' => [],
        'transStatus' => [],
        'transStatusReason' => [],
        'acsOperatorId' => [],
        'dsTransId' => [],
        'threeDsServerTransId' => [],
        'cavvAlgorithm' => [],
        'exemptionIndicator' => [],
        'timestamp' => [],
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

    public function getEci()
    {
        return $this->eci;
    }

    public function setEci($eci)
    {
        $this->eci = $eci;
    }

    public function getCavv()
    {
        return $this->cavv;
    }

    public function setCavv($cavv)
    {
        $this->cavv = $cavv;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function setVersion($version)
    {
        $this->version = $version;
    }

    public function getTransStatus()
    {
        return $this->transStatus;
    }

    public function setTransStatus($transStatus)
    {
        $this->transStatus = $transStatus;
    }

    public function getTransStatusReason()
    {
        return $this->transStatusReason;
    }

    public function setTransStatusReason($transStatusReason)
    {
        $this->transStatusReason = $transStatusReason;
    }

    public function getAcsOperatorId()
    {
        return $this->acsOperatorId;
    }

    public function setAcsOperatorId($acsOperatorId)
    {
        $this->acsOperatorId = $acsOperatorId;
    }

    public function getDsTransId()
    {
        return $this->dsTransId;
    }

    public function setDsTransId($dsTransId)
    {
        $this->dsTransId = $dsTransId;
    }

    public function getThreeDsServerTransId()
    {
        return $this->threeDsServerTransId;
    }

    public function setThreeDsServerTransId($threeDsServerTransId)
    {
        $this->threeDsServerTransId = $threeDsServerTransId;
    }

    public function getCavvAlgorithm()
    {
        return $this->cavvAlgorithm;
    }

    public function setCavvAlgorithm($cavvAlgorithm)
    {
        $this->cavvAlgorithm = $cavvAlgorithm;
    }

    public function getExemptionIndicator()
    {
        return $this->exemptionIndicator;
    }

    public function setExemptionIndicator($exemptionIndicator)
    {
        $this->exemptionIndicator = $exemptionIndicator;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }
}