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

use Signifyd\Core\Connection;
use Signifyd\Core\Exceptions\CaseModelException;
use Signifyd\Core\Logging;
use Signifyd\Core\Settings;
use Signifyd\Models\CaseModel;

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
    /**
     * The SDK settings
     *
     * @var Settings The settings object
     */
    public $settings;

    /**
     * The curl connection class
     *
     * @var Connection The connection object
     */
    public $connection;

    public $logger;

    /**
     * CaseApi constructor.
     *
     * @param array $args The settings values
     *
     * @throws \Signifyd\Core\Exceptions\LoggerException
     * @throws \Signifyd\Core\Exceptions\ConnectionException
     */
    public function __construct($args = [])
    {
        if (is_array($args) && !empty($args)) {
            $this->settings = new Settings($args);
        } elseif ($args instanceof Settings) {
            $this->settings = $args;
        } else {
            $this->settings = new Settings([]);
        }

        $this->logger = new Logging($this->settings);
        $this->connection = new Connection($this->settings);
        $this->logger->info('CaseApi initialized');
    }

    /**
     * Create a case in Signifyd
     *
     * @param \Signifyd\Models\CaseModel $case The case data
     *
     * @return bool|\Signifyd\Core\Response
     *
     * @throws CaseModelException
     */
    public function createCase($case)
    {
        $this->logger->info('CreateCase method called');
        if (is_array($case)) {
            $case = new \Signifyd\Models\CaseModel($case);
            //$valid = $case->validate();
            $valid = true;
            if (false === $valid) {
                $this->logger->error('Case not valid after array init');
                return false;
            }
        } elseif ($case instanceof CaseModel) {
            $case->validate();
            //$valid = $case->validate();
            if (false === $valid) {
                $this->logger->error('Case not valid after object init');
                return false;
            }
        } else {
            $this->logger->error('Invalid parameter for create case');
            throw new CaseModelException(
                'Invalid parameter for create case'
            );
        }

        $this->logger->info(
            'Calling connection call Api with case: ' . $case->toJson()
        );
        $response = $this->connection->callApi('cases', $case->toJson(), 'post');

        return $response;
    }

    /**
     * Getting the case from Signifyd
     *
     * @param \Signifyd\Models\CaseModel $case The case Data
     *
     * @return \Signifyd\Core\Response
     */
    public function getCase($case)
    {
        $response = $this->connection->callApi($case, 'get', 'get');

        return new \Signifyd\Core\Response($response);
    }

    /**
     * Close a case in Signifyd
     *
     * @param \Signifyd\Models\CaseModel $case The case data
     *
     * @return \Signifyd\Core\Response
     */
    public function closeCase($case)
    {
        $response = $this->connection->callApi($case, 'close', 'put');

        return new \Signifyd\Core\Response($response);
    }

    /**
     * Update payment in Signifyd
     *
     * @param \Signifyd\Models\CaseModel $case The case data
     *
     * @return \Signifyd\Core\Response
     */
    public function updatePayment($case)
    {
        $response = $this->connection->callApi($case, 'updatePayment', 'put');

        return new \Signifyd\Core\Response($response);
    }

    /**
     * Update an investigation in Signifyd
     *
     * @param \Signifyd\Models\CaseModel $case The case data
     *
     * @return \Signifyd\Core\Response
     */
    public function updateInvestigationLabel($case)
    {
        $response = $this->connection->callApi($case, 'updateInvestigation', 'put');

        return new \Signifyd\Core\Response($response);
    }

    //    public function createCase($case)
    //    {
    //        $curl = $this->_setupPostJsonRequest($this->makeUrl("cases"), $case);
    //        $response = $this->curlCall($curl);
    //
    //        return ($response === false)?
    //          false : json_decode($response)->investigationId;
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