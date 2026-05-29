Signifyd PHP SDK
=================

This repository contains the PHP SDK client for the **Signifyd V3 API**.

Overview
--------
This document will give an overview on the available methods in the Signifyd PHP library. Also examples for this methods will be provided.

Support
--------
For questions or issues please contact our [support team](http://signifyd.com/contact). You can submit feedback and suggestions for improvement [here](https://github.com/signifyd/php/issues).

Examples
--------
If you are looking for a sample code that was tested and works, check out the [`sdk-examples`](https://github.com/signifyd/php/tree/main/sdk-examples) repository.

Requirements
------------
* `PHP >= 7.4.0`
* In order to use the API you need to provide your API key. You can find your API key on your [account page](https://app.signifyd.com/settings).

Installing the SDK
------------------
##### With composer

The Signifyd PHP SDK is available on Packagist. To add it to your project, simply run command below to get the latest version:

```
$ php composer.phar require signifyd/signifyd-php
```

If you want you can specify a version by adding it to the command:

```
$ php composer.phar require signifyd/signifyd-php:DESIRED_VERSION_HERE
```

Or add the this line under the `"require"` key in your `composer.json`:
```
{
    "require" : {
        ...
        "signifyd/signifyd-php": "DESIRED_VERSION_HERE"
    }
}
```
Change DESIRED_VERSION_HERE by the version description which most fits to your business. To learn more about version numbers check Composer documentation.

https://getcomposer.org/doc/articles/versions.md#writing-version-constraints

After adding the line you must install the Signifyd PHP SDK dependency by running:
```
$ php composer.phar install
```

Getting Started
---------------
The V3 API is organized into groups. Each group has dedicated API classes.

#### COMMERCE
***CHECKOUT API*** Which works with checkout events which are orders submitted to Signifyd for review before payment authorization. A checkout event contains purchase, payment, shipment, and account information.

***TRANSACTION API*** Which works with transaction events which record the final payment outcome after your processor has authorized or declined the payment. Used as the follow-up step in the Pre-Auth flow.

***SALE API*** Which works with sale events which are orders submitted to Signifyd for review after payment authorization. A sale event combines order, transaction, and account information in a single call.

***FULFILLMENT API*** Which works with fulfillment events which notify Signifyd of order fulfillment status updates. Sending fulfillment data helps improve fraud detection accuracy and supports chargeback dispute evidence.

***PURCHASE MANAGEMENT API*** Which works with post-submission order management events — rerouting shipments to a new destination and retrieving fraud decisions for previously submitted orders. This group does not have a dedicated SDK class yet — see the API Classes section for direct usage examples.

***RETURNS & APPEASEMENTS API*** Which works with return, refund, and exchange events — submitting return requests for fraud evaluation, recording return outcomes, and providing feedback on return quality. This group does not have a dedicated SDK class yet — see the API Classes section for direct usage examples.

***CHARGEBACKS API*** Which works with chargeback events — reporting new chargebacks against orders and updating chargeback stage information throughout the dispute lifecycle. This group does not have a dedicated SDK class yet — see the API Classes section for direct usage examples.

#### WEBHOOKS
***WEBHOOKS API*** Which works with webhooks which are messages sent by SIGNIFYD via HTTP POST to a url you configure. Webhook messages are sent when a checkpoint action decision is made on a submitted order. They allow your application to receive pushed updates about an order's decision, rather than poll SIGNIFYD for status changes.

#### ACCOUNTS
The Accounts group covers consumer account lifecycle events submitted to Signifyd for fraud analysis. This group does not have a dedicated SDK class yet — see the API Classes section for direct usage examples.

***ACCOUNT MODIFICATION API*** Which works with account modification events — detecting risky changes to account information such as email, password, phone, or address that may indicate account takeover in progress.

***ACCOUNT LOGIN API*** Which works with login events — detecting and preventing account takeover (ATO) attempts by analysing each login in real time, enabling high-risk logins to be blocked while maintaining a seamless experience for trusted users.

***ACCOUNT OPENING API*** Which works with account opening events — detecting and preventing false account creation by cross-referencing against the Signifyd network when a new account is being created.

#### PARTNERS
The Partners group provides management of organizations, teams, members, and users for Signifyd partners. This group does not have a dedicated SDK class yet — see the API Classes section for direct usage examples.

***ORGANIZATIONS API*** Which works with organization management — retrieving organization details and managing organization-level members that have access to all teams belonging to that organization.

***USERS API*** Which works with user creation and lookup for a given partner.

***TEAMS API*** Which works with team management — creating, updating, and managing teams and their members, products, and lifecycle status.

***PARTNERS (MEMBERS) API*** Which works with partner-level member management — adding, updating, and removing members that have access to all teams belonging to the partner.

API Classes
-----------

#### COMMERCE

### CheckoutApi

The CheckoutApi is the class that maps the Pre-Auth checkout event functionality of the Signifyd API. This class has the methods that work with Checkout events — orders submitted to Signifyd for review before payment authorization.

There are multiple ways to instantiate the CheckoutApi class.
Usage examples:
```php
<?php
    // This might differ depending on the location of the file from which you your project
    require __DIR__ . '/vendor/autoload.php'; 
    
    $checkoutApi = new \Signifyd\Core\Api\CheckoutApi(["apiKey" => "your api key"]);
``` 
Or using the Settings Class
```php
<?php
    // This might differ depending on the location of the file from which you your project
    require __DIR__ . '/vendor/autoload.php'; 
    
    $settings = new \Signifyd\Core\Settings(["apiKey" => "your api key"]);
    $checkoutApi = new \Signifyd\Core\Api\CheckoutApi($settings);
``` 

#### Class methods
All methods accept two type of data as parameters.

The parameter as an array, which means that the constructor of the model will set the values of the class properties
based on the data passed to the constructor.

The parameter as an object, which means that after the instanciate of the class you can use the setters to add data to
the model.


##### createCheckout($checkout);
Submit an order for fraud review before payment authorization.
There are multiple ways for the data to be sent to the createCheckout method. One way is to send an array with all the data
required to the createCheckout method. This is useful if you know what data needs to be sent.

For more info about the data that can be added please check the `Checkout` model.
```php
    ....
    // Checkout data
    $checkoutData = [
        "orderId"    => "ORDER-10045",
        "checkoutId" => "CHECKOUT-10045",
        "purchase" => [
            // Data related to the purchase event represented in this Checkout Creation request.
        ],
        "checkoutPaymentDetails" => [
            // Data related to the payment method and billing address used at checkout.
        ],
        "userAccount" => [
            // User account data if the buyer has an account.
        ],
    ];
    $checkoutResponse = $checkoutApi->createCheckout($checkoutData);
    ....
``` 
Another way is to use the setters and getters of the models so you can add data.
```php
    ....
    $checkout = new \Signifyd\Models\Checkout();
    // Purchase array data or Purchase Object
    $checkout->setPurchase($purchase);
    
    // CheckoutPaymentDetails array data or CheckoutPaymentDetails Object
    $checkout->setCheckoutPaymentDetails($checkoutPaymentDetails);
    
    // userAccount array data or userAccount Object
    $checkout->setUserAccount($userAccount);
    
    $checkoutResponse = $checkoutApi->createCheckout($checkout);
```
An example of a JSON object sent to our API:
```json
{
    "orderId": "ORDER-10045",
    "checkoutId": "CHECKOUT-10045",
    "purchase": {
        "browserIpAddress": "192.168.1.1",
        "orderedAt": "2024-09-15T14:23:00Z",
        "orderChannel": "WEB",
        "totalPrice": 129.99,
        "currency": "USD",
        "products": [
            {
                "itemId": "SKU-001",
                "itemName": "Wireless Headphones",
                "itemUrl": "https://store.example.com/products/headphones",
                "itemImage": "https://store.example.com/images/headphones.jpg",
                "itemQuantity": 1,
                "itemPrice": 129.99,
                "itemCategory": "Electronics"
            }
        ],
        "shipments": [
            {
                "shipper": "UPS",
                "shippingMethod": "GROUND",
                "shippingPrice": 0.00,
                "destination": {
                    "fullName": "Jane Smith",
                    "streetAddress": "123 Main St",
                    "unit": "Apt 4B",
                    "city": "New York",
                    "provinceCode": "NY",
                    "postalCode": "10001",
                    "countryCode": "US"
                }
            }
        ]
    },
    "checkoutPaymentDetails": [
        {
            "billingAddress": {
                "streetAddress": "123 Main St",
                "unit": "Apt 4B",
                "city": "New York",
                "provinceCode": "NY",
                "postalCode": "10001",
                "countryCode": "US"
            },
            "paymentMethod": "CREDIT_CARD",
            "cardBin": "411111",
            "cardLast4": "1111"
        }
    ],
    "userAccount": {
        "email": "jane.smith@example.com",
        "username": "janesmith",
        "phone": "5555551212",
        "createdDate": "2022-03-10T00:00:00Z",
        "accountNumber": "ACC-9876",
        "lastOrderId": "ORDER-10040"
    }
}
```
This method with return a `CheckoutResponse` which will have the `checkpointAction` property populated.
In case of error the `CheckoutResponse` will have the property `isError` set to `true` and the property `errorMessage` will have the received error message.
Error message can be empty if the request can not be made, but in this case the signifyd_connect.log will have the error logged.

##### getDecision($orderId);
Retrieve the current fraud decision for an order by orderId.
```php
    ....
    $orderId = 'ORDER-10045';
    $decisionResponse = $checkoutApi->getDecision($orderId);
    ....
```
This sends the request to our API Endpoint to get a decision. As a parameter for this method you need to send an orderId.

This method with return a `DecisionResponse` which will have all the properties populated.
In case of error the `DecisionResponse` will have the property `isError` set to `true` and the property `errorMessage` will have the received error message.
Error message can be empty if the request can not be made, but in this case the signifyd_connect.log will have the error logged.

### TransactionApi

The TransactionApi is the class that maps the Transaction event functionality of the Signifyd API. After receiving a Checkout decision and sending payment to your processor, call this API to record the final payment result. This closes the Pre-Auth loop.

There are multiple ways to instantiate the TransactionApi class.
Usage examples:
```php
<?php
    // This might differ depending on the location of the file from which you your project
    require __DIR__ . '/vendor/autoload.php'; 
    
    $transactionApi = new \Signifyd\Core\Api\TransactionApi(["apiKey" => "your api key"]);
``` 
Or using the Settings Class
```php
<?php
    // This might differ depending on the location of the file from which you your project
    require __DIR__ . '/vendor/autoload.php'; 
    
    $settings = new \Signifyd\Core\Settings(["apiKey" => "your api key"]);
    $transactionApi = new \Signifyd\Core\Api\TransactionApi($settings);
``` 

#### Class methods
All methods accept two type of data as parameters.

The parameter as an array, which means that the constructor of the model will set the values of the class properties
based on the data passed to the constructor.

The parameter as an object, which means that after the instanciate of the class you can use the setters to add data to
the model.

##### createTransaction($transaction);
Record the final payment outcome after your processor has authorized or declined the payment.

For more info about the data that can be added please check the `Transaction` model.
```php
    ....
    $transactionData = [
        "orderId"    => "ORDER-10045",
        "checkoutId" => "CHECKOUT-10045",
        "transactions" => [
            [
                "transactionId"        => "TXN-78912",
                "currency"             => "USD",
                "amount"               => 129.99,
                "paymentMethod"        => "CREDIT_CARD",
                "gateway"              => "stripe",
                "gatewayStatusCode"    => "200",
                "gatewayStatusMessage" => "approved",
                "type"                 => "AUTHORIZATION",
                "avsResponseCode"      => "Y",
                "cvvResponseCode"      => "M",
                "checkoutPaymentDetails" => [
                    "cardBin"   => "411111",
                    "cardLast4" => "1111"
                ]
            ]
        ]
    ];
    $transactionResponse = $transactionApi->createTransaction($transactionData);
    ....
```
This method with return a `TransactionResponse` which will have the properties populated.
In case of error the `TransactionResponse` will have the property `isError` set to `true` and the property `errorMessage` will have the received error message.
Error message can be empty if the request can not be made, but in this case the signifyd_connect.log will have the error logged.

### SaleApi

The SaleApi is the class that maps the Post-Auth sale event functionality of the Signifyd API. This class has the methods that work with Sale events — orders submitted to Signifyd for review after payment has been authorized by your payment processor.

There are multiple ways to instantiate the SaleApi class.
Usage examples:
```php
<?php
    // This might differ depending on the location of the file from which you your project
    require __DIR__ . '/vendor/autoload.php'; 
    
    $saleApi = new \Signifyd\Core\Api\SaleApi(["apiKey" => "your api key"]);
``` 
Or using the Settings Class
```php
<?php
    // This might differ depending on the location of the file from which you your project
    require __DIR__ . '/vendor/autoload.php'; 
    
    $settings = new \Signifyd\Core\Settings(["apiKey" => "your api key"]);
    $saleApi = new \Signifyd\Core\Api\SaleApi($settings);
``` 

#### Class methods
All methods accept two type of data as parameters.

The parameter as an array, which means that the constructor of the model will set the values of the class properties
based on the data passed to the constructor.

The parameter as an object, which means that after the instanciate of the class you can use the setters to add data to
the model.

##### createSale($sale);
Submit an order for fraud review after payment authorization.
There are multiple ways for the data to be sent to the createSale method. One way is to send an array with all the data
required to the createSale method. This is useful if you know what data needs to be sent.

For more info about the data that can be added please check the `Sale` model.
```php
    ....
    // Sale data
    $saleData = [
        "orderId" => "ORDER-10046",
        "purchase" => [
            // Data related to the purchase event represented in this Sale Creation request.
        ],
        "transactions" => [
            // Data related to the payment transaction(s) for this order.
        ],
        "userAccount" => [
            // User account data if the buyer has an account.
        ],
    ];
    $saleResponse = $saleApi->createSale($saleData);
    ....
``` 
Another way is to use the setters and getters of the models so you can add data.
```php
    ....
    $sale = new \Signifyd\Models\Sale();
    // Purchase array data or Purchase Object
    $sale->setPurchase($purchase);
    
    // Transaction array data or Transaction Object
    $sale->setTransactions($transactions);
    
    // userAccount array data or userAccount Object
    $sale->setUserAccount($userAccount);
    
    $saleResponse = $saleApi->createSale($sale);
```
An example of a JSON object sent to our API:
```json
{
    "orderId": "ORDER-10046",
    "purchase": {
        "browserIpAddress": "10.0.0.42",
        "orderedAt": "2024-09-15T16:00:00Z",
        "orderChannel": "WEB",
        "totalPrice": 74.99,
        "currency": "USD",
        "products": [
            {
                "itemId": "SKU-202",
                "itemName": "Running Shoes",
                "itemUrl": "https://store.example.com/products/shoes",
                "itemImage": "https://store.example.com/images/shoes.jpeg",
                "itemQuantity": 1,
                "itemPrice": 74.99
            }
        ],
        "shipments": [
            {
                "shipper": "FedEx",
                "shippingMethod": "EXPRESS",
                "shippingPrice": 9.99,
                "destination": {
                    "fullName": "John Doe",
                    "streetAddress": "456 Oak Ave",
                    "city": "Austin",
                    "provinceCode": "TX",
                    "postalCode": "73301",
                    "countryCode": "US"
                }
            }
        ]
    },
    "transactions": [
        {
            "transactionId": "TXN-99234",
            "currency": "USD",
            "amount": 74.99,
            "paymentMethod": "CREDIT_CARD",
            "gateway": "braintree",
            "gatewayStatusCode": "1000",
            "gatewayStatusMessage": "Approved",
            "type": "AUTHORIZATION",
            "avsResponseCode": "Y",
            "cvvResponseCode": "M",
            "checkoutPaymentDetails": {
                "cardBin": "555555",
                "cardLast4": "4444",
                "billingAddress": {
                    "streetAddress": "456 Oak Ave",
                    "city": "Austin",
                    "provinceCode": "TX",
                    "postalCode": "73301",
                    "countryCode": "US"
                }
            }
        }
    ],
    "userAccount": {
        "email": "john.doe@example.com",
        "username": "johndoe",
        "phone": "5555559876",
        "createdDate": "2021-06-01T00:00:00Z",
        "accountNumber": "54321",
        "lastOrderId": "ORDER-10040"
    }
}
```
This method with return a `SaleResponse` which will have the `checkpointAction` property populated.
In case of error the `SaleResponse` will have the property `isError` set to `true` and the property `errorMessage` will have the received error message.
Error message can be empty if the request can not be made, but in this case the signifyd_connect.log will have the error logged.

### FulfillmentApi

The FulfillmentApi is the class that notifies Signifyd of order fulfillment status updates. Sending fulfillment data helps Signifyd improve fraud detection accuracy and supports chargeback dispute evidence.

There are multiple ways to instantiate the FulfillmentApi class.
Usage examples:
```php
<?php
    // This might differ depending on the location of the file from which you your project
    require __DIR__ . '/vendor/autoload.php'; 
    
    $fulfillmentApi = new \Signifyd\Core\Api\FulfillmentApi(["apiKey" => "your api key"]);
``` 
Or using the Settings Class
```php
<?php
    // This might differ depending on the location of the file from which you your project
    require __DIR__ . '/vendor/autoload.php'; 
    
    $settings = new \Signifyd\Core\Settings(["apiKey" => "your api key"]);
    $fulfillmentApi = new \Signifyd\Core\Api\FulfillmentApi($settings);
``` 

#### Class methods
All methods accept two type of data as parameters.

The parameter as an array, which means that the constructor of the model will set the values of the class properties
based on the data passed to the constructor.

The parameter as an object, which means that after the instanciate of the class you can use the setters to add data to
the model.

##### createFulfillment($fulfillment);
This sends the request to our API Endpoint to add fulfillment status for an order. One way is to send an array with all the data required to the createFulfillment method.

For more info about the data that can be added please check the `Fulfillment` model.
```php
    ....
    $fulfillmentData = [
        "orderId" => "ORDER-10046",
        "fulfillments" => [
            // Fulfillment data
        ]
    ];
    $fulfillmentResponse = $fulfillmentApi->createFulfillment($fulfillmentData);
    ....
```
This method with return a `FulfillmentResponse` which will have the properties populated.
In case of error the `FulfillmentResponse` will have the property `isError` set to `true` and the property `errorMessage` will have the received error message.
Error message can be empty if the request can not be made, but in this case the signifyd_connect.log will have the error logged.

#### PURCHASE MANAGEMENT

> **Note:** The Purchase Management group does not have a dedicated SDK class yet. The examples below use [GuzzleHttp](https://docs.guzzlephp.org/) to call the API directly. A dedicated `PurchaseManagementApi` class will be added in a future version of the SDK.

### Reroute

The Reroute API allows you to update the shipment destination for a previously submitted order.

##### POST /v3/orders/events/reroutes
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'https://api.signifyd.com/v3/orders/events/reroutes', [
        'headers' => [
            'accept'        => 'application/json',
            'content-type'  => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
        'json' => [
            'orderId'   => 'ORDER-10045',
            'shipments' => [
                [
                    'destination' => [
                        'fullName'      => 'Jane Smith',
                        'streetAddress' => '456 New Ave',
                        'city'          => 'Austin',
                        'provinceCode'  => 'TX',
                        'postalCode'    => '73301',
                        'countryCode'   => 'US',
                    ],
                ],
            ],
        ],
    ]);
    echo $response->getBody();
    ....
```
This endpoint returns `201` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, and `500` on server error.

### Get Decision

Retrieves the latest fraud decision for a previously submitted order.

##### GET /v3/orders/{orderId}/decision
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', 'https://api.signifyd.com/v3/orders/ORDER-10045/decision', [
        'headers' => [
            'accept'        => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
    ]);
    echo $response->getBody();
    ....
```
This endpoint returns `200` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, and `500` on server error.

### Get Decisions

Retrieves the full list of decisions associated with an order.

##### GET /v3/orders/{orderId}/decisions
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', 'https://api.signifyd.com/v3/orders/ORDER-10045/decisions', [
        'headers' => [
            'accept'        => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
    ]);
    echo $response->getBody();
    ....
```
This endpoint returns `200` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, and `500` on server error.

#### RETURNS & APPEASEMENTS

> **Note:** The Returns & Appeasements group does not have a dedicated SDK class yet. The examples below use [GuzzleHttp](https://docs.guzzlephp.org/) to call the API directly. A dedicated `ReturnsApi` class will be added in a future version of the SDK.

### Attempt Return

Submit a return, refund, or exchange request to Signifyd for fraud evaluation. Use this endpoint when you need a decision from Signifyd before processing the return.

##### POST /v3/orders/events/returns/attempts
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'https://api.signifyd.com/v3/orders/events/returns/attempts', [
        'headers' => [
            'accept'        => 'application/json',
            'content-type'  => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
        'json' => [
            'orderId'      => 'ORDER-10045',
            'returnId'     => 'RETURN-001',
            'returnDate'   => '2024-09-20T10:00:00Z',
            'returnPolicy' => 'EVALUATE',
            'returnedItems' => [
                [
                    'itemId'       => 'SKU-001',
                    'itemName'     => 'Wireless Headphones',
                    'itemQuantity' => 1,
                    'itemPrice'    => 129.99,
                ],
            ],
            'refund' => [
                'amount'   => 129.99,
                'currency' => 'USD',
            ],
        ],
    ]);
    echo $response->getBody();
    ....
```
Available values for `returnPolicy`: `EVALUATE`, `INFO_ONLY`.

This endpoint returns `201` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, and `500` on server error.

### Execute Return

Inform Signifyd of the final action taken on a return request previously submitted via the Attempt Return endpoint.

##### POST /v3/orders/events/returns/executions
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'https://api.signifyd.com/v3/orders/events/returns/executions', [
        'headers' => [
            'accept'        => 'application/json',
            'content-type'  => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
        'json' => [
            'orderId'      => 'ORDER-10045',
            'returnId'     => 'RETURN-001',
            'returnStatus' => 'REFUNDED',
            'executedAt'   => '2024-09-21T14:00:00Z',
        ],
    ]);
    echo $response->getBody();
    ....
```
Available values for `returnStatus`: `OPEN`, `CANCELED`, `REFUNDED`, `REPLACED`, `IN_ANALYSIS`, `DECLINED`, `RETURN_PENDING`, `PARTIAL_SETTLEMENT`.

This endpoint returns `200` if already executed (no update), `201` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, and `500` on server error.

### Record Return

Record a return, exchange, or refund that does not require a decision from Signifyd (i.e. already processed on your side).

##### POST /v3/orders/events/returns/records
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'https://api.signifyd.com/v3/orders/events/returns/records', [
        'headers' => [
            'accept'        => 'application/json',
            'content-type'  => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
        'json' => [
            'orderId'      => 'ORDER-10045',
            'returnId'     => 'RETURN-002',
            'returnStatus' => 'REFUNDED',
            'returnDate'   => '2024-09-21T14:00:00Z',
            'returnedItems' => [
                [
                    'itemId'       => 'SKU-202',
                    'itemQuantity' => 1,
                    'itemPrice'    => 74.99,
                ],
            ],
            'refund' => [
                'amount'            => 74.99,
                'currency'          => 'USD',
                'refundTransactionId' => 'TXN-REFUND-001',
            ],
        ],
    ]);
    echo $response->getBody();
    ....
```
Available values for `returnStatus`: `CANCELED`, `REFUNDED`, `REPLACED`, `DECLINED`.

This endpoint returns `201` on success, `204` if no response expected, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, `409` on conflict, and `500` on server error.

### Return Feedback

Provide Signifyd with quality feedback on a return decision — whether the return turned out to be legitimate, abusive, or fraudulent.

##### POST /v3/orders/events/returns/feedback
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'https://api.signifyd.com/v3/orders/events/returns/feedback', [
        'headers' => [
            'accept'        => 'application/json',
            'content-type'  => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
        'json' => [
            'orderId'       => 'ORDER-10045',
            'returnId'      => 'RETURN-001',
            'returnOutcome' => 'GOOD',
            'feedbackAt'    => '2024-09-25T10:00:00Z',
        ],
    ]);
    echo $response->getBody();
    ....
```
Available values for `returnOutcome`: `GOOD`, `ABUSIVE`, `FRAUD`, `NO_ITEM_RETURNED`.

This endpoint returns `200` if feedback already exists (no update), `201` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, and `500` on server error.

#### CHARGEBACKS

> **Note:** The Chargebacks group does not have a dedicated SDK class yet. The examples below use [GuzzleHttp](https://docs.guzzlephp.org/) to call the API directly. A dedicated `ChargebackApi` class will be added in a future version of the SDK.

### Create Chargeback

Report a new chargeback against an order to Signifyd. Multiple chargebacks can be created against the same order depending on team settings.

##### POST /v3/orders/events/chargebacks
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'https://api.signifyd.com/v3/orders/events/chargebacks', [
        'headers' => [
            'accept'        => 'application/json',
            'content-type'  => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
        'json' => [
            'orderId'      => 'ORDER-10045',
            'chargebackId' => 'CB-78901',
            'chargeback'   => [
                'amount'   => 74.99,
                'currency' => 'USD',
                'reason'   => 'FRAUD',
            ],
        ],
    ]);
    echo $response->getBody();
    ....
```
This endpoint returns `201` on success, `204` if no response expected, `400` on validation failure, `401` on authentication failure, `404` if order not found, `409` if chargeback already exists, and `500` on server error.

### Chargeback Stage

Update the stage of an existing chargeback as it progresses through the dispute lifecycle.

##### POST /v3/orders/events/chargebacks/stages
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'https://api.signifyd.com/v3/orders/events/chargebacks/stages', [
        'headers' => [
            'accept'        => 'application/json',
            'content-type'  => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
        'json' => [
            'orderId'         => 'ORDER-10045',
            'chargebackId'    => 'CB-78901',
            'chargebackStage' => 'CHARGEBACK',
            'dueDate'         => '2024-10-15T00:00:00Z',
        ],
    ]);
    echo $response->getBody();
    ....
```
Available values for `chargebackStage`: `RETRIEVAL`, `CHARGEBACK`, `PREARBITRATION`, `ARBITRATION`, `RECALLED`.

This endpoint returns `201` on success, `400` on validation failure, `401` on authentication failure, `404` if chargeback not found, `409` if stage transition conflicts, and `500` on server error.

#### WEBHOOKS

### WebhookApi
The WebhookApi is the class that maps the main webhooks functionality of the Signifyd API. This class has the methods
that work with webhooks.

There are multiple ways to instantiate the WebhookApi class.
Usage examples:
```php
<?php
    // This might differ depending on the location of the file from which you your project
    require __DIR__ . '/vendor/autoload.php'; 
    
    $webhookApi = new \Signifyd\Core\Api\WebhookApi(["apiKey" => "your api key"]);
``` 
Or using the Settings Class
```php
<?php
    // This might differ depending on the location of the file from which you your project
    require __DIR__ . '/vendor/autoload.php'; 
    
    $settings = new \Signifyd\Core\Settings(["apiKey" => "your api key"]);
    $webhookApi = new \Signifyd\Core\Api\WebhookApi($settings);
``` 

#### Class methods
All methods accept two type of data as parameters.

The parameter as an array, which means that the constructor of the model will set the values of the class properties
based on the data passed to the constructor.

The parameter as an object, which means that after the instanciate of the class you can use the setters to add data to
the model.

##### createWebhook($webhook);
Create a webhook in Signifyd.

For more info about the data that can be added please check the `Webhook` model.
```php
    ....
    $webhook = new \Signifyd\Models\Webhook([
        "url"     => "https://your-store.com/signifyd/webhook",
        "event"   => "ORDER_CHECKPOINT_ACTION_UPDATE",
        "enabled" => true
    ]);
    $webhookResponse = $webhookApi->createWebhook($webhook);
    ....
```
This method with return a `WebhookResponse` which will have the properties populated.
In case of error the `WebhookResponse` will have the property `isError` set to `true` and the property `errorMessage` will have the received error message.
Error message can be empty if the request can not be made, but in this case the signifyd_connect.log will have the error logged.

##### updateWebhook($webhook);
Update a webhook in Signifyd.

For more info about the data that can be added please check the `Webhook` model.
```php
    ....
    $webhook = new \Signifyd\Models\Webhook([
        // Webhook data
    ]);
    $webhookResponse = $webhookApi->updateWebhook($webhook);
    ....
```
This method with return a `WebhookResponse` which will have the properties populated.
In case of error the `WebhookResponse` will have the property `isError` set to `true` and the property `errorMessage` will have the received error message.
Error message can be empty if the request can not be made, but in this case the signifyd_connect.log will have the error logged.

##### getWebhooks();
Retrieve a list of webhooks set in Signifyd.
```php
    ....
    $webhookResponse = $webhookApi->getWebhooks();
    ....
```
This method with return a `WebhookResponse` which will have the properties populated.
In case of error the `WebhookResponse` will have the property `isError` set to `true` and the property `errorMessage` will have the received error message.
Error message can be empty if the request can not be made, but in this case the signifyd_connect.log will have the error logged.

##### deleteWebhook($webhook);
Delete a webhook from Signifyd.

For more info about the data that can be added please check the `Webhook` model.
```php
    ....
    $webhook = new \Signifyd\Models\Webhook([
        // Webhook data
    ]);
    $webhookResponse = $webhookApi->deleteWebhook($webhook);
    ....
```
This method with return a `WebhookResponse` which will have the properties populated.
In case of error the `WebhookResponse` will have the property `isError` set to `true` and the property `errorMessage` will have the received error message.
Error message can be empty if the request can not be made, but in this case the signifyd_connect.log will have the error logged.

#### ACCOUNTS

> **Note:** The Accounts group does not have a dedicated SDK class yet. The examples below use [GuzzleHttp](https://docs.guzzlephp.org/) to call the API directly. Note that these endpoints currently use Signifyd's v2 API paths, as v3 equivalents are not yet available. A dedicated `AccountApi` class will be added in a future version of the SDK.

### Account Modification

The Account Modification API is designed to detect risky changes to user account information, such as changing their email, password, address, or contact details. By sending this event, Signifyd analyses the modification and determines the effectiveness of the change and if it should be blocked.

##### POST /v2/consumers/events/modifications
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'https://api.signifyd.com/v2/consumers/events/modifications', [
        'headers' => [
            'accept'       => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
        'json' => [
            'modifiedField'    => 'FIELD_EMAIL',
            'modifiedAt'       => '2024-09-15T14:23:00Z',
            'newEmail'         => 'new.email@example.com',
            'loginMethodType'  => 'PASSWORD',
            'userFingerprint'  => 'abc123fingerprint',
            'emailIdentifier'  => 'john.doe@example.com',
            'device'           => [
                'browserIpAddress' => '192.168.1.1',
            ],
        ],
    ]);
    echo $response->getBody();
    ....
```
An example of a JSON object sent to our API:
```json
{
    "modifiedField": "FIELD_EMAIL",
    "modifiedAt": "2024-09-15T14:23:00Z",
    "newEmail": "new.email@example.com",
    "loginMethodType": "PASSWORD",
    "userFingerprint": "abc123fingerprint",
    "emailIdentifier": "john.doe@example.com",
    "device": {
        "browserIpAddress": "192.168.1.1"
    }
}
```
Available values for `modifiedField`: `FIELD_EMAIL`, `FIELD_PASSWORD`, `FIELD_PHONE`, `FIELD_ADDRESS`, `FIELD_NAME`.

This endpoint returns `200` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if the entity is not found, and `500` on server error.

### Account Login

The Account Login API is designed to detect and prevent account takeover (ATO) attempts. It enables actionable, real-time actions on login events enabling businesses to block high-risk logins while maintaining a seamless experience for trusted users.

##### POST /v2/consumers/events/logins
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'https://api.signifyd.com/v2/consumers/events/logins', [
        'headers' => [
            'accept'       => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
        'json' => [
            'loginMethodType'  => 'PASSWORD',
            'loginResult'      => 'SUCCESS',
            'loginAt'          => '2024-09-15T14:23:00Z',
            'loginAccountId'   => 'ACC-9876',
            'isNewDevice'      => false,
            'emailIdentifier'  => 'john.doe@example.com',
            'device'           => [
                'browserIpAddress' => '192.168.1.1',
            ],
        ],
    ]);
    echo $response->getBody();
    ....
```
An example of a JSON object sent to our API:
```json
{
    "loginMethodType": "PASSWORD",
    "loginResult": "SUCCESS",
    "loginAt": "2024-09-15T14:23:00Z",
    "loginAccountId": "ACC-9876",
    "isNewDevice": false,
    "emailIdentifier": "john.doe@example.com",
    "device": {
        "browserIpAddress": "192.168.1.1"
    }
}
```
Available values for `loginMethodType`: `PASSWORD`, `SOCIAL_FACEBOOK`, `SOCIAL_GOOGLE`, `SOCIAL_TWITTER`, `SOCIAL_APPLE`, `KEY_TOKEN`.

This endpoint returns `200` on success, `201` when a new login record is created, `400` on validation failure, `401` on authentication failure, `403` on permission denied, and `500` on server error.

### Account Opening

The Account Opening API is designed to detect and prevent false account creation. It automatically identifies if the account that is being created is associated with the Signifyd network — if it is, Signifyd can add additional context. By incorporating this check into your account open flow, you can identify and ensure ATO behaviour and protect against like-for-like fraud.

##### POST /v2/consumers/events/openings
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'https://api.signifyd.com/v2/consumers/events/openings', [
        'headers' => [
            'accept'       => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
        'json' => [
            'openingId'       => 'OPENING-10001',
            'fullName'        => 'John Doe',
            'accountNumber'   => 'ACC-9876',
            'email'           => 'john.doe@example.com',
            'verifiedEmail'   => true,
            'phone'           => '5555551212',
            'verifiedPhone'   => false,
            'createdAt'       => '2024-09-15T14:23:00Z',
            'signupMethod'    => 'PASSWORD',
            'accountType'     => 'SILVER',
            'emailIdentifier' => 'john.doe@example.com',
            'device'          => [
                'browserIpAddress' => '192.168.1.1',
            ],
        ],
    ]);
    echo $response->getBody();
    ....
```
An example of a JSON object sent to our API:
```json
{
    "openingId": "OPENING-10001",
    "fullName": "John Doe",
    "accountNumber": "ACC-9876",
    "email": "john.doe@example.com",
    "verifiedEmail": true,
    "phone": "5555551212",
    "verifiedPhone": false,
    "createdAt": "2024-09-15T14:23:00Z",
    "signupMethod": "PASSWORD",
    "accountType": "SILVER",
    "emailIdentifier": "john.doe@example.com",
    "device": {
        "browserIpAddress": "192.168.1.1"
    }
}
```
This endpoint returns `200` if the Account Opening event has been successfully created, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if the entity is not found, and `500` on server error.

#### PARTNERS

> **Note:** The Partners group does not have a dedicated SDK class yet. The examples below use [GuzzleHttp](https://docs.guzzlephp.org/) to call the API directly. A dedicated `PartnerApi` class will be added in a future version of the SDK.

The Partners API is used by Signifyd partners to manage their organizations, teams, members, and users. All endpoints require a `partnerId` path parameter, which is Signifyd's unique identifier for the partner. This can also accept the placeholder `0` which will automatically populate with your `partnerId` using your partner credentials via API.

### Organizations

#### Get Organization
Retrieve details for a specific organization within a partner account.

##### GET /v3/partners/{partnerId}/organizations/{orgId}
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', 'https://api.signifyd.com/v3/partners/0/organizations/12345', [
        'headers' => [
            'accept'        => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
    ]);
    echo $response->getBody();
    ....
```
This endpoint returns `200` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, and `500` on server error.

#### Add Organization Member
Adds a user as an `Organization` level member, granting access to all `Teams` belonging to that `Organization`.

##### POST /v3/partners/{partnerId}/organizations/{orgId}/members
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'https://api.signifyd.com/v3/partners/0/organizations/12345/members', [
        'headers' => [
            'accept'        => 'application/json',
            'content-type'  => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
        'json' => [
            'userId' => 123456,
            'role'   => 'MEMBER',
        ],
    ]);
    echo $response->getBody();
    ....
```
Available values for `role`: `REVIEWER`, `MEMBER`, `ADMIN`.

This endpoint returns `201` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, `408` if the user already has a membership at the `Organization` level, and `500` on server error.

### Users

#### Create User
Creates a user with a given email address or finds an already created user by the Partner. The user will initially not be a member of any Team or Organization.

##### POST /v3/partners/{partnerId}/users
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'https://api.signifyd.com/v3/partners/0/users', [
        'headers' => [
            'accept'       => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
        'json' => [
            'email' => 'user@mycompany.com',
        ],
    ]);
    echo $response->getBody();
    ....
```
This endpoint returns `200` if the user already exists and is owned by the Partner, `201` if the user is successfully created, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, and `500` on server error.

### Teams

A fundamental unit of the Signifyd API. A single `Team` typically equates to a single investment. Orders are submitted to Signifyd under that `Team` and users belonging to that `Team` can access those orders in the Signifyd Console.

#### Create Team
##### POST /v3/partners/{partnerId}/teams
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'https://api.signifyd.com/v3/partners/0/teams', [
        'headers' => [
            'accept'       => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
        'json' => [
            'orgId'               => 12345,
            'name'                => 'Initrode East Division',
            'website'             => 'https://initrode-east.com',
            'chargebackSettings'  => 'CHARGEBACKSETTINGS_DIRECT',
            'merchantDescription' => 'A retail store chain',
        ],
    ]);
    echo $response->getBody();
    ....
```
This endpoint returns `201` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, and `500` on server error.

#### Get Team
##### GET /v3/partners/{partnerId}/teams/{teamId}
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', 'https://api.signifyd.com/v3/partners/0/teams/789123', [
        'headers' => [
            'accept'        => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
    ]);
    echo $response->getBody();
    ....
```
This endpoint returns `200` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, and `500` on server error.

#### Update Team
##### POST /v3/partners/{partnerId}/teams/{teamId}
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'https://api.signifyd.com/v3/partners/0/teams/789123', [
        'headers' => [
            'accept'       => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
        'json' => [
            'name'                => 'Initrode East Division',
            'website'             => 'https://initrode-east.com',
            'merchantDescription' => 'A retail store chain',
        ],
    ]);
    echo $response->getBody();
    ....
```
This endpoint returns `200` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, and `500` on server error.

#### Set Team Live
Changes the team status from `BURN_IN` to `LIVE`. For teams created using the Partners API, Signifyd will have to approve internally before this endpoint can work.

##### POST /v3/partners/{partnerId}/teams/{teamId}/live
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'https://api.signifyd.com/v3/partners/0/teams/789123/live', [
        'headers' => [
            'accept'        => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
    ]);
    echo $response->getBody();
    ....
```
This endpoint returns `200` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, `408` if the request conflicts with data already on the system, and `500` on server error.

#### Add Team Product
Adds a product offering to the Team.

##### POST /v3/partners/{partnerId}/teams/{teamId}/products
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'https://api.signifyd.com/v3/partners/0/teams/789123/products', [
        'headers' => [
            'accept'       => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
        'json' => [
            'product' => 'GFP',
        ],
    ]);
    echo $response->getBody();
    ....
```
Available values for `product`: `GFP` (Guaranteed Fraud Protection), `CBR` (Chargeback Recovery), `RECS` (Recommendations), `SCOR` (Scoring).

This endpoint returns `200` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, `408` if the request conflicts with existing data, and `500` on server error.

#### Get Team Members
Gets a paginated list of details for all members at the `Team` level.

##### GET /v3/partners/{partnerId}/teams/{teamId}/members
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', 'https://api.signifyd.com/v3/partners/0/teams/789123/members', [
        'headers' => [
            'accept'        => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
        'query' => [
            'limit'  => 50,
            'offset' => 0,
        ],
    ]);
    echo $response->getBody();
    ....
```
This endpoint returns `200` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, and `500` on server error.

#### Add Team Member
Adds a user as a `Team` level member.

##### POST /v3/partners/{partnerId}/teams/{teamId}/members
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'https://api.signifyd.com/v3/partners/0/teams/789123/members', [
        'headers' => [
            'accept'       => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
        'json' => [
            'userId' => 123456,
            'role'   => 'REVIEWER',
        ],
    ]);
    echo $response->getBody();
    ....
```
Available values for `role`: `REVIEWER` (can view Orders, cannot perform User management), `MEMBER` (can view Orders and cancel guarantee Orders, cannot perform User management), `ADMIN` (full rights and privileges).

This endpoint returns `201` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, `408` if the user already has a membership at the `Team` level, and `500` on server error.

#### Update Team Member
Updates a member at a `Team` level. Any fields not specified will not be changed.

##### POST /v3/partners/{partnerId}/teams/{teamId}/members/{userId}
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'https://api.signifyd.com/v3/partners/0/teams/789123/members/123456', [
        'headers' => [
            'accept'       => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
        'json' => [
            'role' => 'ADMIN',
        ],
    ]);
    echo $response->getBody();
    ....
```
This endpoint returns `200` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, and `500` on server error.

#### Get Team Member
Gets the details of a `Team` member.

##### GET /v3/partners/{partnerId}/teams/{teamId}/members/{userId}
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', 'https://api.signifyd.com/v3/partners/0/teams/789123/members/123456', [
        'headers' => [
            'accept'        => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
    ]);
    echo $response->getBody();
    ....
```
This endpoint returns `200` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, and `500` on server error.

#### Remove Team Member
Removes `Team` membership from a user.

##### DELETE /v3/partners/{partnerId}/teams/{teamId}/members/{userId}
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('DELETE', 'https://api.signifyd.com/v3/partners/0/teams/789123/members/123456', [
        'headers' => [
            'accept'        => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
    ]);
    echo $response->getBody();
    ....
```
This endpoint returns `204` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, and `500` on server error.

### Partners (Members)

#### Get Partner Members
Gets a paginated list of details for all members at the `Partner` level.

##### GET /v3/partners/{partnerId}/members
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', 'https://api.signifyd.com/v3/partners/0/members', [
        'headers' => [
            'accept'        => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
        'query' => [
            'limit'  => 50,
            'offset' => 0,
        ],
    ]);
    echo $response->getBody();
    ....
```
This endpoint returns `200` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, and `500` on server error.

#### Add Partner Member
Adds a user as a `Partner` level member. Such members will have access to all `Teams` belonging to the `Partner`. Members at `Partner` level can only be removed at `Partner` level.

##### POST /v3/partners/{partnerId}/members
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'https://api.signifyd.com/v3/partners/0/members', [
        'headers' => [
            'accept'       => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
        'json' => [
            'userId' => 123456,
            'role'   => 'REVIEWER',
        ],
    ]);
    echo $response->getBody();
    ....
```
This endpoint returns `201` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, `408` if the user already has a membership at the `Partner` level, and `500` on server error.

#### Update Partner Member
Updates a member at a `Partner` level. Any fields not specified will not be changed.

##### POST /v3/partners/{partnerId}/members/{userId}
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'https://api.signifyd.com/v3/partners/0/members/123456', [
        'headers' => [
            'accept'       => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
        'json' => [
            'role' => 'ADMIN',
        ],
    ]);
    echo $response->getBody();
    ....
```
This endpoint returns `200` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, and `500` on server error.

#### Get Partner Member
Gets the details of a `Partner` member.

##### GET /v3/partners/{partnerId}/members/{userId}
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', 'https://api.signifyd.com/v3/partners/0/members/123456', [
        'headers' => [
            'accept'        => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
    ]);
    echo $response->getBody();
    ....
```
This endpoint returns `200` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, and `500` on server error.

#### Remove Partner Member
Removes `Partner` membership from a user. This will remove the ability for that user to access information regarding all `Organizations` and `Teams` that the user is not directly a member of.

##### DELETE /v3/partners/{partnerId}/members/{userId}
```php
    ....
    $client = new \GuzzleHttp\Client();
    $response = $client->request('DELETE', 'https://api.signifyd.com/v3/partners/0/members/123456', [
        'headers' => [
            'accept'        => 'application/json',
            'Authorization' => 'Basic ' . base64_encode('YOUR_API_KEY:'),
        ],
    ]);
    echo $response->getBody();
    ....
```
This endpoint returns `204` on success, `400` on validation failure, `401` on authentication failure, `403` on permission denied, `404` if not found, and `500` on server error.

SDK API Responses
-----------------
### CheckoutResponse
Checkout response is the response that is returned when the checkout api is called
##### Properties
Name | 
------- | 
**orderId** |
**checkoutId** |
**signifydId** |
**checkpointAction** |
**score** |
**checkpointActionReason** |
**checkpointActionPolicy** |
**coverage** |
**isError** | 
**errorMessage** |

You can access any value by using the getters methods in the response

### TransactionResponse
Transaction response is the response that is returned when the transaction api is called
##### Properties
Name |
------- |
**orderId** |
**signifydId** |
**isError** | 
**errorMessage** |

You can access any value by using the getters methods in the response

### SaleResponse
Sale response is the response that is returned when the sale api is called
##### Properties
Name |
------- |
**orderId** |
**signifydId** |
**checkpointAction** |
**score** |
**checkpointActionReason** |
**checkpointActionPolicy** |
**coverage** |
**isError** | 
**errorMessage** |

You can access any value by using the getters methods in the response

### FulfillmentResponse
Fulfillment response is the response that is returned when the fulfillment api is called
##### Properties
Name |
------- |
**orderId** | 
**isError** | 
**errorMessage** |

You can access any value by using the getters methods in the response

### WebhookResponse
Webhook response is the returned value when the webhook api methods are called
##### Properties
Name |
------- |
**id** | 
**eventType** | 
**url** | 
**enabled** | 
**isError** | 
**errorMessage** | 

You can access any value by using the getters methods in the response

SDK Settings
------------
### Settings
Contains the SDK configuration settings
##### Properties
Name | Type | Description | Notes
------- | ------- | ------- | -------
**apiKey** | **string** | The api key from Signifyd |
**apiAddress** | **string** | The default api url | "https://api.signifyd.com/v3/";
**validateData** | **string** | To validate or not the data | true;
**timeout** | **integer** | The default timeout for the curl connection | 30;
**retry** | **boolean** | Should the SDK retry when it receives know errors | false;
**SSLVerification** | **boolean** | Should curl check the ssl certificate | true;
**consoleOut** | **boolean** | Should the SDK output the logs to php://stdout | false;
**logEnabled** | **boolean** | Should the logs be enabled | true;

SDK Models
----------
### Address
Contains a shipping/billing address
The address object is a container for the address information, for the order that was placed in your store.
The address class can be found under namespace "Signifyd\Models", located lib/Models/Address.php.

```php
    $addressData = ['streetAddress' => '2 Broadway', '...'];
    $address = new \Signifyd\Models\Address($addressData);
```
or
```php
    $address = new \Signifyd\Models\Address();
    $address->setStreetAddress('2 Broadway');
```

### Checkout
Data related to the Pre-Auth checkout event.
The checkout object is the main container for the checkout related information that is sent to our API on checkout creation as a JSON string.
The checkout class can be found under namespace "Signifyd\Models", located lib/Models/Checkout.php.
The checkout object has as properties other objects from the "Signifyd\Models" namespace, in order to facilitate the creation of a correct object that our API will be able to process without errors.

```php
    $checkoutData = ['orderId' => 'ORDER-10045', 'purchase' => new \Signifyd\Models\Purchase(), '...'];
    $checkout = new \Signifyd\Models\Checkout($checkoutData);
```
or
```php
    $checkout = new \Signifyd\Models\Checkout();
    $checkout->setOrderId('ORDER-10045');
    $checkout->setPurchase(new \Signifyd\Models\Purchase());
```

### CheckoutPaymentDetails
Data related to the payment method and billing address used at checkout.
The checkoutPaymentDetails object is a container for the payment information collected during checkout.
The checkoutPaymentDetails class can be found under namespace "Signifyd\Models", located lib/Models/CheckoutPaymentDetails.php.

```php
    $paymentData = ['paymentMethod' => 'CREDIT_CARD', 'cardBin' => '411111', '...'];
    $checkoutPaymentDetails = new \Signifyd\Models\CheckoutPaymentDetails($paymentData);
```
or
```php
    $checkoutPaymentDetails = new \Signifyd\Models\CheckoutPaymentDetails();
    $checkoutPaymentDetails->setPaymentMethod('CREDIT_CARD');
    $checkoutPaymentDetails->setCardBin('411111');
```

### DiscountCode
Any discount codes, coupons, or promotional codes used during checkout to receive a discount on the order. You can only provide the discount code and the discount amount OR the discount percentage.
The discountCode object is the container for discount code related information for the order that was placed in your store.
The discountCode class can be found under namespace "Signifyd\Models", located lib/Models/DiscountCode.php.
The discountCode object has as properties other objects from the "Signifyd\Models" namespace, in order to facilitate the creation of a correct object that our API will be able to process without errors.

```php
    $discountCodeData = ['code' => '598218sdareqw74fds', '...'];
    $discountCode = new \Signifyd\Models\DiscountCode($discountCodeData);
```
or
```php
    $discountCode = new \Signifyd\Models\DiscountCode();
```

### Product
The products purchased in the transaction.
The product object is a container for the product information, for the order that was placed in your store.
The product class can be found under namespace "Signifyd\Models", located lib/Models/Product.php.
```php
    $productData = ['itemId' => 'SKU-001', '...'];
    $product = new \Signifyd\Models\Product($productData);
```
or
```php
    $product = new \Signifyd\Models\Product();
```

### Purchase
Data related to purchase event represented in this request.
The purchase object is a container for the order information, the order that was placed in your store.
The purchase class can be found under namespace "Signifyd\Models", located lib/Models/Purchase.php.
```php
    $purchaseData = ['browserIpAddress' => '192.168.1.1', '...'];
    $purchase = new \Signifyd\Models\Purchase($purchaseData);
```
or
```php
    $purchase = new \Signifyd\Models\Purchase();
```

### Sale
Data related to the Post-Auth sale event.
The sale object is the main container for the sale related information that is sent to our API on sale creation as a JSON string.
The sale class can be found under namespace "Signifyd\Models", located lib/Models/Sale.php.
The sale object has as properties other objects from the "Signifyd\Models" namespace, in order to facilitate the creation of a correct object that our API will be able to process without errors.

```php
    $saleData = ['orderId' => 'ORDER-10046', 'purchase' => new \Signifyd\Models\Purchase(), '...'];
    $sale = new \Signifyd\Models\Sale($saleData);
```
or
```php
    $sale = new \Signifyd\Models\Sale();
    $sale->setOrderId('ORDER-10046');
    $sale->setPurchase(new \Signifyd\Models\Purchase());
```

### Shipment
The shipments associated with this purchase.
The shipment object is a container for the shipment information, for the order that was placed in your store.
The shipment class can be found under namespace "Signifyd\Models", located lib/Models/Shipment.php.

```php
    $shipmentData = ['shipper' => 'Fedex', '...'];
    $shipment = new \Signifyd\Models\Shipment($shipmentData);
```
or
```php
    $shipment = new \Signifyd\Models\Shipment();
```

### Team

```php
    $teamData = ['teamId' => 1, '...'];
    $team = new \Signifyd\Models\Team($teamData);
```
or
```php
    $team = new \Signifyd\Models\Team();
```

### Transaction
Data related to a payment transaction for an order.
The transaction object is a container for the transaction information, for the order that was placed in your store.
The transaction class can be found under namespace "Signifyd\Models", located lib/Models/Transaction.php.

```php
    $transactionData = ['transactionId' => 'TXN-78912', 'gateway' => 'stripe', '...'];
    $transaction = new \Signifyd\Models\Transaction($transactionData);
```
or
```php
    $transaction = new \Signifyd\Models\Transaction();
    $transaction->setTransactionId('TXN-78912');
    $transaction->setGateway('stripe');
```

### UserAccount
The userAccount object is a container for the user account information, for the order that was placed in your store.
The userAccount class can be found under namespace "Signifyd\Models", located lib/Models/UserAccount.php.

```php
    $userData = ['email' => 'john@doe.com', '...'];
    $userAccount = new \Signifyd\Models\UserAccount($userData);
```
or
```php
    $userAccount = new \Signifyd\Models\UserAccount();
```

### Webhook
Webhook data.
The webhook object is a container for the webhook registration information.
The webhook class can be found under namespace "Signifyd\Models", located lib/Models/Webhook.php.

```php
    $webhookData = ['event' => 'ORDER_CHECKPOINT_ACTION_UPDATE', 'url' => 'Your Url'];
    $webhook = new \Signifyd\Models\Webhook($webhookData);
```
or
```php
    $webhook = new \Signifyd\Models\Webhook();
```