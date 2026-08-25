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
 * Class Fulfillment
 *
 * Represents a single entry of the "fulfillments" array of objects
 * accepted by the Chargeback and ChargebackCreateRequest models.
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Fulfillment extends Model
{
    /**
     * The shipper's name.
     *
     * @var string
     */
    public ?string $shipper = null;

    /**
     * The order's tracking number.
     *
     * @var ?string
     */
    public ?string $trackingNumber = null;

    /**
     * The Fulfillment Method refers to the method of fulfillment for the order.
     *
     * @var ?string
     */
    public ?string $fulfillmentMethod = null;

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
     * Fulfillment constructor.
     *
     * @param array $fulfillment
     */
    public function __construct(array $fulfillment = [])
    {
        // Check if something was passed to the class
        if (is_array($fulfillment) && !empty($fulfillment)) {
            foreach ($this->stringFields as $field) {
                if (array_key_exists($field, $fulfillment) && !is_array($fulfillment[$field])) {
                    $this->{'set' . ucfirst($field)}($fulfillment[$field]);
                }
            }
        }
    }

    /**
     * Validate fulfillment
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
    public function getShipper(): ?string
    {
        return $this->shipper;
    }

    /**
     * Set shipper
     *
     * @param string $shipper
     * @return void
     */
    public function setShipper(?string $shipper): void
    {
        $this->shipper = $shipper;
    }

    /**
     * Retrieve tracking number
     *
     * @return string
     */
    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }

    /**
     * Set tracking number
     *
     * @param string $trackingNumber
     * @return void
     */
    public function setTrackingNumber(?string $trackingNumber): void
    {
        $this->trackingNumber = $trackingNumber;
    }

    /**
     * Retrieve fulfillment method
     *
     * @return string
     */
    public function getFulfillmentMethod(): ?string
    {
        return $this->fulfillmentMethod;
    }

    /**
     * Set fulfillment method
     *
     * @param string $fulfillmentMethod
     * @return void
     */
    public function setFulfillmentMethod(?string $fulfillmentMethod): void
    {
        $this->fulfillmentMethod = $fulfillmentMethod;
    }
}
