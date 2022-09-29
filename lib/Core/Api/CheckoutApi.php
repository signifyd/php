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

use Signifyd\Core\Exceptions\ApiException;
use Signifyd\Core\Exceptions\InvalidClassException;
use Signifyd\Models\CheckoutModel;
use Signifyd\Models\CheckoutTransaction;
use Signifyd\Models\SendTransaction;

/**
 * Class CheckoutApi
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class CheckoutApi extends ApiModel
{
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
        parent::__construct($args);
        $this->logger->info('CheckoutApi initialized');
    }

    /**
     * Create a case in Signifyd
     *
     * @param \Signifyd\Models\CaseModel $order The case data
     *
     * @return bool|\Signifyd\Core\Response\CheckoutsResponse
     *
     * @throws ApiException
     * @throws InvalidClassException
     * @throws \Signifyd\Core\Exceptions\LoggerException
     */
    public function createOrder($endpoint, $order)
    {
        $this->logger->info('CheckoutApi: CreateOrder method called');
        if (is_array($order)) {
            $order = new CheckoutModel($order);
            $valid = $order->validate();
            if (true !== $valid) {
                $this->logger->error(
                    'Order not valid after array init: ' . json_encode($valid)
                );
            }
        } elseif ($order instanceof CheckoutModel) {
            $valid = $order->validate();
            if (true !== $valid) {
                $this->logger->error(
                    'Order not valid after object init: ' . json_encode($valid)
                );
            }
        } else {
            $this->logger->error('Invalid parameter for create order');
            throw new ApiException(
                'Invalid parameter for create order'
            );
        }

        $this->logger->info(
            'Connection call checkout api with: ' . $order->toJson()
        );
        $response = $this->connection->callApi(
            $endpoint,
            $order->toJson(),
            'post',
            'checkouts'
        );

        return $response;
    }

    /**
     * @param $transaction
     * @return bool|mixed|object|\Signifyd\Core\Response
     * @throws ApiException
     * @throws InvalidClassException
     */
    public function createTransaction($transaction)
    {
        $this->logger->info('CheckoutApi: CreateTransaction method called');
        if (is_array($transaction)) {
            $transaction = new CheckoutTransaction($transaction);
            $valid = $transaction->validate();
            if (true !== $valid) {
                $this->logger->error(
                    'Transaction not valid after array init: ' . json_encode($valid)
                );
            }
        } elseif ($transaction instanceof CheckoutTransaction) {
            $valid = $transaction->validate();
            if (true !== $valid) {
                $this->logger->error(
                    'Transaction not valid after object init: ' . json_encode($valid)
                );
            }
        } else {
            $this->logger->error('Invalid parameter for create case');
            throw new ApiException(
                'Invalid parameter for create transaction'
            );
        }

        $this->logger->info(
            'Connection call create case api with transaction: ' . $transaction->toJson()
        );
        $response = $this->connection->callApi(
            'orders/events/transactions',
            $transaction->toJson(),
            'post',
            'transactions'
        );

        return $response;
    }
}