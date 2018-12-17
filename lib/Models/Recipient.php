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
     * When this purchase was completed, you likely sent
     * a confirmation email or you will be sending a confirmation
     * email to someone once you approve the order
     *
     * @var string
     */
    public $confirmationEmail;

    /**
     * The phone number that you would call if there was
     * something wrong with this order or the phone number
     * that was supplied with the shipping information.
     *
     * @var string
     */
    public $confirmationPhone;

    /**
     * If provided by the buyer, the name of the recipient's
     * company or organization.
     *
     * @var string
     */
    public $organization;

    /**
     * The address to which the order will be delivered.
     *
     * @var \Signifyd\Models\Address
     */
    public $deliveryAddress;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'fullName',
        'confirmationEmail',
        'confirmationPhone',
        'organization'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'fullName' => [],
        'confirmationEmail' => [],
        'confirmationPhone' => [],
        'organization' => []
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

                $this->{'set' . ucfirst($field)}($value);
            }

            if (isset($data['deliveryAddress']) && !empty($data['deliveryAddress'])) {
                $deliveryAddress = new Address($data['deliveryAddress']);
                $this->setDeliveryAddress($deliveryAddress);
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
     * Get the confirmation email
     *
     * @return mixed
     */
    public function getConfirmationEmail()
    {
        return $this->confirmationEmail;
    }

    /**
     * Set the confirmation email
     *
     * @param mixed $confirmationEmail The email
     *
     * @return void
     */
    public function setConfirmationEmail($confirmationEmail)
    {
        $this->confirmationEmail = $confirmationEmail;
    }

    /**
     * Get the confirmation phone
     *
     * @return mixed
     */
    public function getConfirmationPhone()
    {
        return $this->confirmationPhone;
    }

    /**
     * Set the confirmation phone
     *
     * @param mixed $confirmationPhone The phone number
     *
     * @return void
     */
    public function setConfirmationPhone($confirmationPhone)
    {
        $this->confirmationPhone = $confirmationPhone;
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
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * Set the delivery address
     *
     * @param object $deliveryAddress The delivery address
     *
     * @return void
     */
    public function setDeliveryAddress($deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
    }
}
