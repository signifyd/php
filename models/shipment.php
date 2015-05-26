<?php

class Shipment extends SignifydModel
{
    public $shipper;
    public $shippingMethod;
    public $shippingPrice;
    public $trackingNumber;

    public function __construct()
    {
        $validator = array();
        $validator["shipper"] = array("type" => "string", "value" => null);
        $validator["shippingMethod"] = array ("type" => "string", "value" => null);
        $validator["shippingPrice"] = array("type" => "double", "value" => null);
        $validator["trackingNumber"] = array ("type" => "string", "value" => null);

        $this->validationInfo = $validator;
    }
}