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

use Signifyd\Core\Logging;
use Signifyd\Core\Response;

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
     */
    public function __construct($logger)
    {
        $this->logger = $logger;
    }

    /**
     * Set the error
     *
     * @param int    $httpCode The response code
     * @param string $error    The response
     *
     * @return void
     */
    public function setError($httpCode, $error)
    {
        $this->setIsError(true);
        $this->setErrorMessage($error);
    }

    /**
     * Get if there is an error
     *
     * @return bool
     */
    public function isError()
    {
        return $this->isError;
    }

    /**
     * Set the flag error
     *
     * @param bool $isError The flag
     *
     * @return void
     */
    public function setIsError($isError)
    {
        $this->isError = $isError;
    }

    /**
     * Get the error message
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * Set the error message
     *
     * @param string $errorMessage The error message
     *
     * @return void
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
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
     * @param string $response
     *
     * @return void
     */
    public function setObject($response)
    {
        $webhooks = json_decode($response, true);
        foreach ($webhooks as $webhook) {
            $webhookJson = json_encode($webhook);
            $webhookObj = new \Signifyd\Core\Response\WebhooksResponse($this->logger);
            $webhookObj->setObject($webhookJson);
            $this->objects[] = $webhookObj;
        }
    }
}