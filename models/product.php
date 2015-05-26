<?php

class Product extends SignifydModel
{
    public $itemId;
    public $itemName;
    public $itemUrl;
    public $itemQuality;
    public $itemPrice;
    public $itemHeight;

    public function __construct()
    {
        $validator = array();
        $validator["itemId"] = array("type" => "string", "value" => null);
        $validator["itemName"] = array ("type" => "string", "value" => null);
        $validator["itemUrl"] = array("type" => "string", "value" => null);
        $validator["itemQuality"] = array ("type" => "string", "value" => null);
        $validator["itemPrice"] = array("type" => "string", "value" => null);
        $validator["itemHeight"] = array("type" => "string", "value" => null);

        $this->validationInfo = $validator;
    }
}