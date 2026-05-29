<?php
/**
 * Example: Get Order Decision (V3)
 *
 * Retrieve the current fraud decision for an order by orderId.
 * Use this to poll for decisions instead of — or in addition to — webhooks.
 * Uses ApiModel::getCase() inherited by SaleApi.
 *
 * Endpoint: GET https://api.signifyd.com/v3/orders/{orderId}/decision
 *
 * Replaces: case_get.php (V2)
 */

require __DIR__ . '/../vendor/autoload.php';

$saleApi = new \Signifyd\Core\Api\SaleApi(["apiKey" => "YOUR_API_KEY"]);

$orderId = 'ORDER-10046';
$decisionResponse = $saleApi->getCase($orderId);

if ($decisionResponse->isError()) {
    echo 'Error: ' . $decisionResponse->getErrorMessage();
} else {
    echo 'Checkpoint Action: ' . $decisionResponse->getCheckpointAction();
    echo 'Score: '             . $decisionResponse->getScore();
    echo 'Reason: '            . $decisionResponse->getCheckpointActionReason();
}