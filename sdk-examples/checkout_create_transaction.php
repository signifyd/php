<?php
/**
 * Example: Create a Transaction Event — Pre-Auth flow, step 2 (V3)
 *
 * Record the final payment outcome after your processor has
 * authorized (or declined) the payment. This closes the Pre-Auth loop.
 * Must be called after checkout_create.php.
 *
 * Endpoint: POST https://api.signifyd.com/v3/orders/events/transactions
 */

require __DIR__ . '/../vendor/autoload.php';

$checkoutApi = new \Signifyd\Core\Api\CheckoutApi(["apiKey" => "YOUR_API_KEY"]);

$transactionData = [
    'orderId'      => 'ORDER-10045',
    'checkoutId'   => 'CHECKOUT-10045',
    'transactions' => [
        [
            'transactionId'        => 'TXN-78912',
            'currency'             => 'USD',
            'amount'               => 129.99,
            'paymentMethod'        => 'CREDIT_CARD',
            'gateway'              => 'stripe',
            'gatewayStatusCode'    => '200',
            'gatewayStatusMessage' => 'approved',
            'type'                 => 'AUTHORIZATION',
            'avsResponseCode'      => 'Y',
            'cvvResponseCode'      => 'M',
            'checkoutPaymentDetails' => [
                'cardBin'   => '411111',
                'cardLast4' => '1111',
            ],
        ],
    ],
];

$transactionResponse = $checkoutApi->createTransaction($transactionData);

if ($transactionResponse->isError()) {
    echo 'Error: ' . $transactionResponse->getErrorMessage();
} else {
    echo 'Transaction recorded successfully';
}