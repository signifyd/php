<?php
/**
 * CaseApi for the Signifyd SDK
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

/**
 * Class CaseApi
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class CaseApi
{
    public function createCase()
    {

    }

    public function getCase()
    {

    }

    public function closeCase()
    {

    }

    public function updatePayment()
    {

    }

    public function updateInvestigationLabel()
    {

    }

//    public function createCase($case)
//    {
//        $curl = $this->_setupPostJsonRequest($this->makeUrl("cases"), $case);
//        $response = $this->curlCall($curl);
//
//        return ($response === false)? false : json_decode($response)->investigationId;
//    }
//
//    public function getCase($caseId, $entry = null)
//    {
//        $url = $this->makeUrl("cases/$caseId");
//        if ($entry != null) {
//            $url .= "/$entry";
//        }
//        $curl = $this->_setupGetRequest($url);
//        $response = $this->curlCall($curl);
//
//        return ($response === false)? false : json_decode($response);
//    }
//
//    public function closeCase($caseId)
//    {
//        $url = $this->makeUrl("cases/$caseId");
//        $blob = array('status' => 'DISMISSED');
//        $curl = $this->_setupPutJsonRequest($url, $blob);
//        $response = $this->curlCall($curl);
//
//        return ($response === false)? false : json_decode($response);
//    }

//    public function updatePayment($caseId, $paymentUpdate)
//    {
//        $url = $this->makeUrl("cases/$caseId");
//        $blob = array("purchase" => $paymentUpdate);
//        $curl = $this->_setupPutJsonRequest($url, $blob);
//        $response = $this->curlCall($curl);
//
//        return ($response === false)? false : true;
//    }

//    public function updateInvestigationLabel($caseId, $investigationUpdate)
//    {
//        $url = $this->makeUrl("cases/$caseId");
//        $blob = array("reviewDisposition" => $investigationUpdate);
//        $curl = $this->_setupPutJsonRequest($url, $blob);
//        $response = $this->curlCall($curl);
//
//        return ($response === false)? false : true;
//    }
}