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
class RecipientAddress extends Model
{
    /**
     * The main street address
     *
     * @var string Main street address
     */
    public $streetAddress;

    /**
     * The unit
     *
     * @var string Address line 2
     */
    public $unit;

    /**
     * The city of the address
     *
     * @var string City name
     */
    public $city;

    /**
     * The province code (state code) of the address
     *
     * @var string Province (optional)
     */
    public $provinceCode;

    /**
     * The zip code
     *
     * @var string Local postal code.
     */
    public $postalCode;

    /**
     * The country code of the address
     *
     * @var string Country code
     */
    public $countryCode;

    /**
     * Indicates whether the Postal Service can deliver mail to this address.
     *
     * @var boolean
     */
    public $isDeliverable;

    /**
     * Indicates if the address is currently receiving mail.
     * Possible values are true, false, or null.
     *
     * @var boolean
     */
    public $isReceivingMail;

    /**
     * This indicates the US Postal Service opinion about whether this
     * address is primarily a "Business" or "Residential".
     *
     * @var string
     */
    public $type;

    /**
     * Only valid for US address LocationType.
     * Indicates to the US Postal Service whether deliver of mail requires special handling.
     * One of: CommercialMailDrop, POBoxThrowback, POBox, MultiUnit, SingleUnit.
     *
     * @var string
     */
    public $deliveryPoint;

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
        'isDeliverable',
        'isReceivingMail',
        'type',
        'deliveryPoint'
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
        'isDeliverable' => [],
        'isReceivingMail' => [],
        'type' => [],
        'deliveryPoint' => []
    ];

    /**
     * Address constructor.
     *
     * @param array $item The data for the address
     */
    public function __construct($item = [])
    {
        if (!empty($item) && is_array($item)) {
            foreach ($item as $field => $value) {
                if (!in_array($field, $this->fields)) {
                    continue;
                }

                $this->{'set' . ucfirst($field)}($value);
            }
        }
    }

    /**
     * Validate the address
     *
     * @return bool
     */
    public function validate()
    {
        $valid = [];

        //TODO add code to validate the address
        return (!isset($valid[0]))? true : false;
    }

    /**
     * Get the street number and street name
     *
     * @return string
     */
    public function getStreetAddress()
    {
        return $this->streetAddress;
    }

    /**
     * Set the street number and street name
     *
     * @param string $streetAddress Name and number of street
     *
     * @return void
     */
    public function setStreetAddress($streetAddress)
    {
        $this->streetAddress = $streetAddress;
    }

    /**
     * Get the unit
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set the unit
     *
     * @param string $unit The unit number or address line 2
     *
     * @return void
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

    /**
     * Get the city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the city
     *
     * @param string $city City name
     *
     * @return void
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Get the province code/state code
     *
     * @return string
     */
    public function getProvinceCode()
    {
        return $this->provinceCode;
    }

    /**
     * Set the province code/state code
     *
     * @param string $provinceCode Code or abbreviation
     *
     * @return void
     */
    public function setProvinceCode($provinceCode)
    {
        $this->provinceCode = $provinceCode;
    }

    /**
     * Get the postal code/zip code
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Get the postal code/zip code
     *
     * @param string $postalCode Postal/zip code
     *
     * @return void
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * Get the two-letter ISO-3166 country code
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * Set two-letter ISO-3166 country code
     *
     * @param string $countryCode The two letter code
     *
     * @return void
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    public function getIsDeliverable()
    {
        return $this->isDeliverable;
    }

    public function setIsDeliverable($isDeliverable)
    {
        $this->isDeliverable = $isDeliverable;
    }

    public function getIsReceivingMail()
    {
        return $this->isReceivingMail;
    }

    public function setIsReceivingMail($isReceivingMail)
    {
        $this->isReceivingMail = $isReceivingMail;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getDeliveryPoint()
    {
        return $this->deliveryPoint;
    }

    public function setDeliveryPoint($deliveryPoint)
    {
        $this->deliveryPoint = $deliveryPoint;
    }
}
