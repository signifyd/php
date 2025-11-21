<?php
/**
 * Purchase model for the Signifyd SDK
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
use Signifyd\Models\Product;
use Signifyd\Models\Shipment;
use Signifyd\Models\DiscountCode;

/**
 * Class Purchase
 * Data related to purchase event represented in this Case
 * Creation request.
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Purchase extends Model
{
    /**
     * The date and time when the order was placed, shown on the
     * signifyd console. Format yyyy-MM-dd'T'HH:mm:ssZ
     *
     * @var string
     */
    public $createdAt;

    /**
     * The method used by the buyer to place the order.
     *
     * @var string
     */
    public $orderChannel;

    /**
     * The total price of the order, including shipping price and taxes.
     *
     * @var float
     */
    public $totalPrice;

    /**
     * The currency type of the order, in 3 letter ISO 4217 format.
     *
     * @var string
     */
    public $currency = 'USD';

    /**
     * valid email syntax.
     *
     * @var string
     */
    public $confirmationEmail;

    /**
     * The products purchased in the transaction.
     *
     * @var array $products Array of Product objects
     */
    public $products = [];

    /**
     * The shipments associated with this purchase.
     *
     * @var array $shipments Array of Shipment objects
     */
    public $shipments = [];

    /**
     * The phone number at which the buyer would be contacted
     * if there was something wrong with this order or the phone number
     * that was supplied with the shipping information.
     *
     * @var string
     */
    public $confirmationPhone;

    /**
     * The total amount the customer is paying for shipping the products.
     *
     * @var float
     */
    public $totalShippingCost;

    /**
     * Any discount codes, coupons, or promotional codes used
     * during checkout to receive a discount on the order.
     * You can only provide the discount code and the discount
     * amount OR the discount percentage.
     *
     * @var array $discountCodes Array of DiscountCode objects
     */
    public $discountCodes = [];

    /**
     * If the order was placed on-behalf of a customer service or sales agent, his or her name.
     *
     * @var string
     */
    public $receivedBy;

    /**
     * The source or channel through which the order was placed.
     *
     * @var string
     */
    public $orderSource;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'createdAt',
        'orderChannel',
        'totalPrice',
        'currency',
        'confirmationEmail',
        'products',
        'shipments',
        'confirmationPhone',
        'totalShippingCost',
        'discountCodes',
        'receivedBy',
        'orderSource'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'createdAt' => [],
        'currency' => [],
        'orderChannel' => [],
        'totalPrice' => [],
    ];

    protected $objectFields = [
        'products',
        'shipments',
        'discountCodes'
    ];

    /**
     * Purchase constructor.
     *
     * @param array $data The purchase data
     */
    public function __construct($data = [])
    {
        if (!empty($data) && is_array($data)) {
            foreach ($data as $field => $value) {
                if (!in_array($field, $this->fields)) {
                    continue;
                }

                if (in_array($field, $this->objectFields)) {
                    continue;
                }

                $this->{'set' . ucfirst($field)}($value);
            }

            if (isset($data['products']) && is_array($data['products'])) {
                foreach ($data['products'] as $productsData) {
                    if ($productsData instanceof Product) {
                        $this->addProduct($productsData);
                    } else {
                        $product = new Product($productsData);
                        $this->addProduct($product);
                    }
                }
            }

            if (isset($data['shipments']) && is_array($data['shipments'])) {
                foreach ($data['shipments'] as $shipmentsData) {
                    if ($shipmentsData instanceof Shipment) {
                        $this->addShipment($shipmentsData);
                    } else {
                        $shipment = new Shipment($shipmentsData);
                        $this->addShipment($shipment);
                    }
                }
            }

            if (isset($data['discountCodes']) && is_array($data['discountCodes'])) {
                foreach ($data['discountCodes'] as $discountCodeData) {
                    if ($discountCodeData instanceof DiscountCode) {
                        $this->addDiscountCode($discountCodeData);
                    } else {
                        $discountCode = new DiscountCode($discountCodeData);
                        $this->addDiscountCode($discountCode);
                    }
                }
            }
        }
    }

    /**
     * Validate the purchase
     *
     * @return array|bool
     */
    public function validate()
    {
        $valid = [];

        $allowedChannels = [
            "WEB", "PHONE", "MOBILE_APP", "SOCIAL", "MARKETPLACE", "IN_STORE_KIOSK", "SCAN_AND_GO", "SMART_TV", "MIT"
        ];

        $validChannel = $this->enumValid($this->getOrderChannel(), $allowedChannels);
        if (false === $validChannel) {
            $valid[] = 'Invalid order channel';
        }

        return (isset($valid[0]))? $valid : true;
    }

    /**
     * Get the order creation date
     *
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the order creation date
     *
     * @param mixed $createdAt The create date
     *
     * @return void
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get the order channel
     *
     * @return mixed
     */
    public function getOrderChannel()
    {
        return $this->orderChannel;
    }

    /**
     * Set the order channel
     *
     * @param mixed $orderChannel The order channel
     *
     * @return void
     */
    public function setOrderChannel($orderChannel)
    {
        $this->orderChannel = $orderChannel;
    }

    /**
     * Get total price
     *
     * @return mixed
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Set the total price of the order
     *
     * @param mixed $totalPrice The total value of order
     *
     * @return void
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * Get the currency
     *
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set the order currency
     *
     * @param mixed $currency Currency code
     *
     * @return void
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getConfirmationEmail()
    {
        return $this->confirmationEmail;
    }

    /**
     * @param $confirmationEmail
     * @return void
     */
    public function setConfirmationEmail($confirmationEmail)
    {
        $this->confirmationEmail = $confirmationEmail;
    }

    /**
     * Add product item to the products array
     *
     * @param \Signifyd\Models\Product $product Product Item
     *
     * @return void
     */
    public function addProduct($product)
    {
        $this->products[] = $product;
    }

    /**
     * Add shipment item to the shipments array
     *
     * @param \Signifyd\Models\Shipment $shipment Shipment Item
     *
     * @return void
     */
    public function addShipment($shipment)
    {
        $this->shipments[] = $shipment;
    }

    /**
     * @return string
     */
    public function getConfirmationPhone()
    {
        return $this->confirmationPhone;
    }

    /**
     * @param $confirmationPhone
     * @return void
     */
    public function setConfirmationPhone($confirmationPhone)
    {
        $this->confirmationPhone = $confirmationPhone;
    }

    /**
     * @return float
     */
    public function getTotalShippingCost()
    {
        return $this->totalShippingCost;
    }

    /**
     * @param $totalShippingCost
     * @return void
     */
    public function setTotalShippingCost($totalShippingCost)
    {
        $this->totalShippingCost = $totalShippingCost;
    }

    /**
     * Add the discount code item to the discount code array
     *
     * @param \Signifyd\Models\DiscountCode $discountCode Discount Item
     *
     * @return void
     */
    public function addDiscountCode($discountCode)
    {
        $this->discountCodes[] = $discountCode;
    }

    /**
     * @return string
     */
    public function getReceivedBy()
    {
        return $this->receivedBy;
    }

    /**
     * @param $receivedBy
     * @return void
     */
    public function setReceivedBy($receivedBy)
    {
        $this->receivedBy = $receivedBy;
    }

    /**
     * @return string
     */
    public function getOrderSource()
    {
        return $this->orderSource;
    }

    /**
     * @param $orderSource
     * @return void
     */
    public function setOrderSource($orderSource)
    {
        $this->orderSource = $orderSource;
    }

    /**
     * Get a list of products
     *
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set a list of products
     *
     * @param array $products Array of products
     *
     * @return void
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

    /**
     * Get a list of shipments
     *
     * @return array
     */
    public function getShipments()
    {
        return $this->shipments;
    }

    /**
     * Set a list of shipments
     *
     * @param array $shipments Array of shipments
     *
     * @return void
     */
    public function setShipments($shipments)
    {
        $this->shipments = $shipments;
    }

    /**
     * Get a list of discount codes
     *
     * @return array
     */
    public function getDiscountCodes()
    {
        return $this->discountCodes;
    }

    /**
     * Set a list of discount codes
     *
     * @param array $discountCodes Array of discount codes
     *
     * @return void
     */
    public function setDiscountCodes($discountCodes)
    {
        $this->discountCodes = $discountCodes;
    }
}
