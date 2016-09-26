<?php

/**
 * Copyright © 2015 SIGNIFYD Inc. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Signifyd\Core;

/**
 * Class SignifydModel Base class for all API model data. Handles data validation.
 */
abstract class SignifydModel
{
    /**
     * Base constructor
     */
    public function __construct()
    {
    }

    public static function Make($class)
    {
        if(is_subclass_of($class, '\Signifyd\Core\SignifydModel'))
        {
            return new $class();
        }
        return null;
    }

    /**
     * Serialize public data to json.
     * @return string JSON object
     */
    public function toJson()
    {
        return json_encode($this);
    }
}
