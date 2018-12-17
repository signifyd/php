<?php
require __DIR__ . '/../vendor/autoload.php';

// Please change the api key with the one from the Signifyd dashboard
$apiKey = 'YOUR API KEY';

try {
    // console out means that all the logs will be displayed instantly in the terminal
    $webhooksApi = new \Signifyd\Core\Api\WebhooksApi(['apiKey' => $apiKey, 'consoleOut' => true]);
    /**
     * @var \Signifyd\Core\Response\WebhooksResponse $response
     */
    $response = $webhooksApi->getWebhooks();
    echo "=========== get webhooks ========" . PHP_EOL;
    foreach ($response->getResponseArray() as $webhook) {
        var_dump($webhook);
    }
    echo "=========== end get webhooks ========". PHP_EOL;
} catch (Exception $e) {
    var_dump($e->__toString());
}