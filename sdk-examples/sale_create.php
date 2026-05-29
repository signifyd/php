<?php
/**
 * Example: Create a Sale Event — Post-Auth flow (V3)
 *
 * Submit an order to Signifyd for review AFTER payment has already
 * been authorized by your payment processor.
 * Combines order and transaction data in a single call.
 *
 * Endpoint: POST https://api.signifyd.com/v3/orders/events/sales
 *
 * Replaces: case_create.php (V2) — Post-Auth variant
 */

require __DIR__ . '/../vendor/autoload.php';

$saleApi = new \Signifyd\Core\Api\SaleApi(["apiKey" => "YOUR_API_KEY"]);

$saleData = new \Signifyd\Models\CaseModel([
    'orderId'  => 'ORDER-10046',
    'purchase' => [
        'browserIpAddress' => '10.0.0.42',
        'orderedAt'        => '2024-09-15T16:00:00Z',
        'orderChannel'     => 'WEB',
        'totalPrice'       => 74.99,
        'currency'         => 'USD',
        'products'         => [
            [
                'itemId'       => 'SKU-202',
                'itemName'     => 'Running Shoes',
                'itemUrl'      => 'https://store.example.com/products/shoes',
                'itemImage'    => 'https://store.example.com/images/shoes.jpeg',
                'itemQuantity' => 1,
                'itemPrice'    => 74.99,
                'itemCategory' => 'Footwear',
            ],
        ],
        'shipments' => [
            [
                'shipper'        => 'FedEx',
                'shippingMethod' => 'EXPRESS',
                'shippingPrice'  => 9.99,
                'destination'    => [
                    'fullName'      => 'John Doe',
                    'streetAddress' => '456 Oak Ave',
                    'city'          => 'Austin',
                    'provinceCode'  => 'TX',
                    'postalCode'    => '73301',
                    'countryCode'   => 'US',
                ],
            ],
        ],
    ],
    'userAccount' => [
        'email'       => 'john.doe@example.com',
        'username'    => 'johndoe',
        'phone'       => '5555559876',
        'createdDate' => '2021-06-01T00:00:00Z',
    ],
    'transactions' => [
        [
            'transactionId'        => 'TXN-99234',
            'currency'             => 'USD',
            'amount'               => 74.99,
            'paymentMethod'        => 'CREDIT_CARD',
            'gateway'              => 'braintree',
            'gatewayStatusCode'    => '1000',
            'gatewayStatusMessage' => 'Approved',
            'type'                 => 'AUTHORIZATION',
            'avsResponseCode'      => 'Y',
            'cvvResponseCode'      => 'M',
            'checkoutPaymentDetails' => [
                'cardBin'        => '555555',
                'cardLast4'      => '4444',
                'billingAddress' => [
                    'streetAddress' => '456 Oak Ave',
                    'city'          => 'Austin',
                    'provinceCode'  => 'TX',
                    'postalCode'    => '73301',
                    'countryCode'   => 'US',
                ],
            ],
        ],
    ],
]);

$saleResponse = $saleApi->createOrder('orders/events/sales', $saleData);

if ($saleResponse->isError()) {
    echo 'Error: ' . $saleResponse->getErrorMessage();
} else {
    $decision = $saleResponse->getDecision();
    $action   = $decision->getCheckpointAction();

    echo 'Decision: ' . $action;

    if ($action === 'ACCEPT') {
        // Capture payment and ship the order
    } elseif ($action === 'REJECT') {
        // Void payment and cancel the order
    } else {
        // HOLD — route to manual review queue
    }
}