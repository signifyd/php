<?php

namespace core;
/**
 * Class SignifydSettings
 */
class SignifydSettings
{

    /**
     * @var string API key used for authorization with Signifyd service
     * You can find the key value at http://signifyd.com/settings/teams
     */
    public $apiKey;

    /**
     * @var
     */
    public $validateData;

    /**
     * @var
     */
    public $logErrors;
    /**
     * @var
     */
    public $logWarnings;
    /**
     * @var
     */
    public $logInfo;

    /**
     * @var
     */
    public $loggerError;
    /**
     * @var
     */
    public $loggerWarning;
    /**
     * @var
     */
    public $loggerInfo;
}