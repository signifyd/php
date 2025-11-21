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
 * Class UserAccount
 * Info for the account that placed the order. May not be the recipient
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class UserAccount extends Model
{
    /**
     * The primary email address associated with the account.
     *
     * @var string
     */
    public $email;

    /**
     * The username associated with the account.
     * Please supply this even if it is the same
     * as the email address.
     *
     * @var string
     */
    public $username;

    /**
     * The phone number associated with the account.
     *
     * @var string
     */
    public $phone;

    /**
     * The date when the account was created.
     * yyyy-MM-dd'T'HH:mm:ssZ
     *
     * @var string
     */
    public $createdDate;

    /**
     * Your unique identifier for the account.
     *
     * @var string
     */
    public $accountNumber;

    /**
     * The unique identifier for the last order placed
     * by this account, prior to the current order.
     *
     * @var string
     */
    public $lastOrderId;

    /**
     * The total count of orders placed by this account
     * since it was created, including the current order.
     *
     * @var int
     */
    public $aggregateOrderCount;

    /**
     * The total amount spent by this account since it
     * was created, including the current order.
     *
     * @var float
     */
    public $aggregateOrderDollars;

    /**
     * The last time a change was made to this account
     * other than an order being placed. yyyy-MM-dd'T'HH:mm:ssZ
     *
     * @var string
     */
    public $lastUpdateDate;

    /**
     * yyyy-MM-dd'T'HH:mm:ssZ
     *
     * @var string
     */
    public $emailLastUpdateDate;

    /**
     * yyyy-MM-dd'T'HH:mm:ssZ
     *
     * @var string
     */
    public $phoneLastUpdateDate;

    /**
     * yyyy-MM-dd'T'HH:mm:ssZ
     *
     * @var string
     */
    public $passwordLastUpdateDate;

    /**
     * Unique identifier of the associate linked to this order, such as employee ID.
     *
     * @var string
     */
    public $associateId;

    /**
     * An array of saved payment methods added to the account.
     *
     * @var array of SavedPayments
     */
    public $savedPayments;

    /**
     * An array of saved addresses methods added to the account.
     *
     * @var array of SavedAddress
     */
    public $savedAddresses;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'email',
        'username',
        'phone',
        'createdDate',
        'accountNumber',
        'lastOrderId',
        'aggregateOrderCount',
        'aggregateOrderDollars',
        'lastUpdateDate',
        'emailLastUpdateDate',
        'phoneLastUpdateDate',
        'passwordLastUpdateDate',
        'associateId'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'email' => [],
        'username' => [],
        'phone' => [],
        'createdDate' => [],
        'accountNumber' => [],
        'lastOrderId' => [],
        'aggregateOrderCount' => [],
        'aggregateOrderDollars' => [],
        'lastUpdateDate' => []
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

                if ($field == 'savedPayments') {
                    foreach ($value as $item) {
                        if ($item instanceof SavedPayment) {
                            $object = $item;
                        } else {
                            $object = new SavedPayment($item);
                        }

                        $this->addSavedPayment($object);
                    }
                    continue;
                }

                if ($field == 'savedAddresses') {
                    foreach ($value as $item) {
                        if ($item instanceof SavedAddress) {
                            $object = $item;
                        } else {
                            $object = new SavedAddress($item);
                        }

                        $this->addSavedAddress($object);
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

    /**
     * Get the email address
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the email address
     *
     * @param mixed $email The email address
     *
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get the username
     *
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the username
     *
     * @param mixed $username The username
     *
     * @return void
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get the phone number
     *
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the phone number
     *
     * @param mixed $phone The phone number
     *
     * @return void
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get the account creation date
     *
     * @return mixed
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set the creation date
     *
     * @param mixed $createdDate The creation date
     *
     * @return void
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    /**
     * Get the account number
     *
     * @return mixed
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * Set the account number
     *
     * @param mixed $accountNumber The account id
     *
     * @return void
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
    }

    /**
     * Get the last order id
     *
     * @return mixed
     */
    public function getLastOrderId()
    {
        return $this->lastOrderId;
    }

    /**
     * Set the last order id
     *
     * @param mixed $lastOrderId The id of the last order
     *
     * @return void
     */
    public function setLastOrderId($lastOrderId)
    {
        $this->lastOrderId = $lastOrderId;
    }

    /**
     * Get the aggregate order count
     *
     * @return mixed
     */
    public function getAggregateOrderCount()
    {
        return $this->aggregateOrderCount;
    }

    /**
     * Set  the aggregate order count
     *
     * @param mixed $aggregateOrderCount Total number of orders
     *
     * @return void
     */
    public function setAggregateOrderCount($aggregateOrderCount)
    {
        $this->aggregateOrderCount = $aggregateOrderCount;
    }

    /**
     * Get the aggregate order dollars
     *
     * @return mixed
     */
    public function getAggregateOrderDollars()
    {
        return $this->aggregateOrderDollars;
    }

    /**
     * Set the aggregate order dollars
     *
     * @param mixed $aggregateOrderDollars Total value of orders
     *
     * @return void
     */
    public function setAggregateOrderDollars($aggregateOrderDollars)
    {
        $this->aggregateOrderDollars = $aggregateOrderDollars;
    }

    /**
     * Get last update date
     *
     * @return mixed
     */
    public function getLastUpdateDate()
    {
        return $this->lastUpdateDate;
    }

    /**
     * Set the last update date
     *
     * @param mixed $lastUpdateDate The account update date
     *
     * @return void
     */
    public function setLastUpdateDate($lastUpdateDate)
    {
        $this->lastUpdateDate = $lastUpdateDate;
    }

    /**
     * @return string
     */
    public function getEmailLastUpdateDate()
    {
        return $this->emailLastUpdateDate;
    }

    /**
     * @param $emailLastUpdateDate
     * @return void
     */
    public function setEmailLastUpdateDate($emailLastUpdateDate)
    {
        $this->emailLastUpdateDate = $emailLastUpdateDate;
    }

    /**
     * @return string
     */
    public function getPhoneLastUpdateDate()
    {
        return $this->phoneLastUpdateDate;
    }

    /**
     * @param $phoneLastUpdateDate
     * @return void
     */
    public function setPhoneLastUpdateDate($phoneLastUpdateDate)
    {
        $this->phoneLastUpdateDate = $phoneLastUpdateDate;
    }

    /**
     * @return string
     */
    public function getPasswordLastUpdateDate()
    {
        return $this->passwordLastUpdateDate;
    }

    /**
     * @param $passwordLastUpdateDate
     * @return void
     */
    public function setPasswordLastUpdateDate($passwordLastUpdateDate)
    {
        $this->passwordLastUpdateDate = $passwordLastUpdateDate;
    }

    /**
     * @return string
     */
    public function getAssociateId()
    {
        return $this->associateId;
    }

    /**
     * @param $associateId
     * @return void
     */
    public function setAssociateId($associateId)
    {
        $this->associateId = $associateId;
    }

    /**
     * @return array
     */
    public function getSavedPayments()
    {
        return $this->savedPayments;
    }

    /**
     * @param $savedPayments
     * @return void
     */
    public function setSavedPayments($savedPayments)
    {
        $this->savedPayments = $savedPayments;
    }

    /**
     * @param $product
     * @return void
     */
    public function addSavedPayment($savedPayment)
    {
        $this->savedPayments[] = $savedPayment;
    }

    /**
     * @return array
     */
    public function getSavedAddresses()
    {
        return $this->savedAddresses;
    }

    /**
     * @param $savedAddresses
     * @return void
     */
    public function setSavedAddresses($savedAddresses)
    {
        $this->savedAddresses = $savedAddresses;
    }

    /**
     * @param $product
     * @return void
     */
    public function addSavedAddress($savedAddress)
    {
        $this->savedAddresses[] = $savedAddress;
    }
}
