<?php

/**
 * Copyright © 2015 SIGNIFYD Inc. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Signifyd\Models;

use Signifyd\Core\SignifydModel;

/**
 * Class PaymentUpdate
 * Record class for updates to payment info
 */
class PaymentUpdate extends SignifydModel
{
    /**
     * @var string
     */
    public $paymentGateway;
    /**
     * @var string
     */
    public $transactionId;
    /**
     * @var string
     */
    public $avsResponseCode;
    /**
     * @var string
     */
    public $cvvResponseCode;

    public function __construct()
    {
    }
}
