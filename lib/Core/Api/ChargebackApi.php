<?php
/**
 * ChargebackApi for the Signifyd SDK
 *
 * PHP version 8.2
 *
 * @category  Signifyd_Fraud_Protection
 * @package   Signifyd\Core
 * @author    Signifyd <info@signifyd.com>
 * @copyright 2026 SIGNIFYD Inc. All rights reserved.
 * @license   See LICENSE.txt for license details.
 * @link      https://www.signifyd.com/
 */
namespace Signifyd\Core\Api;

use Signifyd\Core\Connection;
use Signifyd\Core\Exceptions\ApiException;
use Signifyd\Core\Exceptions\InvalidClassException;
use Signifyd\Core\Logging;
use Signifyd\Core\Settings;
use Signifyd\Models\Chargeback\Chargeback;

/**
 * Class ChargebackApi
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class ChargebackApi
{
    /**
     * @var Settings
     */
    public $settings;

    /**
     * @var Connection
     */
    public $connection;

    /**
     * @var Logging
     */
    public $logger;

    /**
     * ChargebackApi constructor.
     *
     * @param array|Settings $args
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
        $this->logger->info('ChargebackApi initialized');
    }

    /**
     * Create a chargeback for a Signifyd case
     *
     * @param string $signifydCaseId The Signifyd case ID, used for logging/correlation only.
     *                                The endpoint itself correlates by orderId/chargebackId, not case id.
     * @param array|Chargeback $chargebackData Chargeback payload
     *
     * @return bool|\Signifyd\Core\Response\ChargebackResponse
     *
     * @throws ApiException
     * @throws InvalidClassException
     */
    public function createChargeback(string $signifydCaseId, $chargebackData)
    {
        $this->logger->info('ChargebackApi: createChargeback method called');

        if (is_array($chargebackData)) {
            $payload = json_encode($chargebackData);
        } elseif ($chargebackData instanceof Chargeback) {
            $payload = $chargebackData->toJson();
        } else {
            $this->logger->error('Invalid parameter for create chargeback');
            throw new ApiException('Invalid parameter for create chargeback');
        }

        $this->logger->info('ChargebackApi: sending payload for case ' . $signifydCaseId . ': ' . $payload);

        $endpoint = 'orders/events/chargebacks';
        $response = $this->connection->callApi(
            $endpoint,
            $payload,
            'post',
            'chargeback'
        );

        return $response;
    }
}
