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
class Response
{
    /**
     * Response constructor.
     *
     * @param array $response The response received from Signifyd
     */
    public function __construct($response = [])
    {
        //    if (is_array($args) && !empty($args)) {
        //        $this->settings = new \Signifyd\Core\Settings($args);
        //    } elseif ($args instanceof \Signifyd\Core\Settings) {
        //        $this->settings = $args;
        //    } else {
        //        $this->settings = new \Signifyd\Core\Settings([]);
        //    }
    }
}