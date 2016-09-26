<?php

/**
 * Copyright © 2015 SIGNIFYD Inc. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Signifyd\Models;

use Signifyd\Core\SignifydModel;

/**
 * Class UserAccount
 * Info for the account that placed the order. May not be the recipient
 */
class UserAccount extends SignifydModel
{
    public $emailAddress;
    public $username;
    public $phone;
    public $createdDate;
    public $accountNumber;
    public $lastOrderId;
    public $aggregateOrderCount;
    public $aggregateOrderDollars;
    public $lastUpdateDate;

    public function __construct()
    {
    }
}
