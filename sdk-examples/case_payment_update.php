<?php
require __DIR__ . '/../vendor/autoload.php';

// Please change the api key with the one from the Signifyd dashboard
$apiKey = 'YOUR API KEY';
$caseId = 'Change with a real case Id';

try {
    // console out means that all the logs will be displayed instantly in the terminal
    $caseApi = new \Signifyd\Core\Api\CaseApi(['apiKey' => $apiKey, 'consoleOut' => true]);

    $paymentUpdate = new Signifyd\Models\PaymentUpdate();
    $paymentUpdate->setCaseId($caseId);
    $paymentUpdate->setAvsResponseCode('Y');
    $paymentUpdate->setCvvResponseCode('M');
    $paymentUpdate->setPaymentGateway('authorize_net');
    $paymentUpdate->setTransactionId(86868495618541658);
    /**
     * @var \Signifyd\Core\Response\CaseResponse $response
     */
    $response = $caseApi->updatePayment($paymentUpdate);
    echo "=========== create case ========" . PHP_EOL;
    var_dump($response);
    echo "=========== end create case ========". PHP_EOL;
} catch (Exception $e) {
    var_dump($e->__toString());
}