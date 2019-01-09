<?php
/**
 * Fulfillment model for the Signifyd SDK
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
 * Class Fulfillment
 * Fulfillment data
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
     * The id that uniquely identifies the fulfillment
     *
     * @var int
     */
    public $id;

    /**
     * The id that uniquely identifies this order
     *
     * @var string
     */
    public $orderId;

    /**
     * The date and time when the items were fulfilled
     *
     * @var string
     */
    public $createdAt;

    /**
     * The list of products that were fulfilled
     *
     * @var array
     */
    public $products = [];

    /**
     * The full name of the person receiving the goods
     *
     * @var string
     */
    public $recipientName;

    /**
     * The location where the item was delivered to
     *
     * @var object \Signifyd\Model\Address
     */
    public $deliveryAddress;

    /**
     * Status of an order in terms of the line_items being fulfilled
     *
     * @var string
     */
    public $fulfillmentStatus;

    /**
     * The status of the shipment
     *
     * @var string
     */
    public $shipmentStatus;

    /**
     * The shipping company name
     *
     * @var string
     */
    public $shippingCarrier;

    /**
     * Tracking number provided by the shipping carrier
     *
     * @var array
     */
    public $trackingNumbers = [];

    /**
     * Tracking URLs provided by the shipping carrier
     *
     * @var array
     */
    public $trackingUrls = [];

    /**
     * For digital goods - the email address the item was sent to
     *
     * @var string
     */
    public $deliveryEmail;

    /**
     * For in-store pickups - the name of the store or business
     * the item was picked up from
     *
     * @var string
     */
    public $confirmationName;

    /**
     * For in-store pickups - the phone number of the store or business
     * the item was picked up from
     *
     * @var string
     */
    public $confirmationPhone;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'id',
        'orderId',
        'createdAt',
        'products',
        'recipientName',
        'deliveryAddress',
        'fulfillmentStatus',
        'shipmentStatus',
        'shippingCarrier',
        'trackingNumbers',
        'trackingUrls',
        'deliveryEmail',
        'confirmationName',
        'confirmationPhone'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'id' => [],
        'orderId' => [],
        'createdAt' => [],
        'products' => [],
        'recipientName' => [],
        'deliveryAddress' => [],
        'fulfillmentStatus' => [],
        'shipmentStatus' => [],
        'shippingCarrier' => [],
        'trackingNumbers' => [],
        'trackingUrls' => [],
        'deliveryEmail' => [],
        'confirmationName' => [],
        'confirmationPhone' => []
    ];

    /**
     * Fulfillment constructor.
     *
     * @param array $data Fulfillment data
     */
    public function __construct($data = [])
    {
        if (!empty($data) && is_array($data)) {
            foreach ($data as $field => $value) {
                if (!in_array($field, $this->fields)) {
                    continue;
                }

                if ('deliveryAddress' === $field) {
                    continue;
                }

                $this->{'set' . ucfirst($field)}($value);
            }

            if (isset($data['deliveryAddress'])
             && !empty($data['deliveryAddress'])
            ) {
                $deliveryAddress = new Address($data['deliveryAddress']);
                $this->setDeliveryAddress($deliveryAddress);
            }
        }
    }

    /**
     * Validate the Fulfillment
     *
     * @return bool
     */
    public function validate()
    {
        $valid = [];

        //TODO add code to validate the fulfillment
        return (!isset($valid[0]))? true : false;
    }

    /**
     * Get the id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the id
     *
     * @param int $id The fulfilment id
     *
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the order id
     *
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set the order id
     *
     * @param string $orderId Order id
     *
     * @return void
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * Get the created at
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the created at
     *
     * @param string $createdAt Create date
     *
     * @return void
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get the products
     *
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set the products
     *
     * @param array $products List of products
     *
     * @return void
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

    /**
     * Get the recipient name
     *
     * @return string
     */
    public function getRecipientName()
    {
        return $this->recipientName;
    }

    /**
     * Set the recipient name
     *
     * @param string $recipientName The recipient name
     *
     * @return void
     */
    public function setRecipientName($recipientName)
    {
        $this->recipientName = $recipientName;
    }

    /**
     * Get the delivery address
     *
     * @return object
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * Set the delivery address
     *
     * @param object $deliveryAddress The delivery address
     *
     * @return void
     */
    public function setDeliveryAddress($deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * Get the fulfillment status
     *
     * @return string
     */
    public function getFulfillmentStatus()
    {
        return $this->fulfillmentStatus;
    }

    /**
     * Set the fulfillment status
     *
     * @param string $fulfillmentStatus Fulfillment status
     *
     * @return void
     */
    public function setFulfillmentStatus($fulfillmentStatus)
    {
        $this->fulfillmentStatus = $fulfillmentStatus;
    }

    /**
     * Get the shipment status
     *
     * @return string
     */
    public function getShipmentStatus()
    {
        return $this->shipmentStatus;
    }

    /**
     * Set the shipment status
     *
     * @param string $shipmentStatus Shipment status
     *
     * @return void
     */
    public function setShipmentStatus($shipmentStatus)
    {
        $this->shipmentStatus = $shipmentStatus;
    }

    /**
     * Get the shipping carrier
     *
     * @return string
     */
    public function getShippingCarrier()
    {
        return $this->shippingCarrier;
    }

    /**
     * Set the shipping carrier
     *
     * @param string $shippingCarrier Shipping carrier
     *
     * @return void
     */
    public function setShippingCarrier($shippingCarrier)
    {
        $this->shippingCarrier = $shippingCarrier;
    }

    /**
     * Get the tracking numbers
     *
     * @return array
     */
    public function getTrackingNumbers()
    {
        return $this->trackingNumbers;
    }

    /**
     * Set the tracking numbers
     *
     * @param array $trackingNumbers The list of tracking numbers
     *
     * @return void
     */
    public function setTrackingNumbers($trackingNumbers)
    {
        $this->trackingNumbers = $trackingNumbers;
    }

    /**
     * Get tracking urls
     *
     * @return array
     */
    public function getTrackingUrls()
    {
        return $this->trackingUrls;
    }

    /**
     * Set tracking urls
     *
     * @param array $trackingUrls The list of tracking urls
     *
     * @return void
     */
    public function setTrackingUrls($trackingUrls)
    {
        $this->trackingUrls = $trackingUrls;
    }

    /**
     * Get the delivery email
     *
     * @return string
     */
    public function getDeliveryEmail()
    {
        return $this->deliveryEmail;
    }

    /**
     * Set the delivery email
     *
     * @param string $deliveryEmail The delivery email
     *
     * @return void
     */
    public function setDeliveryEmail($deliveryEmail)
    {
        $this->deliveryEmail = $deliveryEmail;
    }

    /**
     * Get the confirmation name
     *
     * @return string
     */
    public function getConfirmationName()
    {
        return $this->confirmationName;
    }

    /**
     * Set the confirmation name
     *
     * @param string $confirmationName The confirmation name
     *
     * @return void
     */
    public function setConfirmationName($confirmationName)
    {
        $this->confirmationName = $confirmationName;
    }

    /**
     * Get the confirmation Phone
     *
     * @return string
     */
    public function getConfirmationPhone()
    {
        return $this->confirmationPhone;
    }

    /**
     * Set the confirmation phone
     *
     * @param string $confirmationPhone The confirmation phone
     *
     * @return void
     */
    public function setConfirmationPhone($confirmationPhone)
    {
        $this->confirmationPhone = $confirmationPhone;
    }
}