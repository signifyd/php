<?php
/**
 * The main entry point in the Signifyd SDK
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
 * Class ApiClient
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class ApiClient
{
    /**
     * The Signifyd settings
     *
     * @var object Settings
     */
    public $settings;

    /**
     * ApiClient constructor.
     *
     * @param array $args
     *
     * @return void
     */
    public function __construct($args = [])
    {
        if (is_array($args) && !empty($args)) {
            $this->settings = new \Signifyd\Core\Settings($args);
        } elseif ($args instanceof \Signifyd\Core\Settings) {
            $this->settings = $args;
        } else {
            $this->settings = new \Signifyd\Core\Settings([]);
        }
    }
}