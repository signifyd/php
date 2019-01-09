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
     * Seller email
     *
     * @var string
     */
    public $email;

    /**
     * Seller username
     *
     * @var string
     */
    public $username;

    /**
     * The seller account number
     *
     * @var string
     */
    public $accountNumber;

    /**
     * The seller phone
     *
     * @var string
     */
    public $phone;

    /**
     * The seller creation date
     *
     * @var string
     */
    public $createdDate;

    /**
     * The seller aggregate order count
     *
     * @var int
     */
    public $aggregateOrderCount;

    /**
     * The seller aggregate order dollars
     *
     * @var float
     */
    public $aggregateOrderDollars;

    /**
     * Seller last update date
     *
     * @var string
     */
    public $lastUpdateDate;

    /**
     * The seller onboarding ip address
     *
     * @var string
     */
    public $onboardingIpAddress;

    /**
     * The seller onboarding email
     *
     * @var string
     */
    public $onboardingEmail;

    /**
     * Seller tags
     *
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
        if (!empty($data) && is_array($data)) {
            foreach ($data as $field => $value) {
                if (!in_array($field, $this->fields)) {
                    continue;
                }

                $this->{'set' . ucfirst($field)}($value);
            }

            if (isset($data['shipFromAddress'])
                && !empty($data['shipFromAddress'])
            ) {
                $shipFromAddress = new Address($data['shipFromAddress']);
                $this->setShipFromAddress($shipFromAddress);
            }

            if (isset($data['corporateAddress'])
                && !empty($data['corporateAddress'])
            ) {
                $corporateAddress = new Address($data['corporateAddress']);
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
     * Get the email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the email
     *
     * @param string $email Seller email
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
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the username
     *
     * @param string $username The username
     *
     * @return void
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get the account number
     *
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * Set the account number
     *
     * @param string $accountNumber The seller account number
     *
     * @return void
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
    }

    /**
     * Get the phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the phone
     *
     * @param string $phone The seller phone
     *
     * @return void
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get the creation date
     *
     * @return string
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set the creation date
     *
     * @param string $createdDate Seller creation date
     *
     * @return void
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    /**
     * Get the aggregate order count
     *
     * @return int
     */
    public function getAggregateOrderCount()
    {
        return $this->aggregateOrderCount;
    }

    /**
     * Set the aggregate order count
     *
     * @param int $aggregateOrderCount Seller order count
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
     * @return float
     */
    public function getAggregateOrderDollars()
    {
        return $this->aggregateOrderDollars;
    }

    /**
     * Set the aggregate order dollars
     *
     * @param float $aggregateOrderDollars Seller total order amounts
     *
     * @return void
     */
    public function setAggregateOrderDollars($aggregateOrderDollars)
    {
        $this->aggregateOrderDollars = $aggregateOrderDollars;
    }

    /**
     * Get the last update
     *
     * @return string
     */
    public function getLastUpdateDate()
    {
        return $this->lastUpdateDate;
    }

    /**
     * Set the last update
     *
     * @param string $lastUpdateDate Seller last update
     *
     * @return void
     */
    public function setLastUpdateDate($lastUpdateDate)
    {
        $this->lastUpdateDate = $lastUpdateDate;
    }

    /**
     * Get the onboarding ip address
     *
     * @return string
     */
    public function getOnboardingIpAddress()
    {
        return $this->onboardingIpAddress;
    }

    /**
     * Set the onboarding ip address
     *
     * @param string $onboardingIpAddress Seller ip address
     *
     * @return void
     */
    public function setOnboardingIpAddress($onboardingIpAddress)
    {
        $this->onboardingIpAddress = $onboardingIpAddress;
    }

    /**
     * Get the tags
     *
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set the tags
     *
     * @param array $tags Seller tags
     *
     * @return void
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * Get the onboarding email address
     *
     * @return string
     */
    public function getOnboardingEmail()
    {
        return $this->onboardingEmail;
    }

    /**
     * Set the onboarding email address
     *
     * @param string $onboardingEmail Seller onbording email
     *
     * @return void
     */
    public function setOnboardingEmail($onboardingEmail)
    {
        $this->onboardingEmail = $onboardingEmail;
    }
}
