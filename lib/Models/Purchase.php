<?php

/**
 * Copyright © 2015 SIGNIFYD Inc. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Signifyd\Models;

use Signifyd\Core\Model;
use Signifyd\Models\Product;
use Signifyd\Models\Shipment;
use Signifyd\Models\DiscountCode;

/**
 * Class Purchase
 * Info on the placed order
 */
class Purchase extends Model
{
    public $orderSessionId;
    public $browserIpAddress;
    public $orderId;
    public $createdAt; // datetime
    public $paymentGateway;
    public $paymentMethod;
    public $currency;
    public $avsResponseCode;
    public $cvvResponseCode;
    public $transactionId;
    public $orderChannel;
    public $receivedBy;
    public $totalPrice; //double

    /**
     * @var array $products Array of Product objects
     */
    public $products = [];

    /**
     * @var array $shipments Array of Shipment objects
     */
    public $shipments = [];

    /**
     * @var array $discountCodes Array of DiscountCode objects
     */
    public $discountCodes = [];

    protected $fields = [
        'orderSessionId',
        'browserIpAddress',
        'orderId',
        'createdAt',
        'paymentGateway',
        'paymentMethod',
        'currency',
        'avsResponseCode',
        'cvvResponseCode',
        'transactionId',
        'orderChannel',
        'receivedBy',
        'totalPrice',
        'products',
        'shipments',
        'discountCodes'
    ];

    protected $fieldsValidation = [
        'orderSessionId' => [],
        'browserIpAddress' => ['required'],
        'orderId' => ['required'],
        'createdAt' => ['required', 'datetime'],
        'paymentGateway' => ['required'],
        'paymentMethod' => ['required'],
        'currency' => ['required'],
        'avsResponseCode' => ['required'],
        'cvvResponseCode' => ['required'],
        'transactionId' => ['required'],
        'orderChannel' => ['required'],
        'receivedBy' => ['required'],
        'totalPrice' => ['required', 'double'],
    ];

    protected $objectFields = [
        'products',
        'shipments',
        'discountCodes'
    ];

    public function __construct($data = [])
    {
        if (!empty($data)) {
            foreach ($data as $field => $value) {
               if (!in_array($field, $this->fields)) {
                   continue;
               }

               $this->{'set' . ucfirst($field)}($value);
            }

            if (isset($data['products']) && is_array($data['products'])) {
                foreach ($data['products'] as $item) {
                    $product = new Product($item);
                    $this->addProduct($product);
                }
            }

            if (isset($data['shipments']) && is_array($data['shipments'])) {
                foreach ($data['shipments'] as $sItem) {
                    $shipment = new Shipment($sItem);
                    $this->addShipment($shipment);
                }
            }

            if (isset($data['discountCodes']) && is_array($data['discountCodes'])) {
                foreach ($data['discountCodes'] as $dItem) {
                    $discountCode = new DiscountCode($dItem);
                    $this->addDiscountCode($discountCode);
                }
            }
        }
    }

    public function validate($purchase)
    {
        if (is_array($purchase)) {

            return true;
        } elseif (is_object($purchase)) {
            return true;
        } else {
            return false;
        }
    }

    public function addProduct($product)
    {
        $this->products[] = $product;
    }

    public function addShipment($shipment)
    {
        $this->shipments[] = $shipment;
    }

    public function addDiscountCode($discountCode)
    {
        $this->discountCodes[] = $discountCode;
    }

    /**
     * @return mixed
     */
    public function getOrderSessionId()
    {
        return $this->orderSessionId;
    }

    /**
     * @param mixed $orderSessionId
     */
    public function setOrderSessionId($orderSessionId)
    {
        $this->orderSessionId = $orderSessionId;
    }

    /**
     * @return mixed
     */
    public function getBrowserIpAddress()
    {
        return $this->browserIpAddress;
    }

    /**
     * @param mixed $browserIpAddress
     */
    public function setBrowserIpAddress($browserIpAddress)
    {
        $this->browserIpAddress = $browserIpAddress;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return mixed
     */
    public function getPaymentGateway()
    {
        return $this->paymentGateway;
    }

    /**
     * @param mixed $paymentGateway
     */
    public function setPaymentGateway($paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    /**
     * @return mixed
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @param mixed $paymentMethod
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getAvsResponseCode()
    {
        return $this->avsResponseCode;
    }

    /**
     * @param mixed $avsResponseCode
     */
    public function setAvsResponseCode($avsResponseCode)
    {
        $this->avsResponseCode = $avsResponseCode;
    }

    /**
     * @return mixed
     */
    public function getCvvResponseCode()
    {
        return $this->cvvResponseCode;
    }

    /**
     * @param mixed $cvvResponseCode
     */
    public function setCvvResponseCode($cvvResponseCode)
    {
        $this->cvvResponseCode = $cvvResponseCode;
    }

    /**
     * @return mixed
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @param mixed $transactionId
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    /**
     * @return mixed
     */
    public function getOrderChannel()
    {
        return $this->orderChannel;
    }

    /**
     * @param mixed $orderChannel
     */
    public function setOrderChannel($orderChannel)
    {
        $this->orderChannel = $orderChannel;
    }

    /**
     * @return mixed
     */
    public function getReceivedBy()
    {
        return $this->receivedBy;
    }

    /**
     * @param mixed $receivedBy
     */
    public function setReceivedBy($receivedBy)
    {
        $this->receivedBy = $receivedBy;
    }

    /**
     * @return mixed
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * @param mixed $totalPrice
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param mixed $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

    /**
     * @return mixed
     */
    public function getShipments()
    {
        return $this->shipments;
    }

    /**
     * @param mixed $shipments
     */
    public function setShipments($shipments)
    {
        $this->shipments = $shipments;
    }

    /**
     * @return mixed
     */
    public function getDiscountCodes()
    {
        return $this->discountCodes;
    }

    /**
     * @param mixed $discountCodes
     */
    public function setDiscountCodes($discountCodes)
    {
        $this->discountCodes = $discountCodes;
    }

}
