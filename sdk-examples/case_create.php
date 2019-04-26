<?php
require __DIR__ . '/../vendor/autoload.php';

// Please change the api key with the one from the Signifyd dashboard
$apiKey = 'YOUR API KEY';

$caseData = [
    "purchase" => [
        "orderSessionId" => "uha3d98weicm20eufhl2341qe",
        "browserIpAddress" => "192.168.1.200",
        "orderId" => "19420",
        "createdAt" => date(DATE_ATOM),
        "paymentGateway" => "stripe",
        "paymentMethod" => "credit_card",
        "transactionId" => "1a2sf3f44e21r1",
        "currency" => "USD",
        "avsResponseCode" => "Y",
        "cvvResponseCode" => "M",
        "orderChannel" => "PHONE",
        "receivedBy" => "John Doeeee",
        "totalPrice" => 109.98,
        "customerOrderRecommendation" => "APPROVE",
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
            ],
            [
                "itemId" => "2",
                "itemName" => "Summer tank top",
                "itemIsDigital" => false,
                "itemCategory" => "apparel",
                "itemSubCategory" => "shirts",
                "itemUrl" => "http://mydomain.com/summer-tank",
                "itemImage" => "http://mydomain.com/images/summer-tank.jpeg",
                "itemQuantity" => 1,
                "itemPrice" => 49.99,
                "itemWeight" => 2
            ]
        ],
        "discountCodes" => [
            [
                "amount" => 10,
                "code" => "TENDOLLARSOFF"
            ],
            [
                "percentage" => 20,
                "code" => "20PERCENTOFF"
            ]
        ],
        "shipments" => [
            [
                "shipper" => "UPS",
                "shippingMethod" => "ground",
                "shippingPrice" => 10
            ],
            [
                "shipper" => "USPS",
                "shippingMethod" => "international",
                "shippingPrice" => 20
            ]
        ]
    ],
    "recipient" => [
        "fullName" => "Bob Smith",
        "confirmationEmail" => "bob@gmail.com",
        "confirmationPhone" => "5047130000",
        "organization" => "SIGNIFYD",
        "deliveryAddress" => [
            "streetAddress" => "123 State Street",
            "unit" => "2A",
            "city" => "Chicago",
            "provinceCode" => "IL",
            "postalCode" => "60622",
            "countryCode" => "US"
        ]
    ],
    "card" => [
        "cardHolderName" => "Robert Smith",
        "bin" => 407441,
        "last4" => "1234",
        "expiryMonth" => 12,
        "expiryYear" => 2015,
        "billingAddress" => [
            "streetAddress" => null,
            "unit" => "2A",
            "city" => "Chicago",
            "provinceCode" => "IL",
            "postalCode" => "60622",
            "countryCode" => "US"
        ]
    ],
    "userAccount" => [
        "email" => "bob@gmail.com",
        "username" => "bobbo",
        "phone" => "5555551212",
        "createdDate" => date(DATE_ATOM),
        "accountNumber" => "54321",
        "lastOrderId" => "4321",
        "aggregateOrderCount" => 40,
        "aggregateOrderDollars" => 5000,
        "lastUpdateDate" => date(DATE_ATOM)
    ],
    "seller" => [
        "name" => "We sell awesome stuff, Inc.",
        "email" => "wesellawesomestuff@gmail.com",
        "username" => "awesomestuff1234",
        "phone" => "8883334545",
        "domain" => "wesellawesomestuff.com",
        "createdDate" => date(DATE_ATOM),
        "accountNumber" => "54321",
        "aggregateOrderCount" => 4000,
        "aggregateOrderDollars" => 3000000,
        "lastUpdateDate" => date(DATE_ATOM),
        "onboardingIpAddress" => "192.122.1.1",
        "onboardingEmail" => "wesellawesomestuff@gmail.com",
        "tags" => [
            "Enterprise Account",
            "Gold Plan"
        ],
        "shipFromAddress" => [
            "streetAddress" => "1850 Mercer Rd",
            "unit" => null,
            "city" => "Lexington",
            "provinceCode" => "KY",
            "postalCode" => "40511",
            "countryCode" => "US"
        ],
        "corporateAddress" => [
            "streetAddress" => "410 Terry Ave",
            "unit" => "3L",
            "city" => "Seattle",
            "provinceCode" => "WA",
            "postalCode" => "98109",
            "countryCode" => "US"
        ]
    ]
];

try {
    // console out means that all the logs will be displayed instantly in the terminal
//    $caseApi = new \Signifyd\Core\Api\CaseApi(['apiKey' => $apiKey, 'consoleOut' => true]);
    $caseApi = new \Signifyd\Core\Api\CaseApi(['apiKey' => $apiKey]);
    $case = new \Signifyd\Models\CaseModel($caseData);

    /**
     * @var \Signifyd\Core\Response\CaseResponse $response
     */
    $response = $caseApi->createCase($case);
    if ($response->isError() === true) {
        var_dump($response->getErrorMessage());
        return;
    }

    $caseId = $response->getCaseId();
    echo "=========== create case ========" . PHP_EOL;
    var_dump($response);
    echo "==========================" . PHP_EOL;
    var_dump($caseId);
//    echo $caseId . PHP_EOL;
    echo "=========== end create case ========". PHP_EOL;
} catch (Exception $e) {
    var_dump($e->__toString());
}