<?php

class Recipient extends SignifydModel
{
    public $fullName;
    public $confirmationEmail;
    public $confirmationPhone;
    public $organization;
    public $deliveryAddress;

    public function __construct()
    {
        $validator = array();
        $validator["fullName"] = array("type" => "string", "value" => null);
        $validator["confirmationEmail"] = array ("type" => "string", "value" => null);
        $validator["confirmationPhone"] = array("type" => "string", "value" => null);
        $validator["organization"] = array ("type" => "string", "value" => null);
        $validator["deliveryAddress"] = array("type" => "SignifydModel", "value" => array(
            "subtype" => "Address"
        ));

        $this->validationInfo = $validator;
    }
}