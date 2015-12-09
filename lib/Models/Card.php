<?php

/**
 * Copyright © 2015 SIGNIFYD Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */
namespace Signifyd\Models;

use Signifyd\Core\SignifydModel;

/**
 * Class Card
 * Credit card data. If the payment type is not CC, this ma not be used
 */
class Card extends SignifydModel
{
    public $cardholderName;
    public $bin;
    public $last4;
    public $expiryMonth;
    public $expiryYear;
    public $hash;
    public $billingAddress;

    public function __construct()
    {
        $validator = array();
        $validator["cardholderName"] = array("type" => "string", "value" => null);
        $validator["bin"] = array("type" => "string", "value" => null);
        $validator["last4"] = array ("type" => "string", "value" => null);
        $validator["expiryMonth"] = array("type" => "string", "value" => null);
        $validator["expiryYear"] = array ("type" => "string", "value" => null);
        $validator["hash"] = array("type" => "string", "value" => null);
        $validator["billingAddress"] = array("type" => "SignifydModel", "value" => array(
            "subtype" => "Address"
        ));

        $this->validationInfo = $validator;
    }
}
