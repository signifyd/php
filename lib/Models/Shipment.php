<?php

/**
 * Copyright © 2015 SIGNIFYD Inc. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Signifyd\Models;

use Signifyd\Core\SignifydModel;

/**
 * Class Shipment
 * Info for the fulfillment of the order
 */
class Shipment extends SignifydModel
{
    public $shipper;
    public $shippingMethod;
    public $shippingPrice;
    public $trackingNumber;

    public function __construct()
    {
    }
}
