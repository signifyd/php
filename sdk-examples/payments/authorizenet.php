<?php

use Signifyd\Models\Payment\Authorizenet;

require __DIR__ . '/../../../../../vendor/autoload.php';

$params = [
    'environment' => 'sandbox',
    'name' => '3Wkzy244gSRM',
    'transactionKey' => '9pZT32Um4Y3xGp8a'
];
$transactionId = '60146613284';
$authorizenet= new Authorizenet($params);

echo "<pre>";
var_dump($authorizenet->fetchData($transactionId));
echo "</pre>";
