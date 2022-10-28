<?php
/**
 * WebhooksApi for the Signifyd SDK
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
use Signifyd\Core\Exceptions\ConnectionException;
use Signifyd\Core\Exceptions\InvalidClassException;
use Signifyd\Core\Exceptions\LoggerException;
use Signifyd\Core\Exceptions\WebhookModelException;
use Signifyd\Core\Logging;
use Signifyd\Core\Response\WebhooksV2BulkResponse;
use Signifyd\Core\Response\WebhooksV2Response;
use Signifyd\Core\Settings;
use Signifyd\Models\WebhookV2;

/**
 * Class WebhooksV2Api
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class WebhooksV2Api
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
     * WebhooksApi constructor.
     *
     * @param array $args The settings values
     *
     * @throws LoggerException
     * @throws ConnectionException
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
        $this->logger->info('WebhookV2sApi initialized');
    }

    /**
     * Validate a webhook request
     *
     * @param string $request The request body
     * @param string $hash    The hashed request
     * @param string $topic   The topic
     *
     * @return bool
     */
    public function validWebhookRequest($request, $hash, $topic)
    {
        $check = base64_encode(
            hash_hmac('sha256', $request, $this->settings->getApiKey(), true)
        );
        $this->logger->info("Api request hash: " . $hash);
        $this->logger->info("Api request hash check: " . $check);

        if ($check == $hash) {
            return true;
        } else {
            if ($topic == "cases/test") {
                // In the case that this is a webhook test,
                // the encoding ABCDE is allowed
                $check = base64_encode(
                    hash_hmac('sha256', $request, 'ABCDE', true)
                );
                if ($check == $hash) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Create a new webhook or webhooks for a team.
     *
     * @param array|object $webHooks WebhookV2 data
     *
     * @return object WebhooksBulkApi
     *
     * @throws InvalidClassException
     * @throws WebhookModelException
     * @throws LoggerException
     */
    public function createWebhooks($webHooks)
    {
        $this->logger->info('CreateWebhooks v2 method called');
        if (is_array($webHooks)) {
            if (isset($webHooks['event'])) {
                $webHooks = new WebhookV2($webHooks);
                $valid = $webHooks->validate();
                if (false === $valid) {
                    $this->logger->error('WebhookV2 not valid after array init');
                    $webHookResponse = new WebhooksV2BulkResponse($this->logger);
                    $webHookResponse->setIsError(true);
                    $webHookResponse->setErrorMessage(
                        'WebhookV2 not valid after array init'
                    );
                    return $webHookResponse;
                }
            } else {
                $webhooksArr = [];
                foreach ($webHooks as $webHook) {
                    $webHooksObj = new WebhookV2($webHook);
                    $valid = $webHooksObj->validate();
                    if (false === $valid) {
                        $this->logger->error('WebhookV2 not valid after array init');
                        $webHookResponse = new WebhooksV2BulkResponse($this->logger);
                        $webHookResponse->setIsError(true);
                        $webHookResponse->setErrorMessage(
                            'WebhookV2 not valid after array init'
                        );
                        return $webHookResponse;
                    }

                    $webhooksArr[] = $webHooksObj;
                }

            }
        } elseif ($webHooks instanceof WebhookV2) {
            $valid = $webHooks->validate();
            if (false === $valid) {
                $this->logger->error('Case not valid after object init');
                $webHookResponse = new WebhooksV2BulkResponse($this->logger);
                $webHookResponse->setIsError(true);
                $webHookResponse->setErrorMessage(
                    'WebhookV2 not valid after object init'
                );
                return $webHookResponse;
            }

            $webHooks = [$webHooks];
        } else {
            $this->logger->error('Invalid parameter for create webhook');
            throw new WebhookModelException(
                'Invalid parameter for create webhook'
            );
        }

        $payload = json_encode(['webhooks' => $webHooks]);
        $endpoint = 'teams/webhooks';

        $this->logger->info(
            'Connection call create webhook api with: ' . $payload
        );

        $response = $this->connection->callApi(
            $endpoint,
            $payload,
            'post',
            'webhooksV2Bulk'
        );

        return $response;
    }

    /**
     * Update existing webhooks for a team in bulk.
     *
     * @param mixed $webHooks Webhooks data
     *
     * @return \Signifyd\Core\Response\WebhooksV2BulkResponse
     *
     * @throws InvalidClassException
     * @throws WebhookModelException
     * @throws LoggerException
     */
    public function updateWebhooks($webHooks)
    {
        $this->logger->info('Update wehbooks method called');
        if (is_array($webHooks)) {
            $webHook = new WebhookV2($webHooks);
            $valid = $webHook->validate();
            if (false === $valid) {
                $this->logger->error('WebhookV2 not valid after array init');
                $webHookResponse = new WebhooksV2BulkResponse($this->logger);
                $webHookResponse->setIsError(true);
                $webHookResponse->setErrorMessage(
                    'WebhookV2 not valid after array init'
                );
                return $webHookResponse;
            }
        } elseif ($webHooks instanceof WebhookV2) {
            $valid = $webHooks->validate();
            if (false === $valid) {
                $this->logger->error('WebhookV2 not valid after object init');
                $webHookResponse = new WebhooksV2BulkResponse($this->logger);
                $webHookResponse->setIsError(true);
                $webHookResponse->setErrorMessage(
                    'WebhookV2 not valid after object init'
                );
                return $webHookResponse;
            }
        } else {
            $this->logger->error('Invalid parameter for update webhooks');
            throw new WebhookModelException(
                'Invalid parameter for webhooks'
            );
        }

        $this->logger->info(
            'Connection call update webhooks api with webhook: ' . $webHook->toJson()
        );

        $payload = json_encode($webHooks);
        $endpoint = 'teams/webhooks';
        $response = $this->connection->callApi(
            $endpoint,
            $payload,
            'put',
            'webhooksV2Bulk'
        );

        return $response;
    }

    /**
     * Retrieve all webhooks for a team.
     *
     * @return WebhooksV2BulkResponse $response List of webhooks
     *
     * @throws InvalidClassException
     */
    public function getWebhooks()
    {
        $endpoint = 'teams/webhooks';
        $response = $this->connection->callApi($endpoint, '', 'get', 'webhooksV2Bulk');

        return $response;
    }

    /**
     * Delete an existing webhook for a team.
     *
     * @param int $webHookId WebhookV2 data
     *
     * @return WebhooksV2Response
     *
     * @throws InvalidClassException
     * @throws LoggerException
     */
    public function deleteWebhook($webHookId)
    {
        $this->logger->info('Get delete webhook method called');
        if (false === is_numeric($webHookId)) {
            $this->logger->error(
                'Invalid webhook id for get case' . $webHookId
            );
            $caseResponse = new WebhooksV2Response($this->logger);
            $caseResponse->setIsError(true);
            $caseResponse->setErrorMessage('Invalid webhook id');
            return $caseResponse;
        }

        $this->logger->info(
            'Connection call delete webhook with Id: ' . $webHookId
        );

        $endpoint = 'teams/webhooks/' . $webHookId;
        $response = $this->connection->callApi(
            $endpoint,
            '',
            'delete',
            'webhooks'
        );

        return $response;
    }
}