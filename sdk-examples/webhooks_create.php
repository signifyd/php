<?php
/**
 * Example: Create a Webhook (V3)
 *
 * Registers a webhook endpoint in Signifyd for a team.
 * In V3, webhooks are registered one at a time (not in bulk).
 * The only supported event type is ORDER_CHECKPOINT_ACTION_UPDATE.
 *
 * Endpoint: POST https://api.signifyd.com/v3/teams/{teamId}/webhooks
 *
 * Replaces: webhooks_create.php (V2)
 */

require __DIR__ . '/../vendor/autoload.php';

$apiKey = 'YOUR API KEY';
$teamId = 'YOUR_TEAM_ID';

try {
    // consoleOut means that all the logs will be displayed instantly in the terminal
    $webhooksApi = new \Signifyd\Core\Api\WebhooksApi(['apiKey' => $apiKey, 'consoleOut' => true]);

    $webHook = new \Signifyd\Models\Webhook([
        'event' => 'ORDER_CHECKPOINT_ACTION_UPDATE',
        'url'   => 'https://example.org/signifyd/webhook',
    ]);

    /**
     * @var \Signifyd\Core\Response\WebhooksBulkResponse $response
     */
    $response = $webhooksApi->createWebhooks($teamId, $webHook);

    if ($response->isError() === true) {
        var_dump($response->getErrorMessage());
        return;
    }

    echo "=========== create webhook ========" . PHP_EOL;
    var_dump($response);
    echo "=========== end create webhook ========" . PHP_EOL;
} catch (Exception $e) {
    var_dump($e->__toString());
}