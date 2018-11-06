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
 * Info on the person who will receive the order. May not be that same as the person who placed it.
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Recipient extends Model
{
    public $fullName;
    public $confirmationEmail;
    public $confirmationPhone;
    public $organization;
    public $deliveryAddress;

    protected $fields = [
        'fullName',
        'confirmationEmail',
        'confirmationPhone',
        'organization'
    ];

    protected $fieldsValidation = [
        'fullName' => [],
        'confirmationEmail' => [],
        'confirmationPhone' => [],
        'organization' => []
    ];

    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return mixed
     */
    public function getConfirmationEmail()
    {
        return $this->confirmationEmail;
    }

    /**
     * @param mixed $confirmationEmail
     */
    public function setConfirmationEmail($confirmationEmail)
    {
        $this->confirmationEmail = $confirmationEmail;
    }

    /**
     * @return mixed
     */
    public function getConfirmationPhone()
    {
        return $this->confirmationPhone;
    }

    /**
     * @param mixed $confirmationPhone
     */
    public function setConfirmationPhone($confirmationPhone)
    {
        $this->confirmationPhone = $confirmationPhone;
    }

    /**
     * @return mixed
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * @param mixed $organization
     */
    public function setOrganization($organization)
    {
        $this->organization = $organization;
    }

    /**
     * @return mixed
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * @param mixed $deliveryAddress
     */
    public function setDeliveryAddress($deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
    }
}
