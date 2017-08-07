<?php

/**
 * Copyright © 2015 SIGNIFYD Inc. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Signifyd\Models;

use Signifyd\Core\SignifydModel;

/**
 * Class Purchase
 * Info on the placed order
 */
class Purchase extends SignifydModel
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

    public $products; // array
    public $shipments; // array
    public $discountCodes; // array

    public function __construct()
    {
    }
}
