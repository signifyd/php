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
     * The seller account number
     *
     * @var string
     */
    public $accountNumber;

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
     * The address registered on the Seller account at which they say they should be contacted.
     *
     * @var Address
     */
    public $contactAddress;

    /**
     * The seller creation date
     *
     * @var string
     */
    public $createdDate;

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
     * Seller last update date
     *
     * @var string
     */
    public $lastUpdateDate;
    
    /**
     * The business name of the seller.
     *
     * @var string
     */
    public $name;

    /**
     * The seller onboarding email
     *
     * @var string
     */
    public $onboardingEmail;

    /**
     * The seller onboarding ip address
     *
     * @var string
     */
    public $onboardingIpAddress;

    /**
     * The unique ID of the parent entity associated with the seller.
     *
     * @var string
     */
    public $parentEntity;

    /**
     * The seller phone
     *
     * @var string
     */
    public $phone;

    /**
     * The unique ID of the seller generated by the parent entity.
     *
     * @var string
     */
    public $sellerId;

    /**
     * Seller tags
     *
     * @var array of string
     */
    public $tags;

    /**
     * Seller username
     *
     * @var string
     */
    public $username;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'accountNumber',
        'aggregateOrderCount',
        'aggregateOrderDollars',
        'contactAddress',
        'createdDate',
        'domain',
        'email',
        'lastUpdateDate',
        'name',
        'onboardingEmail',
        'onboardingIpAddress',
        'parentEntity',
        'phone',
        'sellerId',
        'tags',
        'username'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'accountNumber' => [],
        'aggregateOrderCount' => [],
        'aggregateOrderDollars' => [],
        'contactAddress' => [],
        'createdDate' => [],
        'domain' => [],
        'email' => [],
        'lastUpdateDate' => [],
        'name' => [],
        'onboardingEmail' => [],
        'onboardingIpAddress' => [],
        'parentEntity' => [],
        'phone' => [],
        'sellerId' => [],
        'tags' => [],
        'username' => []
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

                if ($field == 'contactAddress') {
                    if (isset($data['contactAddress'])) {
                        if ($data['contactAddress'] instanceof Address) {
                            $this->setContactAddress($data['contactAddress']);
                        } else {
                            $contactAddress = new Address($data['contactAddress']);
                            $this->setContactAddress($contactAddress);
                        }
                    }
                    continue;
                }

                $this->{'set' . ucfirst($field)}($value);
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
     * @return string
     */
    public function getSellerId()
    {
        return $this->sellerId;
    }

    /**
     * @param $sellerId
     * @return void
     */
    public function setSellerId($sellerId)
    {
        $this->sellerId = $sellerId;
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
     * @return Address
     */
    public function getContactAddress()
    {
        return $this->contactAddress;
    }

    /**
     * @param $contactAddress
     * @return void
     */
    public function setContactAddress($contactAddress)
    {
        $this->contactAddress = $contactAddress;
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
     * @return string
     */
    public function getOnboardingIpAddress()
    {
        return $this->onboardingIpAddress;
    }

    /**
     * @param $onboardingIpAddress
     * @return void
     */
    public function setOnboardingIpAddress($onboardingIpAddress)
    {
        $this->onboardingIpAddress = $onboardingIpAddress;
    }

    /**
     * @return string
     */
    public function getParentEntity()
    {
        return $this->parentEntity;
    }

    /**
     * @param $parentEntity
     * @return void
     */
    public function setParentEntity($parentEntity)
    {
        $this->parentEntity = $parentEntity;
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
