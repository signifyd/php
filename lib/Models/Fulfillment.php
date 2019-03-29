<?php

namespace Signifyd\Models;

use Signifyd\Core\SignifydModel;

class Fulfillment extends SignifydModel
{
    public $id;
    public $orderId;
    public $createdAt;
    public $deliveryEmail;
    public $fulfillmentStatus;
    public $trackingNumbers;
    public $trackingUrls;

    /** @var array */
    public $products;
    public $shipmentStatus;

    /** @var Address */
    public $deliveryAddress;
    public $recipientName;
    public $confirmationName;
    public $confirmationPhone;
    public $shippingCarrier;
}