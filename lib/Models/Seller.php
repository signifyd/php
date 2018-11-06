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
    public $name;
    public $domain;

    /**
     * @var \Signifyd\Models\Address
     */
    public $shipFromAddress;

    /**
     * @var \Signifyd\Models\Address
     */
    public $corporateAddress;

    protected $fields = [
        'name',
        'domain'
    ];

    protected $fieldsValidation = [
        'name' => [],
        'domain' => []
    ];

    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param mixed $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return mixed
     */
    public function getCorporateAddress()
    {
        return $this->corporateAddress;
    }

    /**
     * @param mixed $corporateAddress
     */
    public function setCorporateAddress($corporateAddress)
    {
        $this->corporateAddress = $corporateAddress;
    }
}
