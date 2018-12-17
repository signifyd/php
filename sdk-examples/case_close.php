<?php
require __DIR__ . '/../vendor/autoload.php';

// Please change the api key with the one from the Signifyd dashboard
$apiKey = 'YOUR API KEY';
$caseId = 'Change with a real case Id';

try {
    // console out means that all the logs will be displayed instantly in the terminal
    $caseApi = new \Signifyd\Core\Api\CaseApi(['apiKey' => $apiKey, 'consoleOut' => true]);
    /**
     * @var \Signifyd\Core\Response\CaseResponse $response
     */
    $response = $caseApi->closeCase($caseId);
    echo "=========== create case ========" . PHP_EOL;
    var_dump($response);
    echo "=========== end create case ========". PHP_EOL;
} catch (Exception $e) {
    var_dump($e->__toString());
}