<?php
/**
 * UserAccount model for the Signifyd SDK
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
 * Class Device
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
     * Unique identifier for the Fulfillment.
     *
     * @var string
     */
    public $shipmentId;

    /**
     * The date and time items are ready to be shipped.
     * Formatted as yyyy-MM-dd'T'HH:mm:ssZ per ISO 8601.
     *
     * @var string
     */
    public $shippedAt;

    /**
     * The list of products that were included in the shipment.
     *
     * @var array $products Array of Product objects
     */
    public $products = [];

    /**
     * Statuses to indicate shipment state.
     *
     * @var string
     */
    public $shipmentStatus;

    /**
     * The tracking URLs for the shipment as provided by the shipping carrier.
     *
     * @var array of string
     */
    public $trackingUrls;

    /**
     * The tracking number(s) for the shipment as provided by the shipping carrier.
     *
     * @var array of string
     */
    public $trackingNumbers;

    /**
     * Information about the person and location where the goods are being shipped.
     *
     * @var Destination
     */
    public $destination;

    /**
     * Information about the location from which the shipment originated.
     *
     * @var Origin
     */
    public $origin;

    /**
     * The name of the Shipper. Any name will be accepted,
     * but we strongly recommend mapping to one of the following keys if possible.
     *
     * @var string
     */
    public $carrier;

    /**
     * Fulfillment method for the shipment. This should not be used in conjunction with EmailDestination.
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
        'shipmentId',
        'shippedAt',
        'products',
        'shipmentStatus',
        'trackingUrls',
        'trackingNumbers',
        'destination',
        'origin',
        'carrier',
        'fulfillmentMethod',
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'shipmentId' => [],
        'shippedAt' => [],
        'products' => [],
        'shipmentStatus' => [],
        'trackingUrls' => [],
        'trackingNumbers' => [],
        'destination' => [],
        'origin' => [],
        'carrier' => [],
        'fulfillmentMethod' => [],
    ];

    /**
     * UserAccount constructor.
     *
     * @param array $data The user account data
     */
    public function __construct($data = [])
    {
        if (!empty($data) && is_array($data)) {
            foreach ($data as $field => $value) {
                if (!in_array($field, $this->fields)) {
                    continue;
                }

                if ($field == 'products' && is_array($data['products'])) {
                    foreach ($data['products'] as $productsData) {
                        if ($productsData instanceof ProductFulfillment) {
                            $this->addProduct($productsData);
                        } else {
                            $product = new ProductFulfillment($productsData);
                            $this->addProduct($product);
                        }
                    }
                    continue;
                }

                if ($field == 'destination') {
                    if (isset($data['destination'])) {
                        if ($data['destination'] instanceof Destination) {
                            $this->setDestination($data['destination']);
                        } else {
                            $destination = new Destination($data['destination']);
                            $this->setDestination($destination);
                        }
                    }
                    continue;
                }

                if ($field == 'origin') {
                    if (isset($data['origin'])) {
                        if ($data['origin'] instanceof Origin) {
                            $this->setOrigin($data['origin']);
                        } else {
                            $origin = new Origin($data['origin']);
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
     * Validate the user account
     *
     * @return bool
     */
    public function validate()
    {
        $valid = [];

        //TODO add code to validate the user account
        return (!isset($valid[0]))? true : false;
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
    public function getShippedAt()
    {
        return $this->shippedAt;
    }

    /**
     * @param $shippedAt
     * @return void
     */
    public function setShippedAt($shippedAt)
    {
        $this->shippedAt = $shippedAt;
    }

    /**
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param $products
     * @return void
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

    /**
     * @param $product
     * @return void
     */
    public function addProduct($product)
    {
        $this->products[] = $product;
    }

    /**
     * @return string
     */
    public function getShipmentStatus()
    {
        return $this->shipmentStatus;
    }

    /**
     * @param $shipmentStatus
     * @return void
     */
    public function setShipmentStatus($shipmentStatus)
    {
        $this->shipmentStatus = $shipmentStatus;
    }

    /**
     * @return array
     */
    public function getTrackingUrls()
    {
        return $this->trackingUrls;
    }

    /**
     * @param $trackingUrls
     * @return void
     */
    public function setTrackingUrls($trackingUrls)
    {
        $this->trackingUrls = $trackingUrls;
    }

    /**
     * @return array
     */
    public function getTrackingNumbers()
    {
        return $this->trackingNumbers;
    }

    /**
     * @param $trackingNumbers
     * @return void
     */
    public function setTrackingNumbers($trackingNumbers)
    {
        $this->trackingNumbers = $trackingNumbers;
    }

    /**
     * @return Destination
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
     * @return Origin
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
     * @return string
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * @param $carrier
     * @return void
     */
    public function setCarrier($carrier)
    {
        $this->carrier = $carrier;
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