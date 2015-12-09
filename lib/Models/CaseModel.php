<?php

/**
 * Copyright © 2015 SIGNIFYD Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
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
        $validator = array();
        $validator["purchase"] = array("type" => "SignifydModel", "value" => array(
            "subtype" => "Purchase"
        ));
        $validator["recipient"] = array ("type" => "SignifydModel", "value" => array(
            "subtype" => "Recipient"
        ));
        $validator["card"] = array("type" => "SignifydModel", "value" => array(
            "subtype" => "Card"
        ));
        $validator["userAccount"] = array ("type" => "SignifydModel", "value" => array(
            "subtype" => "UserAccount"
        ));
        $validator["seller"] = array("type" => "SignifydModel", "value" => array(
            "subtype" => "Seller"
        ));

        $this->validationInfo = $validator;
    }
}
