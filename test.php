<?php

require './vendor/autoload.php';

$settings = new \Signifyd\Core\SignifydSettings();
$settings->apiKey = 'O0w3hMR7gdGEEbYEinq1ggXbY';
$settings->apiAddress = 'http://not-aasdfasdfasd-real-domain.com';
$client = new \Signifyd\Core\SignifydAPI($settings);

$client->getCase(44);

var_dump($client->getLastErrorMessage());
