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
use Signifyd\Core\Response\WebhooksBulkResponse;
use Signifyd\Core\Response\WebhooksResponse;
use Signifyd\Core\Settings;
use Signifyd\Models\Webhook;

/**
 * Class WebhooksApi
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class WebhooksApi
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
        $this->logger->info('WebhooksApi initialized');
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
     * @param array|object $webHooks Webhook data
     *
     * @return
     *
     * @throws InvalidClassException
     * @throws WebhookModelException
     */
    public function createWebhooks($webHooks)
    {
        $this->logger->info('CreateWebhooks method called');
        if (is_array($webHooks)) {
            if (isset($webHooks['event'])) {
                $webHooks = new Webhook($webHooks);
                $valid = $webHooks->validate();
                if (false === $valid) {
                    $this->logger->error('Webhook not valid after array init');
                    $webHookResponse = new WebhooksBulkResponse($this->logger);
                    $webHookResponse->setIsError(true);
                    $webHookResponse->setErrorMessage(
                        'Webhook not valid after array init'
                    );
                    return $webHookResponse;
                }
            } else {
                $webhooksArr = [];
                foreach ($webHooks as $webHook) {
                    $webHooksObj = new Webhook($webHook);
                    $valid = $webHooksObj->validate();
                    if (false === $valid) {
                        $this->logger->error('Webhook not valid after array init');
                        $webHookResponse = new WebhooksBulkResponse($this->logger);
                        $webHookResponse->setIsError(true);
                        $webHookResponse->setErrorMessage(
                            'Webhook not valid after array init'
                        );
                        return $webHookResponse;
                    }

                    $webhooksArr[] = $webHooksObj;
                }

            }
        } elseif ($webHooks instanceof Webhook) {
            $valid = $webHooks->validate();
            if (false === $valid) {
                $this->logger->error('Case not valid after object init');
                $webHookResponse = new WebhooksBulkResponse($this->logger);
                $webHookResponse->setIsError(true);
                $webHookResponse->setErrorMessage(
                    'Webhook not valid after object init'
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

        $this->logger->info(
            'Connection call create case api with case: ' . json_encode($webHooks)
        );

        $payload = json_encode(['webhooks' => $webHooks]);
        $endpoint = 'teams/webhooks';
        $response = $this->connection->callApi(
            $endpoint,
            $payload,
            'post',
            'webhooksBulk'
        );

        return $response;
    }

    /**
     * Update existing webhooks for a team in bulk.
     *
     * @param mixed $webHooks Webhooks data
     *
     * @return \Signifyd\Core\Response\WebhooksBulkResponse
     *
     * @throws InvalidClassException
     * @throws WebhookModelException
     */
    public function updateWebhooks($webHooks)
    {
        $this->logger->info('Update wehbooks method called');
        if (is_array($webHooks)) {
            $webHook = new Webhook($webHooks);
            $valid = $webHook->validate();
            if (false === $valid) {
                $this->logger->error('Webhook not valid after array init');
                $webHookResponse = new WebhooksBulkResponse($this->logger);
                $webHookResponse->setIsError(true);
                $webHookResponse->setErrorMessage(
                    'Webhook not valid after array init'
                );
                return $webHookResponse;
            }
        } elseif ($webHooks instanceof Webhook) {
            $valid = $webHooks->validate();
            if (false === $valid) {
                $this->logger->error('Webhook not valid after object init');
                $webHookResponse = new WebhooksBulkResponse($this->logger);
                $webHookResponse->setIsError(true);
                $webHookResponse->setErrorMessage(
                    'Webhook not valid after object init'
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
            'webhooksBulk'
        );

        return $response;
    }

    /**
     * Retrieve all webhooks for a team.
     *
     * @return \Signifyd\Core\Response\WebhooksBulkResponse $response List of webhooks
     *
     * @throws InvalidClassException
     */
    public function getWebhooks()
    {
        $endpoint = 'teams/webhooks';
        $response = $this->connection->callApi($endpoint, '', 'get', 'webhooksBulk');

        return $response;
    }

    /**
     * Modify an existing webhook for a team.
     *
     * @param Webhook $webHook Webhook data
     *
     * @return bool|mixed
     *
     * @throws InvalidClassException
     * @throws WebhookModelException
     */
    public function updateWebhook($webHook)
    {
        $this->logger->info('Update webhook method called');
        if (is_array($webHook)) {
            $webHook = new Webhook($webHook);
            $valid = $webHook->validate();
            if (false === $valid) {
                $this->logger->error('Webhook not valid after array init');
                $caseResponse = new WebhooksResponse($this->logger);
                $caseResponse->setIsError(true);
                $caseResponse->setErrorMessage('Webhook not valid after array init');
                return $caseResponse;
            }
        } elseif ($webHook instanceof Webhook) {
            $valid = $webHook->validate();
            if (false === $valid) {
                $this->logger->error('Case not valid after object init');
                $caseResponse = new WebhooksResponse($this->logger);
                $caseResponse->setIsError(true);
                $caseResponse->setErrorMessage(
                    'Webhook not valid after object init'
                );
                return $caseResponse;
            }
        } else {
            $this->logger->error('Invalid parameter for update web hook');
            throw new WebhookModelException(
                'Invalid parameter for update web hook'
            );
        }

        $this->logger->info(
            'Connection call update web hook api with hook id: ' . $webHook->toJson()
        );

        $payload = $webHook->toJson();
        $endpoint = 'teams/webhooks/' . $webHook->getId();
        $response = $this->connection->callApi(
            $endpoint,
            $payload,
            'put',
            'webhooks'
        );

        return $response;
    }

    /**
     * Delete an existing webhook for a team.
     *
     * @param Webhook $webHook Webhook data
     *
     * @return WebhooksResponse
     *
     * @throws InvalidClassException
     */
    public function deleteWebhook($webHook)
    {
        $this->logger->info('Get delete webhook method called');
        if (false === is_numeric($webHook->getId())) {
            $this->logger->error(
                'Invalid webhook id for get case' . $webHook->getId()
            );
            $caseResponse = new WebhooksResponse($this->logger);
            $caseResponse->setIsError(true);
            $caseResponse->setErrorMessage('Invalid webhook id');
            return $caseResponse;
        }

        $this->logger->info(
            'Connection call delete webhook with Id: ' . $webHook->getId()
        );

        $endpoint = 'teams/webhooks/' . $webHook->getId();
        $response = $this->connection->callApi(
            $endpoint,
            '',
            'delete',
            'webhooks'
        );

        return $response;
    }
}