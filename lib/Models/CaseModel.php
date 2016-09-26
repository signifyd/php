<?php

/**
 * Copyright © 2015 SIGNIFYD Inc. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Signifyd\Models;

use Signifyd\Core\SignifydModel;

/**
 * Class CaseModel
 * Top level object model for a new case entry
 */
class CaseModel extends SignifydModel
{
    /**
     * @var \Signifyd\Models\Purchase
     */
    public $purchase;
    /**
     * @var \Signifyd\Models\Recipient
     */
    public $recipient;
    /**
     * @var \Signifyd\Models\Card
     */
    public $card;
    /**
     * @var \Signifyd\Models\UserAccount
     */
    public $userAccount;
    /**
     * @var \Signifyd\Models\Seller
     */
    public $seller;

    public function __construct()
    {
    }
}
