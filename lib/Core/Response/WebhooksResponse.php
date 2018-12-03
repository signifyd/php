<?php
/**
 * The webhooks response object of the Signifyd SDK
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

use Signifyd\Core\Response;

/**
 * Class WebhooksResponse
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class WebhooksResponse extends Response
{
    /**
     * Webhook id
     *
     * @var int
     */
    public $id;

    /**
     * The webhook event type
     *
     * @var string
     */
    public $eventType;

    /**
     * The webhook event disply text
     *
     * @var string
     */
    public $eventDisplayText;

    /**
     * The webhook url
     *
     * @var string
     */
    public $url;

    /**
     * The team
     *
     * @var array
     */
    public $team = [];

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
     * @var \Signifyd\Core\Logging
     */
    public $logger;

    /**
     * WebhooksResponse constructor.
     *
     */
    public function __construct($logger)
    {
        $this->logger = $logger;
    }

    /**
     * Set the object
     *
     * @param string $response The received response
     *
     * @return bool|WebhooksResponse
     */
    public function setObject($response)
    {
        $responseArr = json_decode($response, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            $this->setIsError(true);
            $this->setErrorMessage(json_last_error_msg());
            return $this;
        }

        foreach ($responseArr as $itemKey => $item) {
            $method = 'set' . ucfirst($itemKey);
            if (method_exists($this, $method)) {
                $this->{$method}($item);
            } else {
                $this->logger->error('Method does not exist: ' . $method);
            }
        }

        return true;
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
     * Get the webhook id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the webhook id
     *
     * @param mixed $id The webhook id
     *
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the event type
     *
     * @return mixed
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * Set the event type
     *
     * @param mixed $eventType The event type
     *
     * @return void
     */
    public function setEventType($eventType)
    {
        $this->eventType = $eventType;
    }

    /**
     * Get the event display text
     *
     * @return mixed
     */
    public function getEventDisplayText()
    {
        return $this->eventDisplayText;
    }

    /**
     * Set the event display text
     *
     * @param mixed $eventDisplayText The event text
     *
     * @return void
     */
    public function setEventDisplayText($eventDisplayText)
    {
        $this->eventDisplayText = $eventDisplayText;
    }

    /**
     * Get the webhook url
     *
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the webhook url
     *
     * @param mixed $url The url
     *
     * @return void
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Get the Team
     *
     * @return mixed
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set the Team
     *
     * @param mixed $team The team
     *
     * @return void
     */
    public function setTeam($team)
    {
        $this->team = $team;
    }
}