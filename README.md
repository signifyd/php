## :warning: WARNING :warning:
> **V2 SDK is deprecated**
Please refer to our [V3 API documentation](https://docs.signifyd.com) and download the OpenAPI specification linked at the top of the page to generate PHP and other SDKs for the latest version of Signifyd's Antifraud APIs.

Signifyd V2 PHP SDK
===================

This repository contains the PHP SDK client for the **deprecated** [Signifyd V2 API](https://developer.signifyd.com/api-v2/).

Overview
--------
This document will give an overview on the available methods in the Signifyd PHP library. Also examples for this methods will be provided.

Support
--------
For questions or issues please contact our [support team](https://www.signifyd.com/contact/). You can submit feedback and suggestions for improvement [here](https://github.com/signifyd/php/issues).

Examples
--------
If you are looking for a sample code that was tested and works, check out the [`sdk-examples`](https://github.com/signifyd/signifyd-php/tree/development-not-for-use/sdk-examples) repository.

Requirements
------------
* `PHP >= 5.6.0`
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
There are 3 api classes that each represents the 3 main parts of the API

***CASE API*** Which works with cases which are orders submitted to Signifyd for review. A case contains payment, recipient, product, shipping, and account information.

***GUARANTEE API*** Which works with guarantee which is a financial liability shift that protects online retailers in case of chargebacks. View our product manual to learn more.

***WEBHOOKS API*** Which works with webhooks which are messages sent by SIGNIFYD via HTTP POST to a url you configure on your Notifications page in the SIGNIFYD settings. Webhook messages are sent when certain events occur in the life of an investigation. They allow your application to receive pushed updates about a case, rather than poll SIGNIFYD for status changes.

API Clases
----------

### CaseApi

The CaseApi is the class the maps the main case functionality of the Signify API. This class has the methods that work with the Signify investigations (called cases).

There are multiple ways to instantiate the CaseApi class.
Usage examples:
```php
<?php
    // This might differ depending on the location of the file from which you your project
    require __DIR__ . '/vendor/autoload.php'; 
    
    $caseApi = new \Signifyd\Core\Api\CaseApi(["apiKey" => "your api key"]);
``` 
Or using the Settings Class
```php
<?php
    // This might differ depending on the location of the file from which you your project
    require __DIR__ . '/vendor/autoload.php'; 
    
    $settings = new \Signifyd\Core\Settings(["apiKey" => "your api key"]);
    $caseApi = new \Signifyd\Core\Api\CaseApi($settings);
``` 

#### Class methods
All methods accept two type of data as parameters. 

The parameter as an array, which means that the constructor of the model will set the values of the class properties 
based on the data passed to the constructor.

The parameter as an object, which means that after the instanciate of the class you can use the setters to add data to 
the model.


##### createCase($case);
Submit an order for fraud review.
There are multiple ways for the data to be sent to the createCase method. One way is to send an array with all the data 
required to the createCase method. This is useful if you know what data needs to be sent. 

For more info about the data that can be added please check the `CaseModel` model.
```php
    ....
    // Case data
    $caseData = [
        "purchase" => [
            // Data related to purchase event represented in this Case Creation request.
        ],
        "recipient" => [
            // Data related to person or organization receiving the items purchased.
        ],
        "card" => [
            // Data related to the card that was used for the purchase and its cardholder.
        ],
        "userAccount" => [
            //User account if exists before placing an orders these data values are details from that account. 
        ],
        "seller" => [
            // All data related to the seller of the product. 
        ]        
    ];
    $caseResponse = $caseApi->createCase($caseData);
    ....
``` 
Another way is to use the setters and getters of the models so you can add data.
```php
    ....
    $case = \Signifyd\Models\CaseModel();
    // Purchase array data or Purchase Object
    $case->setPurchase($purchase);
    
    // Recipient array data or Recipient Object
    $case->setRecipient($recipient);
    
    // Card array data or Card Object
    $case->setCard($card);
    
    // userAccount array data or userAccount Object
    $case->setUserAccount($userAccount);
    
    // Seller array data or Seller Object
    $case->setSeller($seller);
    
    $caseResponse = $caseApi->createCase($case);
```
An example of a JSON object sent to our API:
```json
{
    "purchase": {
        "orderSessionId": "uha3d98weicm20eufhlqe",
        "browserIpAddress": "192.168.1.1",
        "orderId": "4fj58as",
        "createdAt": "2016-07-11T17:54:31-05:00",
        "paymentGateway": "stripe",
        "paymentMethod": "credit_card",
        "transactionId": "1a2sf3f44f21s1",
        "currency": "USD",
        "avsResponseCode": "Y",
        "cvvResponseCode": "M",
        "orderChannel": "PHONE",
        "receivedBy": "John Doe",
        "totalPrice": 74.99,
        "products": [
            {
                "itemId": "1",
                "itemName": "Sparkly sandals",
                "itemUrl": "http://mydomain.com/sparkly-sandals",
                "itemImage": "http://mydomain.com/images/sparkly-sandals.jpeg",
                "itemQuantity": 1,
                "itemPrice": 49.99,
                "itemWeight": 5
            },
            {
                "itemId": "2",
                "itemName": "Summer tank top",
                "itemUrl": "http://mydomain.com/summer-tank",
                "itemImage": "http://mydomain.com/images/summer-tank.jpeg",
                "itemQuantity": 1,
                "itemPrice": 19.99,
                "itemWeight": 2
            }
        ],
        "shipments": [
            {
                "shipper": "UPS",
                "shippingMethod": "ground",
                "shippingPrice": 10,
                "trackingNumber": "3A4U569H1572924642"
            },
            {
                "shipper": "USPS",
                "shippingMethod": "international",
                "shippingPrice": 20,
                "trackingNumber": "9201120200855113889012"
            }
        ]
    },
    "recipient": {
        "fullName": "Bob Smith",
        "confirmationEmail": "bob@gmail.com",
        "confirmationPhone": "5047130000",
        "organization": "SIGNIFYD",
        "deliveryAddress": {
            "streetAddress": "123 State Street",
            "unit": "2A",
            "city": "Chicago",
            "provinceCode": "IL",
            "postalCode": "60622",
            "countryCode": "US",
            "latitude": 41.92,
            "longitude": -87.65
        }
    },
    "card": {
        "cardHolderName": "Robert Smith",
        "bin": 407441,
        "last4": "1234",
        "expiryMonth": 12,
        "expiryYear": 2015,
        "billingAddress": {
            "streetAddress": null,
            "unit": "2A",
            "city": "Chicago",
            "provinceCode": "IL",
            "postalCode": "60622",
            "countryCode": "US",
            "latitude": 41.92,
            "longitude": -87.65
        }
    },
    "userAccount": {
        "email": "bob@gmail.com",
        "username": "bobbo",
        "phone": "5555551212",
        "createdDate": "2013-01-18T17:54:31-05:00",
        "accountNumber": "54321",
        "lastOrderId": "4321",
        "aggregateOrderCount": 40,
        "aggregateOrderDollars": 5000,
        "lastUpdateDate": "2013-01-18T17:54:31-05:00"
    },
    "seller": {
        "name": "We sell awesome stuff, Inc.",
        "domain": "wesellawesomestuff.com",
        "shipFromAddress": {
            "streetAddress": "1850 Mercer Rd",
            "unit": null,
            "city": "Lexington",
            "provinceCode": "KY",
            "postalCode": "40511",
            "countryCode": "US",
            "latitude": 38.07,
            "longitude": -84.53
        },
        "corporateAddress": {
            "streetAddress": "410 Terry Ave",
            "unit": "3L",
            "city": "Seattle",
            "provinceCode": "WA",
            "postalCode": "98109",
            "countryCode": "US",
            "latitude": 47.6,
            "longitude": -122.33
        }
    }
}
```
This method with return a `CaseResponse` which will have the `caseId` property populated.
In case of error the `CaseResponse` will have the property `isError` set to `true` and the property `errorMessage` will have the received error message.
Error message can be empty if the request can not be made, but in this case the signifyd_connect.log will have the error logged.

##### getCase($caseId);
Retrieve details about an individual case by investigation id or case id.
```php
    ....
    $caseId = 123456789;
    $caseResponse = $caseApi->getCase($caseId);
    ....
```
This sends the request to our API Endpoint to get a case. As a parameter for this method you need to send a case id, an optional parameter is the entry.

This method with return a `CaseResponse` which will have all the properties populated.
In case of error the `CaseResponse` will have the property `isError` set to `true` and the property `errorMessage` will have the received error message.
Error message can be empty if the request can not be made, but in this case the signifyd_connect.log will have the error logged.

##### addFulfillment($fulfillments);
This sends the request to our API Endpoint to add fulfillments for order. One way is to send an array with all the data required to the addFulfillment method.

For more info about the data that can be added please check the `Fulfillment` model.
```php
    ....
    $fulfillmentData = [
        // Fulfilment data
    ];
    $caseResponse = $caseApi->addFulfillment($fulfillmentData);
    ....
```
This method with return a `FulfillmentBulkResponse` which will have the `objects` property populated with `Fulfillment` model all the properties populated.
In case of error the `FulfillmentBulkResponse` will have the property `isError` set to `true` and the property `errorMessage` will have the received error message.
Error message can be empty if the request can not be made, but in this case the signifyd_connect.log will have the error logged.

##### updatePayment($paymentUpdate);
Update payment data by sending updated information.
This sends the request to our API Endpoint to update the payment for an existing case.

For more info about the data that can be added please check the `PaymentUpdate` model.
```php
    ....
    $paymentUpdate = new Signifyd\Models\PaymentUpdate([
        // Payment update data
    ]);

    // Add data to payment update
    $caseResponse = $caseApi->updatePayment($paymentUpdate);
    ....
```
This method with return a `CaseResponse` which will have the properties populated.
In case of error the `CaseResponse` will have the property `isError` set to `true` and the property `errorMessage` will have the received error message.
Error message can be empty if the request can not be made, but in this case the signifyd_connect.log will have the error logged.

### GuaranteeApi
The GuaranteeApi is the class the maps the main guarantee functionality of the Signify API. This class has the methods 
that work with guarantees.

There are multiple ways to instantiate the GuaranteeApi class.
Usage examples:
```php
<?php
    // This might differ depending on the location of the file from which you your project
    require __DIR__ . '/vendor/autoload.php'; 
    
    $guaranteeApi = new \Signifyd\Core\Api\GuaranteeApi(["apiKey" => "your api key"]);
``` 
Or using the Settings Class
```php
<?php
    // This might differ depending on the location of the file from which you your project
    require __DIR__ . '/vendor/autoload.php'; 
    
    $settings = new \Signifyd\Core\Settings(["apiKey" => "your api"]);
    $guaranteeApi = new \Signifyd\Core\Api\GuaranteeApi($settings);
``` 

#### Class methods
All methods accept two type of data as parameters. 

The parameter as an array, which means that the constructor of the model will set the values of the class properties 
based on the data passed to the constructor.

The parameter as an object, which means that after the instanciate of the class you can use the setters to add data to 
the model.

##### createGuarantee($guarantee);
Submit a request to guarantee an existing case.

For more info about the data that can be added please check the `Guarantee` model.
```php
    ....
    $guarantee = new \Signifyd\Model\Guarantee(['caseId' => 123456]);
    $guaranteeResponse = $guaranteeApi->createGuarantee($quarantee);
    ....
```
This method with return a `GuaranteeResponse` which will have the properties populated.
In case of error the `GuaranteeResponse` will have the property `isError` set to `true` and the property `errorMessage` will have the received error message.
Error message can be empty if the request can not be made, but in this case the signifyd_connect.log will have the error logged.

##### cancelGuarantee($guarantee);
A Guarantee can be canceled for orders that no longer require a guarantee.

For more info about the data that can be added please check the `Guarantee` model.
```php
    ....
    $quarantee = new \Signifyd\Model\Guarantee(['caseId' => 123456789]);
    $guaranteeResponse = $guaranteeApi->cancelGuarantee($quarantee);
    ....
```
This method with return a `GuaranteeResponse` which will have the properties populated.
In case of error the `GuaranteeResponse` will have the property `isError` set to `true` and the property `errorMessage` will have the received error message.
Error message can be empty if the request can not be made, but in this case the signifyd_connect.log will have the error logged.

### WebhookApi
The WebhookApi is the class the maps the main webhooks functionality of the Signify API. This class has the methods 
that work with webhooks.

There are multiple ways to instantiate the WebhookApi class.
Usage examples:
```php
<?php
    // This might differ depending on the location of the file from which you your project
    require __DIR__ . '/vendor/autoload.php'; 
    
    $webhooksApi = new \Signifyd\Core\Api\WebhooksApi(["apiKey" => "your api key"]);
``` 
Or using the Settings Class
```php
<?php
    // This might differ depending on the location of the file from which you your project
    require __DIR__ . '/vendor/autoload.php'; 
    
    $settings = new \Signifyd\Core\Settings(["apiKey" => "your api key"]);
    $webhooksApi = new \Signifyd\Core\Api\WebhooksApi($settings);
``` 

#### Class methods
All methods accept two type of data as parameters. 

The parameter as an array, which means that the constructor of the model will set the values of the class properties 
based on the data passed to the constructor.

The parameter as an object, which means that after the instanciate of the class you can use the setters to add data to 
the model.

##### validWebhookRequest($request, $hash, $topic);
Check if a webhook callback is valid.
```php
    ....
    $valid = $webhooksApi->validWebhookRequest($request, $hash, $topic);
    ....
```
This is a helper function which does not connect to signifyd.
This method with return a boolean `true` in case of a valid request or `false` in case of a invalid request.

##### createWebhooks($webhooks);
Create webhooks in Signifyd.

For more info about the data that can be added please check the `Wehbook` model.
```php
    ....
    $webhook1 = new \Signifyd\Model\Webhook([
        // Webhook data
    ]);
    $webhook2 = new \Signifyd\Model\Webhook([
        // Webhook data
    ]);
    $webhooks = [$webhook1, $webhook2];
    $webhooksBulkResponse = $webhooksApi->createWebhooks($webhooks);
    ....
```
This method with return a `WebhooksBulkResponse` which will have the `objects` property populated with `WebhooksResponse` with all the properties populated.
In case of error the `WebhooksBulkResponse` will have the property `isError` set to `true` and the property `errorMessage` will have the received error message.
Error message can be empty if the request can not be made, but in this case the signifyd_connect.log will have the error logged.

##### updateWebhooks($webhooks);
Update webhooks in Signifyd.

For more info about the data that can be added please check the `Wehbook` model.
```php
    ....
    $webhook1 = new \Signifyd\Model\Webhook([
        // Webhook data
    ]);
    $webhook2 = new \Signifyd\Model\Webhook([
        // Webhook data
    ]);
    $webhooks = [$webhook1, $webhook2];
    $webhooksBulkResponse = $webhooksApi->updateWebhooks($webhooks);
    ....
```
This method with return a `WebhooksBulkResponse` which will have the `objects` property populated with `WebhooksResponse` with all the properties populated.
In case of error the `WebhooksBulkResponse` will have the property `isError` set to `true` and the property `errorMessage` will have the received error message.
Error message can be empty if the request can not be made, but in this case the signifyd_connect.log will have the error logged.

##### getWebhooks();
Retrive a list of webhooks set in Signifyd.
```php
    ....
    $webhooksBulkResponse = $webhooksApi->getWebhooks();
    ....
```
This method with return a `WebhooksBulkResponse` which will have the `objects` property populated with `WebhooksResponse` with all the properties populated.
In case of error the `WebhooksBulkResponse` will have the property `isError` set to `true` and the property `errorMessage` will have the received error message.
Error message can be empty if the request can not be made, but in this case the signifyd_connect.log will have the error logged.

##### updateWebhook($webhook);
Update a single webhook in Signifyd.

For more info about the data that can be added please check the `Wehbook` model.
```php
    ....
    $webhook = new \Signifyd\Model\Webhook([
        // Webhook data
    ]);
    $webhooksResponse = $webhooksApi->updateWebhook($webhook);
    ....
```
This method with return a `WebhooksResponse` which will have the properties populated.
In case of error the `WebhooksResponse` will have the property `isError` set to `true` and the property `errorMessage` will have the received error message.
Error message can be empty if the request can not be made, but in this case the signifyd_connect.log will have the error logged.

##### deleteWebhook($webhook);
Delete a webhook from Signifyd.

For more info about the data that can be added please check the `Wehbook` model.
```php
    ....
    $webhook = new \Signifyd\Model\Webhook([
        // Webhook data
    ]);
    $webhooksResponse = $webhooksApi->deleteWebhook($webhook);
    ....
```
This method with return a `WebhooksResponse` which will have the properties populated.
In case of error the `WebhooksResponse` will have the property `isError` set to `true` and the property `errorMessage` will have the received error message.
Error message can be empty if the request can not be made, but in this case the signifyd_connect.log will have the error logged.

SDK API Responses
-------------
### CaseResponse
Case response is the response that is returned when the case api is called
##### Properties
Name | 
------- | 
**guaranteeEligible** 
**guaranteeDisposition** |
**status** |
**caseId** |
**score** |
**uuid** |
**headline** |
**orderId** |
**orderDate** |
**orderAmount** |
**associatedTeam** |
**reviewDisposition** |
**createdAt** |
**updatedAt** |
**orderOutcome** |
**currency** |
**adjustedScore** |
**testInvestigation** |
**logger** |
**isError** | 
**errorMessage** |

You can access any value by using the getters methods in the response

### FulfillmentBulkResponse
Fulfillment bulk response onse is the response that is returned when the case api addFulfillment method is called
##### Properties
Name |
------- |
**objects** | 
**logger** |
**isError** | 
**errorMessage** |

You can access any value by using the getters methods in the response

### GuaranteeResponse
Guarantee response is the returned value when the guarantee api is called
##### Properties
Name |
------- |
**disposition** | 
**reviewedBy** | 
**reviewedAt** | 
**submittedBy** | 
**submittedAt** | 
**rereviewCount** | 
**guaranteeId** | 
**caseId** | 
**isError** | 
**errorMessage** | 
**logger** | 

You can access any value by using the getters methods in the response

### WebhooksResponse
Webhoook response is the returned value when the webhook api for update and delete webhook methods are called
##### Properties
Name |
------- |
**id** | 
**eventType** | 
**eventDisplayText** | 
**url** | 
**team** | 
**isError** | 
**errorMessage** | 
**responseArray** | 
**logger** | 

You can access any value by using the getters methods in the response

### WebhooksBulkResponse
Webhoook bulk response is the returned value when the webhook api for get, create and update webhooks methods are called
##### Properties
Name |
------- |
**objects** | 
**isError** | 
**errorMessage** |
**logger** | 

You can access any value by using the getters methods in the response

SDK Settings
------------
### Settings
Contains a shipping/billing address
##### Properties
Name | Type | Description | Notes
------- | ------- | ------- | -------
**apiKey** | **string** | The api key from Signifyd |
**apiAddress** | **string** | The default api url | "https://api.signifyd.com/v2/";
**validateData** | **string** | To validate or not the data | true;
**timeout** | **integer** | The default timeout for the curl connection | 30;
**retry** | **boolean** | Should the SDK retry when it receives know errors | false;
**SSLVerification** | **boolean** | Should curl check the ssl certificate | false;
**consoleOut** | **boolean** | Should the SDK output the logs to php://stdout | false;
**logEnabled** | **boolean** | Should the logs be enabled | true;

SDK Models
----------
### Address
Contains a shipping/billing address
The address object is a container for the address information, for the order that was placed in your store.
The address class can be found under namespace "Signifyd\Models", located lib/Models/Address.php.

```php
    // instantiating the address model class
    $addressData = ['streetAddress' => '2 Brodway', '...'];
    $address = new \Signifyd\Models\Address($addressData);
```
or
```php
    // instantiating the address model class
    $address = new \Signifyd\Models\Address();
    $address->setSteetAddress('2 Brodway');
```

### Card
Data related to the card that was used for the purchase and its cardholder
The card object is a container for the card information, for the order that was placed in your store.
The card class can be found under namespace "Signifyd\Models", located lib/Models/Card.php.

```php
    // instantiating the card model class
    $cardData = ['cardHolderName' => 'John Doe', '...'];
    $card = new \Signifyd\Models\Card($cardData);
```
or
```php
    // instantiating the card model class
    $card = new \Signifyd\Models\Card();
    $card->setCardHolderName('John Doe');
```
### CaseModel
Data related to the case
The case object is the main container for the case related information that is sent to our API on case creation as a JSON string.
The case class can be found under namespace "Signifyd\Models", located lib/Models/CaseModel.php.
The case object has as properties other objects from the "Signifyd\Models" namespace, in order to facilitate the creation of a correct object that our API will be able to process without errors.

```php
    // instantiating the case model class
    $caseData = ['purchase' => new \Signifyd\Model\Purchase(), '...'];
    $caseModel = new \Signifyd\Models\CaseModel($caseData);
```
or
```php
    // instantiating the case model class
    $caseModel = new \Signifyd\Models\CaseModel();
    $caseModel->setPurchase(new \Signifyd\Model\Purchase());
```
### DiscountCode
Any discount codes, coupons, or promotional codes used during checkout to recieve a discount on the order. You can only provide the discount code and the discount amount OR the discount percentage.
The discountCode object is the container for discount code related information for the order that was placed in your store.
The discountCode class can be found under namespace "Signifyd\Models", located lib/Models/DiscountCode.php.
The discountCode object has as properties other objects from the "Signifyd\Models" namespace, in order to facilitate the creation of a correct object that our API will be able to process without errors.

```php
    // instantiating the discount code model class
    $discountCodeData = ['code' => '598218sdareqw74fds', '...'];
    $discountCode = new \Signifyd\Models\DiscountCode($discountCodeData);
```
or
```php
    // instantiating the discount code model class
    
    $discountCode = new \Signifyd\Models\DiscountCode();
```
### Guarantee
Guarantee data
The guarantee object is the container for guarantee information that is sent to our API.
The guarantee class can be found under namespace "Signifyd\Models", located lib/Models/Guarantee.php.
The guarantee object has as properties other objects from the "Signifyd\Models" namespace, in order to facilitate the creation of a correct object that our API will be able to process without errors.

```php
    // instantiating the guarantee model class
    $guaranteeData = ['caseId' => 1234567890];
    $guarantee = new \Signifyd\Models\Guarantee($guaranteeData);
```
or
```php
    // instantiating the guarantee model class
    
    $guarantee = new \Signifyd\Models\Guarantee();
```
### PaymentUpdate
Payment update data
The paymentUpdate object is a container for the payment update information, for the order that was placed in your store.
The paymentUpdate class can be found under namespace "Signifyd\Models", located lib/Models/PaymentUpdate.php.

```php
    // instantiating the payment update model class
    $paymentUpdateData = ['paymentGateway' => 'Authorizenet', '...'];
    $paymentUpdate = new \Signifyd\Models\PaymentUpdate($paymentUpdateData);
```
or
```php
    // instantiating the payment update model class
    
    $paymentUpdate = new \Signifyd\Models\PaymentUpdate();
```
### Product
The products purchased in the transaction
The product object is a container for the product information, for the order that was placed in your store.
The product class can be found under namespace "Signifyd\Models", located lib/Models/Recipient.php.
```php
    // instantiating the product model class
    $productData = ['itemId' => 1251541, '...'];
    $product = new \Signifyd\Models\Product($productData);
```
or
```php
    // instantiating the product model class
    
    $product = new \Signifyd\Models\Product();
```
### Purchase
Data related to purchase event represented in this Case Creation request.
The purchase object is a container for the order information, the order that was placed in your store.
The purchase class can be found under namespace "Signifyd\Models", located lib/Models/Purchase.php.
```php
    // instantiating the purchase address model class
    $purchaseData = ['orderSessionId' => '1121aseaa324321ahiuhfsdiuhaiufds', '...'];
    $purchase = new \Signifyd\Models\Purchase($purchaseData);
```
or
```php
    // instantiating the purchase address model class
    
    $purchase = new \Signifyd\Models\Purchase();
```
### Recipient
Data related to person or organization receiving the items purchased.
The recipient object is a container for the recipient information, for the order that was placed in your store.
The recipient class can be found under namespace "Signifyd\Models", located lib/Models/Recipient.php.

```php
    // instantiating the recipient model class
    $recipientData = ['fullName' => 'John Doe', '...'];
    $recipient = new \Signifyd\Models\Recipient($recipientData);
```
or
```php
    // instantiating the recipient model class
    
    $recipient = new \Signifyd\Models\Recipient();
```
### Seller
All data related to the seller of the product. This information is optional unless you are operating a marketplace, listing goods on behalf of multiple sellers who each hold a seller account registered with your site (e.g. Ebay).
The seller object is a container for the seller information, for the order that was placed in your store.
The seller class can be found under namespace "Signifyd\Models", located lib/Models/Seller.php.

```php
    // instantiating the seller model class
    $sellerData = ['name' => 'My company', '...'];
    $seller = new \Signifyd\Models\Seller($sellerData);
```
or
```php
    // instantiating the seller model class
    
    $seller = new \Signifyd\Models\Seller();
```
### Shipment
The shipments associated with this purchase.
The shipment object is a container for the shipment information, for the order that was placed in your store.
The shipment class can be found under namespace "Signifyd\Models", located lib/Models/Shipment.php.

```php
    // instantiating the shipment model class
    $shipmentData = ['shipper' => 'Fedex', '...'];
    $shipment = new \Signifyd\Models\Shipment($shipmentData);
```
or
```php
    // instantiating the shipment model class
    
    $shipment = new \Signifyd\Models\Shipment();
```
### Team

```php
    // instantiating the team model class
    $teamData = ['teamId' => 1, '...'];
    $team = new \Signifyd\Models\Team($teamData);
```
or
```php
    // instantiating the team model class
    
    $team = new \Signifyd\Models\Team();
```
### UserAccount
The userAccount object is a container for the user account information, for the order that was placed in your store.
The userAccount class can be found under namespace "Signifyd\Models", located lib/Models/UserAccount.php.

```php
    // instantiating the user account model class
    $userData = ['emailAddress' => 'john@doe.com', '...'];
    $userAccount = new \Signifyd\Models\UserAccount($userData);
```
or
```php
    // instantiating the user account model class
    $userAccount = new \Signifyd\Models\UserAccount();
```
### Webhook
Wehook data
The webhook object is a container for the user account information, for the order that was placed in your store.
The webhook class can be found under namespace "Signifyd\Models", located lib/Models/Webhook.php.

```php
    // instantiating the webhook model class
    $webhookData = ['event' => '', 'url' => 'Your Url'];
    $webhook = new \Signifyd\Models\Webhook($webHookData);
```
or
```php
    // instantiating the webhook model class
    $webhook = new \Signifyd\Models\Webhook();
```
