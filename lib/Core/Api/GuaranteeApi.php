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

use Signifyd\Core\Connection;
use Signifyd\Core\Exceptions\GuaranteeException;
use Signifyd\Core\Exceptions\InvalidClassException;
use Signifyd\Core\Logging;
use Signifyd\Core\Response;
use Signifyd\Core\Response\GuaranteeResponse;
use Signifyd\Core\Settings;
use Signifyd\Models\Guarantee;

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
    public $settings;

    public $connection;

    public $logger;

    /**
     * GuaranteeApi constructor.
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
        $this->logger->info('GuaranteeApi initialized');
    }

    /**
     * Crate a guarantee in Signifyd
     *
     * @param \Signifyd\Models\Guarantee $guarantee The guarantee data
     *
     * @return Response
     *
     * @throws InvalidClassException
     * @throws GuaranteeException
     */
    public function createGuarantee($guarantee)
    {
        $this->logger->info('CreateCase method called');
        if (is_array($guarantee)) {
            $case = new Guarantee($guarantee);
            //$valid = $case->validate();
            $valid = true;
            if (false === $valid) {
                $this->logger->error('Guarantee not valid after array init');
                $guaranteeResponse = new GuaranteeResponse();
                $guaranteeResponse->setIsError(true);
                $guaranteeResponse->setErrorMessage(
                    'Guarantee not valid after array init'
                );
                return $guaranteeResponse;
            }
        } elseif ($guarantee instanceof Guarantee) {
            //$valid = $guarantee->validate();
            $valid = true;
            if (false === $valid) {
                $this->logger->error('Guarantee not valid after object init');
                $guaranteeResponse = new GuaranteeResponse();
                $guaranteeResponse->setIsError(true);
                $guaranteeResponse->setErrorMessage(
                    'Guarantee not valid after object init'
                );
                return $guaranteeResponse;
            }
        } else {
            $this->logger->error('Invalid parameter for create case');
            throw new GuaranteeException(
                'Invalid parameter for create case'
            );
        }

        $this->logger->info(
            'Connection call create guarantee api with guarantee: '
            . $guarantee->toJson()
        );
        $response = $this->connection->callApi(
            'guarantees',
            $guarantee->toJson(),
            'post',
            'guarantee'
        );

        return $response;
    }

    /**
     * Cancel a guarantee in Signifyd
     *
     * @param int $caseId The case id
     *
     * @return Response
     *
     * @throws InvalidClassException
     */
    public function cancelGuarantee($caseId)
    {
        $this->logger->info('Cancel guarantee case method called');
        if (false === is_numeric($caseId)) {
            $this->logger->error('Invalid case id for get case' . $caseId);
            $guaranteeResponse = new GuaranteeResponse();
            $guaranteeResponse->setIsError(true);
            $guaranteeResponse->setErrorMessage('Invalid case id');
            return $guaranteeResponse;
        }

        // TODO need to move this to a model ???
        $guaranteeSend = ['guaranteeDisposition' => 'CANCELED'];
        $this->logger->info(
            'Connection call cancel guarantee api with caseId: ' . $caseId
        );

        $endpoint = 'cases/' . $caseId . '/guarantee';
        $payload = json_encode($guaranteeSend);
        $response = $this->connection->callApi(
            $endpoint,
            $payload,
            'put',
            'guarantee'
        );

        return $response;
    }

}