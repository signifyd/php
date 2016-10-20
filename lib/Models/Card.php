<?php

/**
 * Copyright © 2015 SIGNIFYD Inc. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Signifyd\Models;

use Signifyd\Core\SignifydModel;

/**
 * Class Card
 * Credit card data. If the payment type is not CC, this ma not be used
 */
class Card extends SignifydModel
{
    public $cardHolderName;
    public $bin;
    public $last4;
    public $expiryMonth;
    public $expiryYear;
    public $hash;
    public $billingAddress;

    public function __construct()
    {
    }
}
