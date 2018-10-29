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
    protected $logFileName = 'signifyd_connect.log';
    protected $logLocation = '.';
    protected $consoleOut = false;
    protected $logger;
    protected $enable = true;

    /**
     * Logging constructor.
     *
     * @param bool $consoleOut Enable command line output
     *
     * @throws LoggerException
     */
    public function __construct($consoleOut = false)
    {
        $this->consoleOut = (bool)$consoleOut;
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
            $fileHandler = new StreamHandler($this->logLocation . '/' . $this->logFileName);
            $this->logger->pushHandler($fileHandler);
            if (true === $this->isConsoleOut()) {
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
     * Is the output in the command line enabled
     *
     * @return bool
     */
    public function isConsoleOut()
    {
        return $this->consoleOut;
    }

    /**
     * Set the output to the command line
     *
     * @param bool $consoleOut The console output bool
     *
     * @return void
     *
     * @throws LoggerException
     */
    public function setConsoleOut($consoleOut)
    {
        $this->consoleOut = $consoleOut;
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
        if (false === $this->isEnable()) {
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
        if (false === $this->isEnable()) {
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
        if (false === $this->isEnable()) {
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
        if (false === $this->isEnable()) {
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
        if (false === $this->isEnable()) {
            return;
        }

        $this->logger->error($msg);
    }

    /**
     * Is the logging enabled
     *
     * @return bool
     */
    public function isEnable()
    {
        return $this->enable;
    }

    /**
     * Set if the logging should be enabled or not
     *
     * @param bool $enable The enable log bool
     *
     * @return void
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;
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