<?php
/**
 * The fulfilment bulk response object of the Signifyd SDK
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
 * Class FulfillmentBulkResponse
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class FulfillmentBulkResponse extends Response
{
    /**
     * The array of fulfilment
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
     * FulfillmentBulkResponse constructor.
     *
     * @param Logging $logger The logging object
     */
    public function __construct($logger)
    {
        $this->logger = $logger;
    }

    /**
     * Is the response in error
     *
     * @return bool
     */
    public function isError()
    {
        return $this->isError;
    }

    /**
     * Set the response error
     *
     * @param bool $isError
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
     * @param string $errorMessage
     *
     * @return void
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }


    /**
     * Get the response objects
     *
     * @return array
     */
    public function getObjects()
    {
        return $this->objects;
    }

    /**
     * Set the objects from the response
     *
     * @param string $response
     *
     * @return void
     */
    public function setObject($response)
    {
        $fulfillments = json_decode($response, true);
        foreach ($fulfillments['fulfillments'] as $fulfillment) {
            $fulfillmentObject = new \Signifyd\Models\Fulfillment($fulfillment);
            $this->objects[] = $fulfillmentObject;
        }
    }

}