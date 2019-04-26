<?php
require __DIR__ . '/../vendor/autoload.php';

// Please change the api key with the one from the Signifyd dashboard
$apiKey = 'YOUR API KEY';

try {
    // console out means that all the logs will be displayed instantly in the terminal
    $webhooksApi = new \Signifyd\Core\Api\WebhooksApi(['apiKey' => $apiKey, 'consoleOut' => true]);
    /**
     * @var \Signifyd\Core\Response\WebhooksBulkResponse $bulkResponse
     */
    $bulkResponse = $webhooksApi->getWebhooks();
    if ($bulkResponse->isError() === true) {
        var_dump($bulkResponse->getErrorMessage());
        return;
    }

    echo "=========== get webhooks ========" . PHP_EOL;
    foreach ($bulkResponse->getObjects() as $webhook) {
        var_dump($webhook);
    }
    echo "=========== end get webhooks ========". PHP_EOL;
} catch (Exception $e) {
    var_dump($e->__toString());
}