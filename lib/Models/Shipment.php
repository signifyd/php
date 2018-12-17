<?php
/**
 * Shipment model for the Signifyd SDK
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
 * Class Shipment
 * Info for the fulfillment of the order
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Shipment extends Model
{
    /**
     * The name of the shipper
     *
     * @var string
     */
    public $shipper;

    /**
     * The type of the shipment method used
     *
     * @var string
     */
    public $shippingMethod;

    /**
     * The amount charged to the customer for shipping the product
     *
     * @var float
     */
    public $shippingPrice;

    /**
     * Tracking number
     *
     * @var string
     */
    public $trackingNumber;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'shipper',
        'shippingMethod',
        'shippingPrice',
        'trackingNumber'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'shipper' => [],
        'shippingMethod' => [],
        'shippingPrice' => [],
        'trackingNumber' => []
    ];

    /**
     * Shipment constructor.
     *
     * @param array $item Shipment data
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
     * Validate the shipment
     *
     * @return bool
     */
    public function validate()
    {
        $valid = [];
        $allowedShipper = [
            "fedex", "dhl", "shipwire", "usps", "ups"
        ];

        $validShipper = $this->enumValid($this->getShipper(), $allowedShipper);
        if (false === $validShipper) {
            $valid[] = false;
        }

        $allowedShippingMethod = [
            "express", "electronic", "first_class", "first_class_international", "free", "freight", "ground",
            "international", "overnight", "priority", "priority_international", "pickup", "standard", "store_to_store",
            "two_day"
        ];
        $validMethod = $this->enumValid($this->getShippingMethod(), $allowedShippingMethod);
        if (false === $validMethod) {
            $valid[] = false;
        }

        //TODO add code to validate the shipment
        return (isset($valid[0]))? false : true;
    }

    /**
     * Get the shipper
     *
     * @return mixed
     */
    public function getShipper()
    {
        return $this->shipper;
    }

    /**
     * Set the shipper
     *
     * @param mixed $shipper The shipper name
     *
     * @return void
     */
    public function setShipper($shipper)
    {
        $this->shipper = $shipper;
    }

    /**
     * Get the shipping method
     *
     * @return mixed
     */
    public function getShippingMethod()
    {
        return $this->shippingMethod;
    }

    /**
     * Set the shipping method
     *
     * @param mixed $shippingMethod The shipping method
     *
     * @return void
     */
    public function setShippingMethod($shippingMethod)
    {
        $this->shippingMethod = $shippingMethod;
    }

    /**
     * Get the shipping price
     *
     * @return mixed
     */
    public function getShippingPrice()
    {
        return $this->shippingPrice;
    }

    /**
     * Set the shipping price
     *
     * @param mixed $shippingPrice The shipping price
     *
     * @return void
     */
    public function setShippingPrice($shippingPrice)
    {
        $this->shippingPrice = $shippingPrice;
    }

    /**
     * Get the tracking number
     *
     * @return mixed
     */
    public function getTrackingNumber()
    {
        return $this->trackingNumber;
    }

    /**
     * Set the tracking number
     *
     * @param mixed $trackingNumber The number received from the shipper
     *
     * @return void
     */
    public function setTrackingNumber($trackingNumber)
    {
        $this->trackingNumber = $trackingNumber;
    }
}
