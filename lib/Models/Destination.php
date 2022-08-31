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
 * Class Device
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Destination extends Model
{
    /**
     * The full name of the person receiving the goods.
     * If this item is being shipped, then this field is the person it is being shipping to.
     *
     * @var string
     */
    public $fullName;

    /**
     * If provided by the buyer, the name of the recipient's company or organization.
     *
     * @var string
     */
    public $organization;

    /**
     * The location where the goods are being shipped.
     * Required if these are not digital goods.
     *
     * @var Address
     */
    public $address;

    /**
     * If the item was picked up at a physical location,
     * the phone number of the store or business the item was picked up from.
     *
     * @var string
     */
    public $confirmationPhone;

    /**
     * @var Driver
     */
    public $driver;

    /**
     * Email address where the goods are being delivered. Only use for digital goods.
     *
     * @var string
     */
    public $email;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'fullName',
        'organization',
        'address',
        'confirmationPhone',
        'driver',
        'email'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'fullName' => [],
        'organization' => [],
        'address' => [],
        'confirmationPhone' => [],
        'driver' => [],
        'email' => []
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

                if ($field == 'address') {
                    if (isset($data['address'])) {
                        if ($data['address'] instanceof Address) {
                            $this->setAddress($data['address']);
                        } else {
                            $address = new Address($data['address']);
                            $this->setAddress($address);
                        }
                    }
                    continue;
                }

                if ($field == 'driver') {
                    if (isset($data['driver'])) {
                        if ($data['driver'] instanceof Driver) {
                            $this->setDriver($data['driver']);
                        } else {
                            $driver = new Driver($data['driver']);
                            $this->setDriver($driver);
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

    public function getFullName()
    {
        return $this->fullName;
    }

    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    public function getOrganization()
    {
        return $this->organization;
    }

    public function setOrganization($organization)
    {
        $this->organization = $organization;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getConfirmationPhone()
    {
        return $this->confirmationPhone;
    }

    public function setConfirmationPhone($confirmationPhone)
    {
        $this->confirmationPhone = $confirmationPhone;
    }

    public function getDriver()
    {
        return $this->driver;
    }

    public function setDriver($driver)
    {
        $this->driver = $driver;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
}