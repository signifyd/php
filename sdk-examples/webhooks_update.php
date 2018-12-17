<?php
require __DIR__ . '/../vendor/autoload.php';

// Please change the api key with the one from the Signifyd dashboard
$apiKey = 'YOUR API KEY';

try {
    // console out means that all the logs will be displayed instantly in the terminal
    $webhooksApi = new \Signifyd\Core\Api\WebhooksApi(['apiKey' => $apiKey, 'consoleOut' => true]);
    $webHook1 = new \Signifyd\Models\Webhook([
        'event' => 'CASE_CREATION',
        'url' => 'https://example.org/signifyd1'
    ]);
    $webHook2 = new \Signifyd\Models\Webhook([
        'event' => 'CASE_RESCORE',
        'url' => 'https://example.org/signifyd1'
    ]);
    $webhooks = [$webHook1, $webHook2];
    /**
     * @var \Signifyd\Core\Response\CaseResponse $response
     */
    $response = $webhooksApi->updateWebhooks($webhooks);
    echo "=========== update webhooks ========" . PHP_EOL;
    var_dump($response);
    echo "=========== end update webhooks ========". PHP_EOL;
} catch (Exception $e) {
    var_dump($e->__toString());
}