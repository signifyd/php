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
    public $emailAddress;
    public $username;
    public $phone;
    public $createdDate;
    public $accountNumber;
    public $lastOrderId;
    public $aggregateOrderCount;
    public $aggregateOrderDollars;
    public $lastUpdateDate;

    protected $fields = [
        'emailAddress',
        'username',
        'phone',
        'createdDate',
        'accountNumber',
        'lastOrderId',
        'aggregateOrderCount',
        'aggregateOrderDollars',
        'lastUpdateDate'
    ];

    protected $fieldsValidation = [
        'emailAddress' => [],
        'username' => [],
        'phone' => [],
        'createdDate' => [],
        'accountNumber' => [],
        'lastOrderId' => [],
        'aggregateOrderCount' => [],
        'aggregateOrderDollars' => [],
        'lastUpdateDate' => []
    ];

    public function __construct($item)
    {

    }

    public function validate()
    {

    }

    /**
     * @return mixed
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param mixed $emailAddress
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param mixed $createdDate
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @return mixed
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * @param mixed $accountNumber
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
    }

    /**
     * @return mixed
     */
    public function getLastOrderId()
    {
        return $this->lastOrderId;
    }

    /**
     * @param mixed $lastOrderId
     */
    public function setLastOrderId($lastOrderId)
    {
        $this->lastOrderId = $lastOrderId;
    }

    /**
     * @return mixed
     */
    public function getAggregateOrderCount()
    {
        return $this->aggregateOrderCount;
    }

    /**
     * @param mixed $aggregateOrderCount
     */
    public function setAggregateOrderCount($aggregateOrderCount)
    {
        $this->aggregateOrderCount = $aggregateOrderCount;
    }

    /**
     * @return mixed
     */
    public function getAggregateOrderDollars()
    {
        return $this->aggregateOrderDollars;
    }

    /**
     * @param mixed $aggregateOrderDollars
     */
    public function setAggregateOrderDollars($aggregateOrderDollars)
    {
        $this->aggregateOrderDollars = $aggregateOrderDollars;
    }

    /**
     * @return mixed
     */
    public function getLastUpdateDate()
    {
        return $this->lastUpdateDate;
    }

    /**
     * @param mixed $lastUpdateDate
     */
    public function setLastUpdateDate($lastUpdateDate)
    {
        $this->lastUpdateDate = $lastUpdateDate;
    }
}
