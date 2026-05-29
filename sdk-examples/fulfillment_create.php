<?php
/**
 * Example: Create a Fulfillment (V3)
 *
 * Notifies Signifyd of order fulfillment status.
 * Uses ApiModel::addFulfillment() inherited by SaleApi.
 *
 * Endpoint: POST https://api.signifyd.com/v3/orders/events/fulfillments
 *
 * Replaces: case_add_fulfillment.php (V2)
 */

require __DIR__ . '/../vendor/autoload.php';

$saleApi = new \Signifyd\Core\Api\SaleApi(["apiKey" => "YOUR_API_KEY"]);

$fulfillmentData = [
    'orderId'      => 'ORDER-10046',
    'fulfillments' => [
        [
            'fulfillmentStatus' => 'COMPLETE',
            'shipments'         => [
                [
                    'shipper'        => 'UPS',
                    'trackingNumber' => '1Z999AA10123456784',
                    'shippingMethod' => 'GROUND',
                    'destination'    => [
                        'fullName'      => 'John Doe',
                        'streetAddress' => '456 Oak Ave',
                        'city'          => 'Austin',
                        'provinceCode'  => 'TX',
                        'postalCode'    => '73301',
                        'countryCode'   => 'US',
                    ],
                    'products' => [
                        [
                            'itemId'       => 'SKU-202',
                            'itemName'     => 'Running Shoes',
                            'itemQuantity' => 1,
                            'itemPrice'    => 74.50,
                        ],
                    ],
                ],
            ],
        ],
    ],
];

$fulfillmentResponse = $saleApi->addFulfillment($fulfillmentData);

if ($fulfillmentResponse->isError()) {
    echo 'Error: ' . $fulfillmentResponse->getErrorMessage();
} else {
    echo 'Fulfillment recorded successfully';
}