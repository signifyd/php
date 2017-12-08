<?php

/**
 * Copyright © 2015 SIGNIFYD Inc. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Signifyd\Core;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class SignifydSettings
 * Stores all of the options required for the API itself. Specific integrations may have their own settings
 */
class SignifydSettings
{
    /**
     * @var string API key used for authorization with Signifyd service
     * You can find the key value at http://signifyd.com/settings/teams
     */
    public $apiKey;

    /**
     * @var string The base address for all API calls. Only needs modified in special circumstances
     */
    public $apiAddress = "https://api.signifyd.com/v2/";

    /**
     * @var bool Whether or not to validate inputs before executing API calls. For diagnostic purposes
     */
    public $validateData = false;

    /**
     * @var bool Whether to log errors. Recommended
     */
    public $logErrors = true;

    /**
     * @var bool Whether to log warnings. Recommended
     */
    public $logWarnings = true;

    /**
     * @var bool Whether to log trace statements. Only for diagnostic purposes.
     */
    public $logInfo = false;

    /**
     * @var callable Function which will be used for logging errors.
     * Takes one argument, the message body
     */
    public $loggerError = 'error';

    /**
     * @var callable Function which will be used for logging warnings.
     * Takes one argument, the message body
     */
    public $loggerWarning = 'warning';

    /**
     * @var callable Function which will be used for logging info.
     * Takes one argument, the message body
     */
    public $loggerInfo = 'info';

    /**
     * @var int CURL timeout value.In seconds
     */
    public $timeout = 30;

    public $logFileName = 'signifyd_connect.log';

    public $logFileLocation = __DIR__;

}
