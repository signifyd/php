<?php

/**
 * Copyright © 2015 SIGNIFYD Inc. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Signifyd\Models;

use Signifyd\Core\SignifydModel;

/**
 * Class Product
 * Info on a particular item in the order.
 */
class Product extends SignifydModel
{
    public $itemId;
    public $itemName;
    public $itemUrl;
    public $itemImage;
    public $itemQuantity;
    public $itemPrice;
    public $itemWeight;

    public function __construct()
    {
    }
}
