<?php
/**
 * The webhooksBulkResponse response object of the Signifyd SDK
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
namespace Signifyd\Core\Response;

use Signifyd\Core\Exceptions\LoggerException;
use Signifyd\Core\Logging;
use Signifyd\Core\Response;
use Signifyd\Core\Response\WebhooksResponse;

/**
 * Class WebhooksBulkResponse
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class WebhooksBulkResponse extends Response
{
    /**
     * The array of response webhooks
     *
     * @var array
     */
    public $objects = [];

    /**
     * If the response was in error
     *
     * @var bool
     */
    public $isError = false;

    /**
     * The error message
     *
     * @var string
     */
    public $errorMessage;

    public $message = [];

    /**
     * The logger object
     *
     * @var \Signifyd\Core\Logging
     */
    public $logger;

    /**
     * WebhooksResponse constructor.
     *
     * @param Logging $logger The logging object
     *
     * @throws LoggerException
     */
    public function __construct($logger)
    {
        if (!is_object($logger) || get_class($logger) !== 'Signifyd\Core\Logging') {
            throw new LoggerException('Invalid logger parameter');
        }

        $this->logger = $logger;
    }

    /**
     * Get the webhook array
     *
     * @return array
     */
    public function getObjects()
    {
        return $this->objects;
    }

    /**
     * Set the response objects
     *
     * @param string $response The response string
     *
     * @return void
     *
     * @throws LoggerException
     */
    public function setObject($response)
    {
        $webhooks = json_decode($response, true);
        foreach ($webhooks as $webhook) {
            $webhookJson = json_encode($webhook);
            $webhookObj = new WebhooksResponse($this->logger);
            $webhookObj->setObject($webhookJson);
            $this->objects[] = $webhookObj;
        }
    }
}
