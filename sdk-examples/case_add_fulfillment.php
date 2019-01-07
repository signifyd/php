<?php
require __DIR__ . '/../vendor/autoload.php';

// Please change the api key with the one from the Signifyd dashboard
$apiKey = 'YOUR API KEY';

$fulfillmentData = [
    "id" => "1002",
    "orderId" => "100420",
    "createdAt" => date(DATE_ATOM),
    "recipientName" => "Bob Smith",
    "deliveryEmail" => "bob@gmail.com",
    "fulfillmentStatus" => "partial",
    "shipmentStatus" => "delivered",
    "shippingCarrier" => "UPS",
    "trackingNumbers" => [
        "1Z827wk74630"
    ],
    "trackingUrls" => [
        "http://wwwapps.ups.com/etracking/tracking.cgi?1Z827wk74630"
    ],
    "products" => [
        [
            "itemId" => "1",
            "itemName" => "Sparkly sandals",
            "itemIsDigital" => false,
            "itemCategory" => "apparel",
            "itemSubCategory" => "footwear",
            "itemUrl" => "http://mydomain.com/sparkly-sandals",
            "itemImage" => "http://mydomain.com/images/sparkly-sandals.jpeg",
            "itemQuantity" => 1,
            "itemPrice" => 59.99,
            "itemWeight" => 5
        ]
    ],
    "deliveryAddress" => [
        "streetAddress" => "123 State Street",
        "unit" => "2A",
        "city" => "Chicago",
        "provinceCode" => "IL",
        "postalCode" => "60622",
        "countryCode" => "US"
    ],
    "confirmationName" => "ACME Ware House",
    "confirmationPhone" => 1231232
];

try {
    // console out means that all the logs will be displayed instantly in the terminal
//    $caseApi = new \Signifyd\Core\Api\CaseApi(['apiKey' => $apiKey, 'consoleOut' => true]);
    $caseApi = new \Signifyd\Core\Api\CaseApi(['apiKey' => $apiKey]);
    $fulfillment = new \Signifyd\Models\Fulfillment($fulfillmentData);

    /**
     * @var \Signifyd\Core\Response\FulfillmentBulkResponse $bulkResponse
     */
    $bulkResponse = $caseApi->addFulfillment($fulfillment);
    if ($bulkResponse->isError() === true) {
        var_dump($bulkResponse->getErrorMessage());
        return;
    }

    $fulfillments = $bulkResponse->getObjects();
    echo "=========== add fulfillment ========" . PHP_EOL;
    foreach ($fulfillments as $fulfillment) {
        var_dump($fulfillment);
    }
    echo "=========== end add fulfillment ========". PHP_EOL;
} catch (Exception $e) {
    var_dump($e->__toString());
}