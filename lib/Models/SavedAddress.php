<?php
/**
 * Address model for the Signifyd SDK
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
 * Class Address
 * Contains a shipping/billing address
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class SavedAddress extends Address
{
    /**
     * The address type, must be shipping or bililng
     *
     * @var string
     */
    public $addressType;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'streetAddress',
        'unit',
        'city',
        'provinceCode',
        'postalCode',
        'countryCode',
        'addressType'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'streetAddress' => [],
        'unit' => [],
        'city' => [],
        'provinceCode' => [],
        'postalCode' => [],
        'countryCode' => [],
        'addressType' => []
    ];

    /**
     * @return string
     */
    public function getAddressType()
    {
        return $this->addressType;
    }

    /**
     * @param $addressType
     * @return void
     */
    public function setAddressType($addressType)
    {
        $this->addressType = $addressType;
    }
}
