<?php
/**
 * GuaranteeApi for the Signifyd SDK
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
namespace Signifyd\Core\Api;

use Signifyd\Core\Response;

/**
 * Class GuaranteeApi
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class GuaranteeApi
{
    /**
     * GuaranteeApi constructor.
     *
     * @param array $args The settings values
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     */
    public function __construct($args = [])
    {

    }

    /**
     * Crate a guarantee in Signifyd
     *
     * @param \Signifyd\Models\Guarantee $guarantee The guarantee data
     *
     * @return Response
     */
    public function createGuarantee($guarantee)
    {
        $response = '';

        return new Response($response);
    }

    /**
     * Cancel a guarantee in Signifyd
     *
     * @param \Signifyd\Models\Guarantee $guarantee The guarantee data
     *
     * @return Response
     */
    public function cancelGuarantee($guarantee)
    {
        $response = '';

        return new Response($response);
    }

    //    public function createGuarantee($guarantee)
    //    {
    //        $curl = $this->_setupPostJsonRequest(
    //      $this->makeUrl("guarantees"), $guarantee
    //);
    //        $response = $this->curlCall($curl);
    //
    //        return ($response === false)? false :
    // json_decode($response)->disposition;
    //    }
    //
    //    public function cancelGuarantee($caseId)
    //    {
    //        $url = $this->makeUrl("cases/$caseId/guarantee");
    //        $blob = ['guaranteeDisposition' => 'CANCELED'];
    //        $curl = $this->_setupPutJsonRequest($url, $blob);
    //        $response = $this->curlCall($curl);
    //
    //        return ($response === false)? false :
    // json_decode($response)->disposition;
    //    }
}