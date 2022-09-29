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
use Signifyd\Models\Recipient;
use Signifyd\Models\Origin;

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
     * Information about the person and location where the goods are being shipped.
     *
     * @var Recipient
     */
    public $destination;

    /**
     * Information about the location from which the shipment originated.
     *
     * @var Origin
     */
    public $origin;

    /**
     * The name of the shipper
     *
     * @var string
     */
    public $carrier;

    /**
     * @var string
     */
    public $minDeliveryDate;

    /**
     * @var string
     */
    public $maxDeliveryDate;

    /**
     * Id for the shipment.
     *
     * @var string
     */
    public $shipmentId;

    /**
     * Fulfillment method for the shipment.
     * This should not be used in conjunction with EmailDestination.
     *
     * @var string
     */
    public $fulfillmentMethod;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'destination',
        'origin',
        'carrier',
        'minDeliveryDate',
        'maxDeliveryDate',
        'shipmentId',
        'fulfillmentMethod',
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'destination' => [],
        'origin' => [],
        'carrier' => [],
        'minDeliveryDate' => [],
        'maxDeliveryDate' => [],
        'shipmentId' => [],
        'fulfillmentMethod' => [],
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

                if ($field == 'destination') {
                    if (isset($item['destination'])) {
                        if ($item['destination'] instanceof Recipient) {
                            $this->setDestination($item['destination']);
                        } else {
                            $destination = new Recipient($item['destination']);
                            $this->setDestination($destination);
                        }
                    }
                    continue;
                }

                if ($field == 'origin') {
                    if (isset($item['origin'])) {
                        if ($item['origin'] instanceof Origin) {
                            $this->setOrigin($item['origin']);
                        } else {
                            $origin = new Origin($item['origin']);
                            $this->setOrigin($origin);
                        }
                    }
                    continue;
                }

                $this->{'set' . ucfirst($field)}($value);
            }
        }
    }

    /**
     * Validate the shipment
     *
     * @return array|bool
     */
    public function validate()
    {
        $valid = [];
        $allowedShipper = [
            "fedex", "dhl", "shipwire", "usps", "ups", "seller"
        ];

        $validShipper = $this->enumValid($this->getCarrier(), $allowedShipper);
        if (false === $validShipper) {
            $valid[] = 'Invalid Shipper';
        }

        //TODO add code to validate the shipment
        return (isset($valid[0]))? $valid : true;
    }

    /**
     * @return \Signifyd\Models\Recipient
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param $destination
     * @return void
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    /**
     * @return \Signifyd\Models\Origin
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param $origin
     * @return void
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;
    }

    /**
     * Get the carrier
     *
     * @return mixed
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * Set the carrier
     *
     * @param mixed $carrier The carrier name
     *
     * @return void
     */
    public function setCarrier($carrier)
    {
        $this->carrier = $carrier;
    }

    /**
     * @return string
     */
    public function getMinDeliveryDate()
    {
        return $this->minDeliveryDate;
    }

    /**
     * @param $minDeliveryDate
     * @return void
     */
    public function setMinDeliveryDate($minDeliveryDate)
    {
        $this->minDeliveryDate = $minDeliveryDate;
    }

    /**
     * @return string
     */
    public function getMaxDeliveryDate()
    {
        return $this->maxDeliveryDate;
    }

    /**
     * @param $maxDeliveryDate
     * @return void
     */
    public function setMaxDeliveryDate($maxDeliveryDate)
    {
        $this->maxDeliveryDate = $maxDeliveryDate;
    }

    /**
     * @return string
     */
    public function getShipmentId()
    {
        return $this->shipmentId;
    }

    /**
     * @param $shipmentId
     * @return void
     */
    public function setShipmentId($shipmentId)
    {
        $this->shipmentId = $shipmentId;
    }

    /**
     * @return string
     */
    public function getFulfillmentMethod()
    {
        return $this->fulfillmentMethod;
    }

    /**
     * @param $fulfillmentMethod
     * @return void
     */
    public function setFulfillmentMethod($fulfillmentMethod)
    {
        $this->fulfillmentMethod = $fulfillmentMethod;
    }
}
