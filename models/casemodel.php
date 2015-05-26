<?php

class CaseModel extends SignifydModel
{
    public $purchase;
    public $recipient;
    public $card;
    public $userAccount;
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