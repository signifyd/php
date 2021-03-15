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
     * @var int
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
     * For Marketplaces, the rating of the buyer.
     *
     * @var string
     */
    public $rating;

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
        'rating'
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
        'lastUpdateDate' => [],
        'rating' => []
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
     * Get the rating of the buyer
     *
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set the rating of the buyer
     *
     * @param $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }
}
