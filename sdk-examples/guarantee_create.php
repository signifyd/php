<?php
require __DIR__ . '/../vendor/autoload.php';

// Please change the api key with the one from the Signifyd dashboard
$apiKey = 'YOUR API KEY';
// a case id
$caseId = 'Change with a real case Id';

try {
    // console out means that all the logs will be displayed instantly in the terminal
    $guaranteeApi = new \Signifyd\Core\Api\GuaranteeApi(['apiKey' => $apiKey, 'consoleOut' => true]);
    $guarantee = new \Signifyd\Models\Guarantee(['caseId' => $caseId]);

    $guaranteeResponse = $guaranteeApi->createGuarantee($guarantee);
    if ($guaranteeResponse->isError() === true) {
        var_dump($guaranteeResponse->getErrorMessage());
        return;
    }

    echo "=========== create guarantee ========" . PHP_EOL;
    var_dump($guaranteeResponse);
    echo "=========== end create guarantee ========" . PHP_EOL;
} catch (Exception $e) {
    var_dump($e->__toString());
}
