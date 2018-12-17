<?php
/**
 * Seller model for the Signifyd SDK
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
 * Class Seller
 * Info on the store which the order was created in
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Seller extends Model
{
    /**
     * The business name of the seller.
     *
     * @var string
     */
    public $name;

    /**
     * The domain of the seller.
     *
     * @var string
     */
    public $domain;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $accountNumber;

    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $createdDate;

    /**
     * @var int
     */
    public $aggregateOrderCount;

    /**
     * @var float
     */
    public $aggregateOrderDollars;

    /**
     * @var string
     */
    public $lastUpdateDate;

    /**
     * @var string
     */
    public $onboardingIpAddress;

    /**
     * @var string
     */
    public $onboardingEmail;

    /**
     * @var array
     */
    public $tags;

    /**
     * The location from which the seller shipped the order.
     *
     * @var \Signifyd\Models\Address
     */
    public $shipFromAddress;

    /**
     * The corporate address of the seller.
     *
     * @var \Signifyd\Models\Address
     */
    public $corporateAddress;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'name',
        'domain',
        'email',
        'username',
        'accountNumber',
        'phone',
        'createdDate',
        'aggregateOrderCount',
        'aggregateOrderDollars',
        'lastUpdateDate',
        'onboardingIpAddress',
        'onboardingEmail',
        'tags',
        'shipFromAddress',
        'corporateAddress'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'name' => [],
        'domain' => [],
        'email' => [],
        'username' => [],
        'accountNumber' => [],
        'phone' => [],
        'createdDate' => [],
        'aggregateOrderCount' => [],
        'aggregateOrderDollars' => [],
        'lastUpdateDate' => [],
        'onboardingIpAddress' => [],
        'onboardingEmail' => [],
        'tags' => [],
        'shipFromAddress' => [],
        'corporateAddress' => []
    ];

    /**
     * Seller constructor.
     *
     * @param array $data The seller data
     */
    public function __construct($data = [])
    {
        if (!empty($data)) {
            foreach ($data as $field => $value) {
                if (!in_array($field, $this->fields)) {
                    continue;
                }

                $this->{'set' . ucfirst($field)}($value);
            }

            if (isset($data['shipFromAddress']) && !empty($data['shipFromAddress'])) {
                $shipFromAddress = new Address($data['shipFromAddress']);
                $this->setShipFromAddress($shipFromAddress);
            }

            if (isset($data['corporateAddress']) && !empty($data['corporateAddress'])) {
                $corporateAddress= new Address($data['corporateAddress']);
                $this->setCorporateAddress($corporateAddress);
            }
        }
    }

    /**
     * Validate the seller
     *
     * @return bool
     */
    public function validate()
    {
        $valid = [];

        //TODO add code to validate the seller
        return (!isset($valid[0]))? true : false;
    }

    /**
     * Get the seller name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the seller name
     *
     * @param mixed $name The seller name
     *
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get the domain
     *
     * @return mixed
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set the domain
     *
     * @param mixed $domain The domain
     *
     * @return void
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * Get the corporate address
     *
     * @return mixed
     */
    public function getCorporateAddress()
    {
        return $this->corporateAddress;
    }

    /**
     * Set the corporate address
     *
     * @param mixed $corporateAddress The address object
     *
     * @return void
     */
    public function setCorporateAddress($corporateAddress)
    {
        $this->corporateAddress = $corporateAddress;
    }

    /**
     * Get the ship from address
     *
     * @return Address
     */
    public function getShipFromAddress()
    {
        return $this->shipFromAddress;
    }

    /**
     * Set the ship from address
     *
     * @param Address $shipFromAddress The address object
     *
     * @return void
     */
    public function setShipFromAddress($shipFromAddress)
    {
        $this->shipFromAddress = $shipFromAddress;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * @param string $accountNumber
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param string $createdDate
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @return int
     */
    public function getAggregateOrderCount()
    {
        return $this->aggregateOrderCount;
    }

    /**
     * @param int $aggregateOrderCount
     */
    public function setAggregateOrderCount($aggregateOrderCount)
    {
        $this->aggregateOrderCount = $aggregateOrderCount;
    }

    /**
     * @return float
     */
    public function getAggregateOrderDollars()
    {
        return $this->aggregateOrderDollars;
    }

    /**
     * @param float $aggregateOrderDollars
     */
    public function setAggregateOrderDollars($aggregateOrderDollars)
    {
        $this->aggregateOrderDollars = $aggregateOrderDollars;
    }

    /**
     * @return string
     */
    public function getLastUpdateDate()
    {
        return $this->lastUpdateDate;
    }

    /**
     * @param string $lastUpdateDate
     */
    public function setLastUpdateDate($lastUpdateDate)
    {
        $this->lastUpdateDate = $lastUpdateDate;
    }

    /**
     * @return string
     */
    public function getOnboardingIpAddress()
    {
        return $this->onboardingIpAddress;
    }

    /**
     * @param string $onboardingIpAddress
     */
    public function setOnboardingIpAddress($onboardingIpAddress)
    {
        $this->onboardingIpAddress = $onboardingIpAddress;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return string
     */
    public function getOnboardingEmail()
    {
        return $this->onboardingEmail;
    }

    /**
     * @param string $onboardingEmail
     */
    public function setOnboardingEmail($onboardingEmail)
    {
        $this->onboardingEmail = $onboardingEmail;
    }
}
