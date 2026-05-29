<?php
/**
 * Example: Delete a Webhook (V3)
 *
 * Deletes an existing webhook registration for a team by teamId and hookId.
 *
 * Endpoint: DELETE https://api.signifyd.com/v3/teams/{teamId}/webhooks/{hookId}
 *
 * Replaces: webhooks_delete.php (V2)
 */

require __DIR__ . '/../vendor/autoload.php';

$apiKey = 'YOUR API KEY';
$teamId = 'YOUR_TEAM_ID';
$hookId = 'YOUR_HOOK_ID';

try {
    // consoleOut means that all the logs will be displayed instantly in the terminal
    $webhooksApi = new \Signifyd\Core\Api\WebhooksApi(['apiKey' => $apiKey, 'consoleOut' => true]);

    /**
     * @var \Signifyd\Core\Response\WebhooksResponse $response
     */
    $response = $webhooksApi->deleteWebhook($teamId, $hookId);

    if ($response->isError() === true) {
        var_dump($response->getErrorMessage());
        return;
    }

    echo "=========== delete webhook ========" . PHP_EOL;
    var_dump($response);
    echo "=========== end delete webhook ========" . PHP_EOL;
} catch (Exception $e) {
    var_dump($e->__toString());
}