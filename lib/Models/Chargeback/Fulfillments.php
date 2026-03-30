<?php
/**
 * PHP version 8.2
 *
 * @category  Signifyd_Fraud_Protection
 * @package   Signifyd\Core
 * @author    Signifyd <info@signifyd.com>
 * @copyright 2026 SIGNIFYD Inc. All rights reserved.
 * @license   See LICENSE.txt for license details.
 * @link      https://www.signifyd.com/
 */
namespace Signifyd\Models\Chargeback;

use Signifyd\Core\Model;

/**
 * Class Fulfillments
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Fulfillments extends Model
{
    /**
     * The shipper's name.
     *
     * @var string
     */
    public string $shipper;

    /**
     * The order's tracking number.
     *
     * @var string
     */
    public string $trackingNumber;

    /**
     * The Fulfillment Method refers to the method of fulfillment for the order.
     *
     * @var string
     */
    public string $fulfillmentMethod;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'shipper',
        'trackingNumber',
        'fulfillmentMethod'
    ];

    protected $arrayOfObjectFields = [];

    protected $stringFields = [
        'shipper',
        'trackingNumber',
        'fulfillmentMethod'
    ];

    /**
     * Fulfillments constructor.
     *
     * @param array $fulfillments
     */
    public function __construct(array $fulfillments = [])
    {
        // Check if something was passed to the class
        if (is_array($fulfillments) && !empty($fulfillments)) {
            foreach ($this->fields as $field) {
                // init the class name
                $class = '\Signifyd\Models\\' . ucfirst($field);

                // make sure no wild data is sent
                if (array_key_exists($field, $fulfillments) === false) {
                    continue;
                }

                if (is_array($fulfillments[$field]) && !empty($fulfillments[$field])) {
                    if (in_array($field, $this->arrayOfObjectFields)) {
                        // init the class name
                        $singular = mb_substr($field,0,-1);
                        $className = ucfirst($singular);
                        $class = '\Signifyd\Models\\' . $className;

                        foreach ($fulfillments[$field] as $item) {
                            if ($item instanceof $class) {
                                $object = $item;
                            } else {
                                $object = new $class($item);
                            }

                            $this->{'add' . $className}($object);
                        }
                    } else {
                        $this->{'set' . ucfirst($field)}($fulfillments[$field]);
                    }
                } elseif ($fulfillments[$field] instanceof $class) {
                    $this->{'set' . ucfirst($field)}($fulfillments[$field]);
                } elseif (in_array($field, $this->stringFields)) {
                    $this->{'set' . ucfirst($field)}($fulfillments[$field]);
                }
            }
        }
    }

    /**
     * Validate charback fees
     *
     * @return array|bool
     */
    public function validate(): bool|array
    {
        $valid = [];

        return (!isset($valid[0]))? true : $valid;
    }

    /**
     * Retrieve shipper
     *
     * @return string
     */
    public function getShipper(): string
    {
        return $this->shipper;
    }

    /**
     * Set shipper
     *
     * @param string $shipper
     * @return void
     */
    public function setShipper(string $shipper): void
    {
        $this->shipper = $shipper;
    }

    /**
     * Retrieve tracking number
     *
     * @return string
     */
    public function getTrackingNumber(): string
    {
        return $this->trackingNumber;
    }

    /**
     * Set tracking number
     *
     * @param string $trackingNumber
     * @return void
     */
    public function setTrackingNumber(string $trackingNumber): void
    {
        $this->trackingNumber = $trackingNumber;
    }

    /**
     * Retrieve fulfillment method
     *
     * @return string
     */
    public function getFulfillmentMethod(): string
    {
        return $this->fulfillmentMethod;
    }

    /**
     * Set fulfillment method
     *
     * @param string $fulfillmentMethod
     * @return void
     */
    public function setFulfillmentMethod(string $fulfillmentMethod): void
    {
        $this->fulfillmentMethod = $fulfillmentMethod;
    }
}
