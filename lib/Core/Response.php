<?php
/**
 * The main response object of the Signifyd SDK
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
 * Class Response
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
abstract class Response
{
    /**
     * Response constructor.
     *
     * @param array $response The response received from Signifyd
     */
    public function __construct($response = [])
    {

    }

    /**
     * Setting the error for the object
     *
     * @param int|string $httpCode The http status code
     * @param string     $error    The error message
     *
     * @return void
     */
    public function setError($httpCode, $error)
    {

    }

    /**
     * Setting the response data
     *
     * @param string $response The response from Signifyd
     *
     * @return void
     */
    public function setObject($response)
    {

    }
}