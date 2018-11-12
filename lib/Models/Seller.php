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
        'domain'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'name' => [],
        'domain' => []
    ];

    /**
     * Seller constructor.
     *
     * @param array $data The seller data
     */
    public function __construct($data = [])
    {

    }

    /**
     * Validate the seller
     *
     * @return bool
     */
    public function validate()
    {
        //TODO add code to validate the seller
        return true;
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
}
