<?php
/**
 * The logging class for the  entry point in the Signifyd SDK
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

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Signifyd\Core\Exceptions\LoggerException;

/**
 * Class Logging
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Logging
{
    /*
     * The main logger implementation
     *
     * @var \Monolog\Logger
     */
    protected $logger;

    /**
     * THe settings of the SDK
     *
     * @var \Signifyd\Core\Settings
     */
    protected $settings;

    /**
     * Logging constructor.
     *
     * @param \Signifyd\Core\Settings $settings The settings
     *
     * @throws LoggerException
     */
    public function __construct($settings)
    {
        if ($settings instanceOf \Signifyd\Core\Settings === false) {
            throw new LoggerException(
                'Settings should be a \Signifyd\Core\Settings instance'
            );
        }

        $this->settings = $settings;
        $this->logger = new Logger('Signifyd PHP Library');
        $this->initLogs();
    }

    /**
     * Initialize the logs on class construct or on general changes
     *
     * @return void
     *
     * @throws LoggerException
     */
    public function initLogs()
    {
        try {
            $fileHandler = new StreamHandler(
                $this->settings->getLogLocation() . '/' . $this->settings->getLogFileName()
            );
            $this->logger->pushHandler($fileHandler);
            if (true === $this->settings->isConsoleOut()) {
                $outputHandler = new StreamHandler('php://output');
                $this->logger->pushHandler($outputHandler);
            }
        } catch (\Exception $exception) {
            throw new LoggerException('Logger stream can not be created');
        }

    }

    /**
     * Getting the name of the log file
     *
     * @return string
     */
    public function getLogFileName()
    {
        return $this->logFileName;
    }

    /**
     * Setting the name of the log file
     *
     * @param string $logFileName The log file name
     *
     * @return void
     * @throws LoggerException
     */
    public function setLogFileName($logFileName)
    {
        $this->logFileName = $logFileName;
        $this->initLogs();
    }

    /**
     * Log message with the log level of debug
     *
     * @param string $msg The message
     *
     * @return void
     */
    public function debug($msg)
    {
        if (false === $this->settings->isLogEnabled()) {
            return;
        }

        $this->logger->debug($msg);
    }

    /**
     * Log message with the log level of info
     *
     * @param string $msg The message
     *
     * @return void
     */
    public function info($msg)
    {
        if (false === $this->settings->isLogEnabled()) {
            return;
        }

        $this->logger->info($msg);
    }

    /**
     * Log message with the log level of notice
     *
     * @param string $msg The message
     *
     * @return void
     */
    public function notice($msg)
    {
        if (false === $this->settings->isLogEnabled()) {
            return;
        }

        $this->logger->notice($msg);
    }

    /**
     * Log message with the log level of notice
     *
     * @param string $msg The message
     *
     * @return void
     */
    public function warning($msg)
    {
        if (false === $this->settings->isLogEnabled()) {
            return;
        }

        $this->logger->warning($msg);
    }

    /**
     * Log message with the log level of notice
     *
     * @param string $msg The message
     *
     * @return void
     */
    public function error($msg)
    {
        if (false === $this->settings->isLogEnabled()) {
            return;
        }

        $this->logger->error($msg);
    }

    /**
     * Get the location of the log file
     *
     * @return string
     */
    public function getLogLocation()
    {
        return $this->logLocation;
    }

    /**
     * Set where the log file should be stored
     *
     * @param string $logLocation The location of the log file
     *
     * @return void
     *
     * @throws LoggerException
     */
    public function setLogLocation($logLocation)
    {
        $this->logLocation = $logLocation;
        $this->initLogs();
    }

}