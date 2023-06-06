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
use Signifyd\Core\Exceptions\ApiException;
use Signifyd\Core\Exceptions\InvalidClassException;
use Signifyd\Core\Logging;
use Signifyd\Core\Response\CaseResponse;
use Signifyd\Core\Settings;
use Signifyd\Models\SaleModel;
use Signifyd\Models\Reroute;

/**
 * Class ApiModel
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class ApiModel
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
        $this->logger->info('Signifyd Api initialized');
    }

    public function updateOrder($order, $signifydId)
    {
        //TODO: implements updateOrder for v3
    }

    /**
     * Getting the case from Signifyd
     *
     * @param int $signifydId
     *
     * @return CaseResponse
     *
     * @throws InvalidClassException
     * @throws \Signifyd\Core\Exceptions\LoggerException
     */
    public function getCase($orderId)
    {
        $this->logger->info('SaleApi: Get case method called');
        if (false === is_numeric($orderId)) {
            $this->logger->error('SaleApi: Invalid case id for get case' . $orderId);
        }

        $this->logger->info(
            'SaleApi: Connection call get case api with order id: ' . $orderId
        );

        $endpoint = 'orders/' . $orderId . '/decision';
        $response = $this->connection->callApi(
            $endpoint,
            '',
            'get',
            'sale'
        );

        return $response;
    }

    /**
     * Record a change to the price of an order where the buyer did not initiate the change.
     *
     * @param $repriceData
     * @return bool|mixed|object|\Signifyd\Core\Response
     * @throws InvalidClassException
     */
    public function reprice($repriceData)
    {
        $reprice = new \Signifyd\Models\Reprice($repriceData);

        $this->logger->info(
            'Connection call reprice with: ' . $reprice->toJson()
        );

        $response = $this->connection->callApi(
            'orders/events/repricings',
            $reprice->toJson(),
            'post',
            'sale'
        );

        return $response;
    }

    /**
     * Call this endpoint anytime Delivery Address on an Order needs to be changed.
     *
     * @param $reroute
     * @return bool|mixed|object|\Signifyd\Core\Response
     * @throws ApiException
     * @throws InvalidClassException
     */
    public function reroute($reroute)
    {
        $this->logger->info('SaleApi: reroute method called');
        if (is_array($reroute)) {
            $reroute = new Reroute($reroute);
            $valid = $reroute->validate();
            if (true !== $valid) {
                $this->logger->error(
                    'Reroute not valid after array init: ' . json_encode($valid)
                );
            }
        } elseif ($reroute instanceof Reroute) {
            $valid = $reroute->validate();
            if (true !== $valid) {
                $this->logger->error(
                    'Reroute not valid after object init: ' . json_encode($valid)
                );
            }
        } else {
            $this->logger->error('Invalid parameter for create reroute');
            throw new ApiException(
                'Invalid parameter for create reroute'
            );
        }

        $this->logger->info(
            'Connection call reroute with: ' . $reroute->toJson()
        );

        $response = $this->connection->callApi(
            'orders/events/reroutes',
            $reroute->toJson(),
            'post',
            'checkouts'
        );

        return $response;
    }

    /**
     * Use this endpoint to record a list of fulfillments associated with an Order.
     *
     * @param $fulfillmentsData
     * @return bool|mixed|object|\Signifyd\Core\Response
     * @throws InvalidClassException
     */
    public function addFulfillment($fulfillmentsData)
    {
        $fulfillments = new \Signifyd\Models\Fulfillments($fulfillmentsData);

        $this->logger->info(
            'Connection call addFulfillments with: ' . $fulfillments->toJson()
        );

        $response = $this->connection->callApi(
            'orders/events/fulfillments',
            $fulfillments->toJson(),
            'post',
            'sale'
        );

        return $response;
    }
}