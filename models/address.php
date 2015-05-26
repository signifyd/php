<?php

class Address extends SignifydModel
{
    public $streetAddress;
    public $unit;
    public $city;
    public $provinceCode;
    public $postalCode;
    public $countryCode;
    public $latitude;
    public $longitude;

    public function __construct()
    {
        $validator = array();
        $validator["streetAddress"] = array("type" => "string", "value" => null);
        $validator["unit"] = array ("type" => "string", "value" => null);
        $validator["city"] = array("type" => "string", "value" => null);
        $validator["provinceCode"] = array ("type" => "string", "value" => null);
        $validator["postalCode"] = array("type" => "string", "value" => null);
        $validator["countryCode"] = array ("type" => "string", "value" => null);
        $validator["latitude"] = array ("type" => "string", "value" => null);
        $validator["longitude"] = array ("type" => "string", "value" => null);

        $this->validationInfo = $validator;
    }
}