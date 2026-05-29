<?php
/**
 * Example: Reroute — Change Delivery Address (V3)
 *
 * Call this endpoint anytime the delivery address on an order needs
 * to be changed after the original checkout or sale event.
 * Uses ApiModel::reroute() inherited by SaleApi.
 *
 * Endpoint: POST https://api.signifyd.com/v3/orders/events/reroutes
 *
 * Replaces: part of case_payment_update.php (V2) — delivery address change only.
 * For payment/transaction data updates use checkout_create_transaction.php instead.
 */

require __DIR__ . '/../vendor/autoload.php';

$saleApi = new \Signifyd\Core\Api\SaleApi(['apiKey' => 'YOUR_API_KEY', 'consoleOut' => true]);

$rerouteData = [
    'orderId'   => 'ORDER-10046',
    'shipments' => [
        [
            'shipper'        => 'UPS',
            'shippingMethod' => 'GROUND',
            'shippingPrice'  => 0.00,
            'destination'    => [
                'fullName'      => 'John Doe',
                'streetAddress' => '789 New Street',
                'unit'          => '2B',
                'city'          => 'Chicago',
                'provinceCode'  => 'IL',
                'postalCode'    => '60601',
                'countryCode'   => 'US',
            ],
        ],
    ],
];

try {
    $response = $saleApi->reroute($rerouteData);

    if ($response->isError() === true) {
        var_dump($response->getErrorMessage());
        return;
    }

    echo "=========== reroute ========" . PHP_EOL;
    var_dump($response);
    echo "=========== end reroute ========" . PHP_EOL;
} catch (Exception $e) {
    var_dump($e->__toString());
}