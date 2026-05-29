<?php
/**
 * Example: Update a Webhook (V3)
 *
 * Updates an existing webhook registration for a team.
 * In V3, webhooks are updated one at a time (not in bulk).
 *
 * Endpoint: POST https://api.signifyd.com/v3/teams/{teamId}/webhooks/{hookId}
 *
 * Replaces: webhooks_update_single.php (V2) and webhooks_update.php (V2 bulk)
 */

require __DIR__ . '/../vendor/autoload.php';

$apiKey = 'YOUR API KEY';
$teamId = 'YOUR_TEAM_ID';
$hookId = 'YOUR_HOOK_ID';

try {
    // consoleOut means that all the logs will be displayed instantly in the terminal
    $webhooksApi = new \Signifyd\Core\Api\WebhooksApi(['apiKey' => $apiKey, 'consoleOut' => true]);

    $webHook = new \Signifyd\Models\Webhook([
        'event' => 'ORDER_CHECKPOINT_ACTION_UPDATE',
        'url'   => 'https://example.org/signifyd/webhook',
    ]);

    /**
     * @var \Signifyd\Core\Response\WebhooksResponse $response
     */
    $response = $webhooksApi->updateWebhook($webHook, $teamId, $hookId);

    if ($response->isError() === true) {
        var_dump($response->getErrorMessage());
        return;
    }

    echo "=========== update webhook ========" . PHP_EOL;
    var_dump($response);
    echo "=========== end update webhook ========" . PHP_EOL;
} catch (Exception $e) {
    var_dump($e->__toString());
}