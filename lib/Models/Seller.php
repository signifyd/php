<?php

/**
 * Copyright © 2015 SIGNIFYD Inc. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Signifyd\Models;

use Signifyd\Core\SignifydModel;

/**
 * Class Seller
 * Info on the store which the order was created in
 */
class Seller extends SignifydModel
{
    public $name;
    public $domain;
    public $shipFromAddress; // Address
    public $corporateAddress;

    public function __construct()
    {
    }
}
