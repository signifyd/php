<?php

include __DIR__ . '/../../lib/Models/Payment/Braintree.php';

//use Signifyd\Models\Payment\Braintree;

$braintree = new Braintree();
$credentials = [];
$transactionId = "123";

echo "<pre>";
var_dump($braintree->fetchData('test'));
echo "</pre>";