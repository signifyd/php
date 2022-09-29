<?php
/**
 * The main response object of the Signifyd SDK
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
namespace Signifyd\Core;

/**
 * Class Response
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
abstract class Response
{
    /**
     * Messages describing the error.
     *
     * @var array
     */
    public $messages = [];

    /**
     * Response constructor.
     *
     * @param array $response The response received from Signifyd
     */
    public function __construct($response = [])
    {

    }

   /**
     * Set the error
     *
     * @param int $httpCode The response code
     * @param string $error The response
     *
     * @return void
     */
    public function setError($httpCode, $error)
    {
      $this->setIsError(true);
      $this->setErrorMessage($error);
    }

    /**
     * Set the error for the response object
     *
     * @param bool $isError The error state
     *
     * @return void
     */
    public function setIsError($isError)
    {
      $this->isError = $isError;
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
     * Setting the response data
     *
     * @param string $response The response from Signifyd
     *
     * @return void
     */
    public function setObject($response)
    {

    }

    /**
     * Setting the message
     *
     * @param string $message
     *
     * @return void
     */
    public function addMessage($message)
    {
        $this->messages[] = $message;
    }

    /**
     * Retrieve all messages
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Set messages
     *
     * @param array $messages
     *
     * @return void
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
    }
}
