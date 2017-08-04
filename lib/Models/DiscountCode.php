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
class DiscountCode extends SignifydModel
{
    public $code;
    public $amount;
    public $percentage;

    public function __construct()
    {
    }
}
