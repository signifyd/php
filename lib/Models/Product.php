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
        $validator = array();
        $validator["itemId"] = array("type" => "string", "value" => null);
        $validator["itemName"] = array ("type" => "string", "value" => null);
        $validator["itemUrl"] = array("type" => "string", "value" => null);
        $validator["itemImage"] = array("type" => "string", "value" => null);
        $validator["itemQuantity"] = array ("type" => "string", "value" => null);
        $validator["itemPrice"] = array("type" => "string", "value" => null);
        $validator["itemWeight"] = array("type" => "string", "value" => null);

        $this->validationInfo = $validator;
    }
}
