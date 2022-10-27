<?php
/**
 * Recipient model for the Signifyd SDK
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
 * Class Recipient
 * Info on the person who will receive the order.
 * May not be that same as the person who placed it.
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Recipient extends Model
{
    /**
     * The full name of the person receiving the goods.
     * If this item is being shipped, then this field
     * is the person it is being shipping to
     *
     * @var string
     */
    public $fullName;

    /**
     * If provided by the buyer, the name of the recipient's
     * company or organization.
     *
     * @var string
     */
    public $organization;

    /**
     * Email address where the goods are being delivered. Only use for digital goods.
     *
     * @var string
     */
    public $email;

    /**
     * The address to which the order will be delivered.
     *
     * @var \Signifyd\Models\Address
     */
    public $address;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'fullName',
        'organization',
        'email',
        'address'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'fullName' => [],
        'organization' => [],
        'email' => [],
        'address' => []
    ];


    /**
     * Recipient constructor.
     *
     * @param array $data The recipient data
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

        //TODO add code to validate the recipient
        return (!isset($valid[0]))? true : false;
    }

    /**
     * Get the full name
     *
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set the full name
     *
     * @param mixed $fullName The full name
     *
     * @return void
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get the organization
     *
     * @return mixed
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Set the organization
     *
     * @param mixed $organization The organization name
     *
     * @return void
     */
    public function setOrganization($organization)
    {
        $this->organization = $organization;
    }

    /**
     * Get the delivery address
     *
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param $address
     * @return void
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }
}
