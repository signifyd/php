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
use Signifyd\Core\Exceptions\FulfillmentException;
use Signifyd\Core\Exceptions\InvalidClassException;
use Signifyd\Core\Logging;
use Signifyd\Core\Response\CaseResponse;
use Signifyd\Core\Response\FulfillmentBulkResponse;
use Signifyd\Core\Settings;
use Signifyd\Models\CaseModel;
use Signifyd\Models\Fulfillment;
use Signifyd\Models\PaymentUpdate;

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

    /**
     * The logger object
     *
     * @var Logging The logger class
     */
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
     * @throws InvalidClassException
     * @throws \Signifyd\Core\Exceptions\LoggerException
     */
    public function createCase($case)
    {
        $this->logger->info('CreateCase method called');
        if (is_array($case)) {
            $case = new CaseModel($case);
            $valid = $case->validate();
            if (true !== $valid) {
                $this->logger->error('Case not valid after array init: ' . json_encode($valid));
            }
        } elseif ($case instanceof CaseModel) {
            $valid = $case->validate();
            if (true !== $valid) {
                $this->logger->error('Case not valid after object init: ' . json_encode($valid));
            }
        } else {
            $this->logger->error('Invalid parameter for create case');
            throw new CaseModelException(
                'Invalid parameter for create case'
            );
        }

        $this->logger->info(
            'Connection call create case api with case: ' . $case->toJson()
        );
        $response = $this->connection->callApi(
            'cases',
            $case->toJson(),
            'post',
            'case'
        );

        return $response;
    }

    /**
     * Getting the case from Signifyd
     *
     * @param int $caseId The id of the case
     *
     * @return CaseResponse
     *
     * @throws InvalidClassException
     * @throws \Signifyd\Core\Exceptions\LoggerException
     */
    public function getCase($caseId)
    {
        $this->logger->info('Get case method called');
        if (false === is_numeric($caseId)) {
            $this->logger->error('Invalid case id for get case' . $caseId);
        }

        $this->logger->info(
            'Connection call get case api with caseId: ' . $caseId
        );

        $endpoint = 'cases/' . $caseId;
        $response = $this->connection->callApi($endpoint);

        return $response;
    }

    /**
     * Update payment in Signifyd
     *
     * @param \Signifyd\Models\PaymentUpdate $paymentUpdate The update case data
     *
     * @return \Signifyd\Core\Response\CaseResponse
     *
     * @throws InvalidClassException
     * @throws CaseModelException
     * @throws \Signifyd\Core\Exceptions\LoggerException
     */
    public function updatePayment($paymentUpdate)
    {
        $this->logger->info('Get case method called');
        if (is_array($paymentUpdate)) {
            $paymentUpdate = new PaymentUpdate($paymentUpdate);
            $valid = $paymentUpdate->validate();
            if (true !== $valid) {
                $this->logger->error('Case not valid after array init: ' . json_encode($valid));
            }
        } elseif ($paymentUpdate instanceof PaymentUpdate) {
            $valid = $paymentUpdate->validate();
            if (true !== $valid) {
                $this->logger->error('Case not valid after object init' . json_encode($valid));
            }
        } else {
            $this->logger->error('Invalid parameter for payment update');
            throw new CaseModelException(
                'Invalid parameter for payment update'
            );
        }

        $this->logger->info(
            'Connection call update payment api with payment: '
            . $paymentUpdate->toJson()
        );

        $endpoint = 'cases/' . $paymentUpdate->getCaseId();
        unset($paymentUpdate->caseId);
        $response = $this->connection->callApi(
            $endpoint,
            $paymentUpdate->toJson(),
            'put'
        );

        return $response;
    }

    /**
     * Update an investigation in Signifyd
     *
     * @param int    $caseId              The case id
     * @param string $investigationUpdate The review disposition
     *
     * @return \Signifyd\Core\Response
     *
     * @throws InvalidClassException
     * @throws \Signifyd\Core\Exceptions\LoggerException
     */
    public function updateInvestigationLabel($caseId, $investigationUpdate)
    {
        $this->logger->info('Update investigation label method called');
        if (false === is_numeric($caseId)) {
            $this->logger->error(
                'Invalid case id for update investigation label' . $caseId
            );
        }

        if (false === is_numeric($caseId)) {
            $this->logger->error(
                'Invalid case id for update investigation label' . $caseId
            );
        }

        // TODO need to move this to a model ???
        $caseSend = ['reviewDisposition' => $investigationUpdate];
        $this->logger->info(
            'Connection call update investigation api with caseId: ' . $caseId
        );

        $endpoint = 'cases/' . $caseId;
        $payload = json_encode($caseSend);
        $response = $this->connection->callApi($endpoint, $payload, 'put');

        return $response;
    }

    /**
     * Add fulfillments to an order
     *
     * @param $fulfillments
     *
     * @return FulfillmentBulkResponse
     *
     * @throws InvalidClassException
     * @throws FulfillmentException
     */
    public function addFulfillment($fulfillments)
    {
        $this->logger->info('Add Fulfillment method called');
        if (is_array($fulfillments)) {
            if (isset($fulfillments['id'])) {
                $fulfillment = new Fulfillment($fulfillments);
                $valid = $fulfillment->validate();
                if (true !== $valid) {
                    $this->logger->error('Fulfillment not valid after array init: ' . json_encode($valid));
                }
            } else {
                $fulfillmentsArr = [];
                foreach ($fulfillments as $fulfillment) {
                    $fulfillmentObj = new Fulfillment($fulfillment);
                    $valid = $fulfillmentObj->validate();
                    if (true !== $valid) {
                        $this->logger->error('Fulfillment not valid after array init: ' . json_encode($valid));
                    }

                    $fulfillmentsArr[] = $fulfillmentObj;
                }

            }
        } elseif ($fulfillments instanceof Fulfillment) {
            $valid = $fulfillments->validate();
            if (true !== $valid) {
                $this->logger->error('Fulfillment not valid after object init');
            }

            $fulfillmentsArr = [$fulfillments];
        } else {
            $this->logger->error('Invalid parameter for create fulfillment');
            throw new FulfillmentException(
                'Invalid parameter for create fulfillment'
            );
        }

        $this->logger->info(
            'Connection call add fulfillment with: ' . json_encode($fulfillmentsArr)
        );

        $orderId = $fulfillmentsArr[0]->getOrderId();
        $payload = json_encode(['fulfillments' => $fulfillmentsArr]);
        $endpoint = 'fulfillments/' . $orderId;
        $response = $this->connection->callApi(
            $endpoint,
            $payload,
            'post',
            'fulfillmentBulk'
        );

        return $response;
    }
}