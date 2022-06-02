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
use Signifyd\Models\Address;

/**
 * Class SourceAccountDetails
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class SourceAccountDetails extends Model
{
    /**
     * The unique identifier of the payment account.
     *
     * @var string
     */
    public $accountNumber;

    /**
     * Denotes whether the account is able to transact.
     *
     * @var boolean
     */
    public $active;

    /**
     * Denote whether the account holder's identity
     * was verified by the institution or payment provider.
     *
     * @var boolean
     */
    public $verified;

    /**
     * The net asset balance on the account.
     * If this is a stored value account, like a checking account, then this amount should be positive.
     * If this is a loan account, like a credit card, then this amount should be negative.
     *
     * @var float
     */
    public $assetBalance;

    /**
     * The maximum amount of credit that this account may incur.
     * This should correspond to the lowest possible value for the balance.
     *
     * @var float
     */
    public $creditLimit;

    public $createdAt;

    /**
     * The annual income of the account owner.
     *
     * @var float
     */
    public $ownerAnnualIncome;

    /**
     * @var string
     */
    public $ownerDob;

    /**
     * The full name of the account owner.
     *
     * @var string
     */
    public $ownerName;

    /**
     * The email listed on the account for contacting the account owner.
     *
     * @var string
     */
    public $contactEmail;

    /**
     * The phone number listed on the account for contacting the account owner.
     *
     * @var string
     */
    public $contactPhone;

    /**
     * The two-letter ISO-3166 country code. If left blank, we will assume US.
     *
     * @var Address
     */
    public $contactAddress;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'accountNumber',
        'active',
        'verified',
        'assetBalance',
        'creditLimit',
        'createdAt',
        'ownerAnnualIncome',
        'ownerDob',
        'ownerName',
        'contactEmail',
        'contactPhone',
        'contactAddress',
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'accountNumber' => [],
        'active' => [],
        'verified' => [],
        'assetBalance' => [],
        'creditLimit' => [],
        'createdAt' => [],
        'ownerAnnualIncome' => [],
        'ownerDob' => [],
        'ownerName' => [],
        'contactEmail' => [],
        'contactPhone' => [],
        'contactAddress' => []
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

                if ($field == 'contactAddress') {
                    if (isset($data['contactAddress'])) {
                        if ($data['contactAddress'] instanceof Address) {
                            $this->setContactAddress($data['contactAddress']);
                        } else {
                            $billingAddress = new Address($data['contactAddress']);
                            $this->setContactAddress($billingAddress);
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

    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getVerified()
    {
        return $this->verified;
    }

    public function setverified($verified)
    {
        $this->verified = $verified;
    }

    public function getAssetBalance()
    {
        return $this->assetBalance;
    }

    public function setAssetBalance($assetBalance)
    {
        $this->assetBalance = $assetBalance;
    }

    public function getCreditLimit()
    {
        return $this->creditLimit;
    }

    public function setCreditLimit($creditLimit)
    {
        $this->creditLimit = $creditLimit;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getOwnerAnnualIncome()
    {
        return $this->ownerAnnualIncome;
    }

    public function setOwnerAnnualIncome($ownerAnnualIncome)
    {
        $this->ownerAnnualIncome = $ownerAnnualIncome;
    }

    public function getOwnerDob()
    {
        return $this->ownerDob;
    }

    public function setOwnerDob($ownerDob)
    {
        $this->ownerDob = $ownerDob;
    }

    public function getOwnerName()
    {
        return $this->ownerName;
    }

    public function setOwnerName($ownerName)
    {
        $this->ownerName = $ownerName;
    }

    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;
    }

    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;
    }

    public function getContactAddress()
    {
        return $this->contactAddress;
    }

    public function setContactAddress($contactAddress)
    {
        $this->contactAddress = $contactAddress;
    }
}