<?php

/**
 * Copyright © 2015 SIGNIFYD Inc. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Signifyd\Models;

use Signifyd\Core\SignifydModel;


/**
 * Class Address
 * Contains a shipping/billing address
 */
class Address extends SignifydModel
{
    /**
     * @var string Main street address
     */
    public $streetAddress;
    /**
     * @var string Address line 2
     */
    public $unit;
    /**
     * @var string City name
     */
    public $city;
    /**
     * @var string Province (optional)
     */
    public $provinceCode;
    /**
     * @var string Local postal code.
     */
    public $postalCode;
    /**
     * @var string Country code
     */
    public $countryCode;
    /**
     * @var string Actual latitude
     */
    public $latitude;
    /**
     * @var string actual longitude
     */
    public $longitude;

    public function __construct()
    {
    }
}
