<?php

/**
 * Copyright © 2015 SIGNIFYD Inc. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Signifyd\Models;

use Signifyd\Core\SignifydModel;

/**
 * Class Recipient
 * Info on the person who will receive the order. May not be that same as the person who placed it.
 */
class Recipient extends SignifydModel
{
    public $fullName;
    public $confirmationEmail;
    public $confirmationPhone;
    public $organization;
    public $deliveryAddress;

    public function __construct()
    {
    }
}
