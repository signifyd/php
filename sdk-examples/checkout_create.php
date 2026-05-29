<?php
/**
 * Example: Create a Checkout Event — Pre-Auth flow (V3)
 *
 * Submit an order to Signifyd for review BEFORE payment authorization.
 * After receiving the decision, send the payment to your processor,
 * then complete the flow with checkout_create_transaction.php.
 *
 * Endpoint: POST https://api.signifyd.com/v3/orders/events/checkouts
 *
 * Replaces: case_create.php (V2) — Pre-Auth variant
 */

require __DIR__ . '/../vendor/autoload.php';

$checkoutApi = new \Signifyd\Core\Api\CheckoutApi(["apiKey" => "YOUR_API_KEY"]);

$checkoutData = new \Signifyd\Models\CaseModel([
    'orderId'    => 'ORDER-10045',
    'checkoutId' => 'CHECKOUT-10045',
    'purchase'   => [
        'browserIpAddress' => '192.168.1.1',
        'orderedAt'        => '2024-09-15T14:23:00Z',
        'orderChannel'     => 'WEB',
        'totalPrice'       => 129.99,
        'currency'         => 'USD',
        'products'         => [
            [
                'itemId'       => 'SKU-001',
                'itemName'     => 'Wireless Headphones',
                'itemUrl'      => 'https://store.example.com/products/headphones',
                'itemImage'    => 'https://store.example.com/images/headphones.jpg',
                'itemQuantity' => 1,
                'itemPrice'    => 129.99,
                'itemCategory' => 'Electronics',
            ],
        ],
        'shipments' => [
            [
                'shipper'        => 'UPS',
                'shippingMethod' => 'GROUND',
                'shippingPrice'  => 0.00,
                'destination'    => [
                    'fullName'      => 'Jane Smith',
                    'streetAddress' => '123 Main St',
                    'unit'          => 'Apt 4B',
                    'city'          => 'New York',
                    'provinceCode'  => 'NY',
                    'postalCode'    => '10001',
                    'countryCode'   => 'US',
                ],
            ],
        ],
    ],
    'userAccount' => [
        'email'       => 'jane.smith@example.com',
        'username'    => 'janesmith',
        'phone'       => '5555551212',
        'createdDate' => '2022-03-10T00:00:00Z',
    ],
    'checkoutPaymentDetails' => [
        [
            'paymentMethod'  => 'CREDIT_CARD',
            'cardBin'        => '411111',
            'cardLast4'      => '1111',
            'billingAddress' => [
                'streetAddress' => '123 Main St',
                'unit'          => 'Apt 4B',
                'city'          => 'New York',
                'provinceCode'  => 'NY',
                'postalCode'    => '10001',
                'countryCode'   => 'US',
            ],
        ],
    ],
]);

$checkoutResponse = $checkoutApi->createOrder('orders/events/checkouts', $checkoutData);

if ($checkoutResponse->isError()) {
    echo 'Error: ' . $checkoutResponse->getErrorMessage();
} else {
    $decision = $checkoutResponse->getDecision();
    $action   = $decision->getCheckpointAction();

    echo 'Decision: ' . $action;

    if ($action === 'ACCEPT') {
        // Safe to send payment to processor
        // Then call checkout_create_transaction.php
    } elseif ($action === 'REJECT') {
        // Ask buyer to try a different payment method
    } else {
        // HOLD — route to manual review queue
    }
}