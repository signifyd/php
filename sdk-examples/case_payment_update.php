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
    $paymentUpdate->setAvsResponseCode('M');
    $paymentUpdate->setCvvResponseCode('M');
    $paymentUpdate->setPaymentGateway('stripe');
    $paymentUpdate->setTransactionId('1a2sf3f44e21r1');
    /**
     * @var \Signifyd\Core\Response\CaseResponse $response
     */
    $response = $caseApi->updatePayment($paymentUpdate);
    if ($response->isError() === true) {
        var_dump($response->getErrorMessage());
        return;
    }

    echo "=========== payment update ========" . PHP_EOL;
    var_dump($response);
    echo "=========== end payment update ========". PHP_EOL;
} catch (Exception $e) {
    var_dump($e->__toString());
}