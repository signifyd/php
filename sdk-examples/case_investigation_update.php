<?php
require __DIR__ . '/../vendor/autoload.php';

// Please change the api key with the one from the Signifyd dashboard
$apiKey = 'YOUR API KEY';
$caseId = 'Change with a real case Id';

try {
    // console out means that all the logs will be displayed instantly in the terminal
    $caseApi = new \Signifyd\Core\Api\CaseApi(['apiKey' => $apiKey, 'consoleOut' => true]);
    $investigationLabel = 'Bye Bye';
    /**
     * @var \Signifyd\Core\Response\CaseResponse $response
     */
    $response = $caseApi->updateInvestigationLabel($caseId, $investigationLabel);
    if ($response->isError() === true) {
        var_dump($response->getErrorMessage());
        return;
    }

    echo "=========== update investigation label ========" . PHP_EOL;
    var_dump($response);
    echo "=========== end update investigation label ========". PHP_EOL;
} catch (Exception $e) {
    var_dump($e->__toString());
}