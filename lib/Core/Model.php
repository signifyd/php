<?php
/**
 * Main model for the Signifyd SDK
 *
 * PHP version 5.6
 *
 * @category  Signifyd_Fraud_Protection
 * @package   Signifyd\Core
 * @author    Signifyd <info@signifyd.com>
 * @copyright 2018 SIGNIFYD Inc. All rights reserved.
 * @license   See LICENSE.txt for license details.
 * @link      https://www.signifyd.com/
 */
namespace Signifyd\Core;

/**
 * Class Model
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Model
{
    /**
     * Base constructor
     */
    public function __construct()
    {
    }

    /**
     * Serialize public data to json.
     *
     * @return string JSON object
     */
    public function toJson()
    {
        return json_encode($this);
    }

    /**
     * Validate field to be not empty
     *
     * @param string $value The value that needs validation
     *
     * @return bool
     */
    public function required($value)
    {
        //TODO add code to validate not empty
        return true;
    }

    /**
     * Validate field to be of type date
     *
     * @param string $value The value that needs validation
     *
     * @return bool
     */
    public function date($value)
    {
        //TODO add code to validate for date
        return true;
    }

    /**
     * Validate field to be of type string
     *
     * @param string $value The value that needs validation
     *
     * @return bool
     */
    public function string($value)
    {
        //TODO add code to validate for string
        return true;
    }

    /**
     * Validate field to be of type datetime
     *
     * @param string $value The value that needs validation
     *
     * @return bool
     */
    public function datetime($value)
    {
        //TODO add code to validate for datetime
        return true;
    }

    /**
     * Validate field to be of type double
     *
     * @param float $value The value that needs validation
     *
     * @return bool
     */
    public function double($value)
    {
        //TODO add code to validate for float
        return true;
    }

    /**
     * Validate enums
     *
     * @param string $fieldValue    The field Value
     * @param array  $allowedValues Array of allowed values
     *
     * @return bool
     */
    public function enumValid($fieldValue, $allowedValues)
    {
        if (empty($fieldValue)) {
            return true;
        }

        $lowerFieldValue = strtolower($fieldValue);
        if (in_array($lowerFieldValue, $allowedValues)) {
            return true;
        }

        return false;
    }

    /**
     * Validate the AVS/CVV code
     *
     * @param string $code The code value
     *
     * @return bool
     */
    public function avsCvvValidate($code)
    {
        if (empty($code)) {
            return true;
        }

        $avsCvvValidCodes = "YASRUZNWXBTPCDGIMF";
        if (false === strpos($avsCvvValidCodes, $code)) {
            return false;
        }

        return true;
    }
}