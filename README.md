SIGNIFYD PHP SDK [![Build Status]()]()
================

*** If you have feedback good or bad about the new version of the repository please don't hesitate to contact us at

This repository contains the PHP SDK client for the Signifyd APIs. For more info please check the [Signifyd API documentation](https://www.signifyd.com/api/)

If you are looking for a specific ecommerce integration (eq. [Magento2](https://github.com/signifyd/magento2), Shopify, etc) checkout our listing for the existing integrations.

If you are looking for a sample code that was tested and works, check out the [`sdk-api-examples`](https://github.com/signifyd/signifyd-php/tree/master/sdk-examples) repository.

This document will give an overview on the available methods in the Signifyd PHP SDK. Also examples for this methods will be provided.

Overview
--------

This document will give an overview on the available methods in the Signifyd PHP library. Also examples for this methods will be provided.

Requirements
------------
* `PHP >= 5.6.0`
* In order to use the API you need to provide your API key. You can find your API key on your [account page](https://app.signifyd.com/settings).

Installing the SDK
------------------
##### With composer

The Signifyd PHP SDK is available on Packagist. To add it to your project, simply run:

```
$ php composer.phar require signifyd/signifyd-php 2.x
```

Or add the this line under the `"require"` key in your `composer.json`:
```
{
    "require" : {
        ...
        "signifyd/signifyd-php": "2.*"
    }
}
```
After adding the line you must install the Signifyd PHP SDK dependency by running:
```
$ php composer.phar install
```

Getting Started
---------------
Please make sure that the SDK was installed. [Installation procedure](installing-sdk)

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
    
    $caseApi = new \Signifyd\Core\Api\CaseApi(["apiKey" => "your api"]);
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
##### getCase($caseId);
Retrieve details about an individual case by investigation id or case id.
```php
    ....
    $caseId = 123456789;
    $caseResponse = $caseApi->getCase($caseId);
    ....
```
##### closeCase($caseId);
Close case using case id, by dismissing it.
```php
    ....
    $caseId = 123456789;
    $caseResponse = $caseApi->closeCase($caseId);
    ....
```
##### updatePayment($paymentUpdate);
Close case using case id, by dismissing it.
```php
    ....
    $caseId = 123456789;
    $caseResponse = $caseApi->closeCase($caseId);
    ....
```
##### updateInvestigationLabel($caseId, $investigationUpdate);
Close case using case id, by dismissing it.
```php
    ....
    $caseId = 123456789;
    $caseResponse = $caseApi->closeCase($caseId);
    ....
```
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
```php
    ....
    $guarantee = new \Signifyd\Model\Guarantee(['caseId' => 123456]);
    $guaranteeResponse = $guaranteeApi->createGuarantee($quarantee);
    ....
```
##### cancelGuarantee($guarantee);
A Guarantee can be canceled for orders that no longer require a guarantee.
```php
    ....
    $quarantee = new \Signifyd\Model\Guarantee(['caseId' => 123456789]);
    $guaranteeResponse = $guaranteeApi->cancelGuarantee($quarantee);
    ....
```
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
    
    $settings = new \Signifyd\Core\Settings(["apiKey" => "your api"]);
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
##### createWebhooks($webhooks);
Create webhooks in Signifyd.
```php
    ....
    $webhook1 = new \Signifyd\Model\Webhook([]);
    $webhooks = [$webhook1, $webhook2];
    $webhooksResponse = $webhooksApi->createWebhooks($webhooks);
    ....
```
##### updateWebhooks($webhooks);
Update webhooks in Signifyd.
```php
    ....
    $webhooks = [$webhook1, $webhook2];
    $webhooksResponse = $webhooksApi->updateWebhooks($webhooks);
    ....
```
##### getWebhooks();
Retrive a list of webhooks set in Signifyd.
```php
    ....
    $webhooksResponse = $webhooksApi->getWebhooks($webhooks);
    ....
```
##### updateWebhook($webhook);
Update a single webhook in Signifyd.
```php
    ....
    $webhook = new \Signifyd\Model\Webhook([]);
    $webhooksResponse = $webhooksApi->updateWebhook($webhook);
    ....
```
##### deleteWebhook($webhook);
Delete a webhook from Signifyd.
```php
    ....
    $webhook = new \Signifyd\Model\Webhook([]);
    $webhooksResponse = $webhooksApi->deleteWebhook($webhook);
    ....
```

SDK API Responses
-------------
### CaseResponse
Case response is the response that is returned when the case api is called
##### Parameters
Name | Type | Description | Notes
------- | ------- | ------- | -------
**guaranteeEligible** | **string** | |
**guaranteeDisposition** | **string** | |
**status** | **string** | |
**caseId** | **string** | |
**score** | **string** | |
**uuid** | **string** | |
**headline** | **string** | |
**orderId** | **string** | |
**orderDate** | **string** | |
**orderAmount** | **string** | |
**associatedTeam** | **string** | |
**reviewDisposition** | **string** | |
**createdAt** | **string** | |
**updatedAt** | **string** | |
**orderOutcome** | **string** | |
**currency** | **string** | |
**adjustedScore** | **string** | |
**testInvestigation** | **string** | |
**logger** | **string** | |
**isError** | **string** | |
**errorMessage** | **string** | |
You can access any value by using the getters methods in the response

### GuaranteeResponse
Guarantee response is the returned value when the guarantee api is called
##### Parameters
Name | Type | Description | Notes
------- | ------- | ------- | -------
**disposition** | **string** | |
**reviewedBy** | **string** | |
**reviewedAt** | **string** | |
**submittedBy** | **string** | |
**submittedAt** | **string** | |
**rereviewCount** | **string** | |
**guaranteeId** | **string** | |
**caseId** | **string** | |
**isError** | **string** | |
**errorMessage** | **string** | |
**logger** | **string** | |
You can access any value by using the getters methods in the response

### WebhooksResponse
Webhoook response is the returned value when the webhook api is called
##### Parameters
Name | Type | Description | Notes
------- | ------- | ------- | -------
**streetAddress** | **string** | The street number and street name |
**unit** | **string** | The unit or apartment number |
**city** | **string** | The city name |
**provinceCode** | **string** | The code or abbreviation for the province |
**postalCode** | **string** | The postal code |
**countryCode** | **string** | The two-letter ISO-3166 country code. If left blank, we will assume US |
**latitude** | **string** | Geographical latitude |
**longitude** | **string** | Geographical longitude |
You can access any value by using the getters methods in the response

SDK Settings
------------
### Settings
Contains a shipping/billing address
##### Parameters
Name | Type | Description | Notes
------- | ------- | ------- | -------
**apiKey** | **string** | |
**apiAddress** | **string** | | "https://api.signifyd.com/v2/";
**validateData** | **string** | | true;
**timeout** | **integer** | | 30;
**retry** | **boolean** | | false;
**SSLVerification** | | | false;
**consoleOut** | | | false;
**logEnabled** | | | true;

SDK Models
----------
### Address
Contains a shipping/billing address
##### Parameters
Name | Type | Description | Notes
------- | ------- | ------- | -------
**streetAddress** | **string** | The street number and street name |
**unit** | **string** | The unit or apartment number |
**city** | **string** | The city name |
**provinceCode** | **string** | The code or abbreviation for the province |
**postalCode** | **string** | The postal code |
**countryCode** | **string** | The two-letter ISO-3166 country code. If left blank, we will assume US |
**latitude** | **string** | Geographical latitude |
**longitude** | **string** | Geographical longitude |

```php
    // instantiating the address model class
    $addressData = [];
    $address = new \Signifyd\Models\Address($addressData);
```
or
```php
    // instantiating the address model class
    $address = new \Signifyd\Models\Address();
```

### Card
Data related to the card that was used for the purchase and its cardholder
##### Parameters
Name | Type | Description | Notes
------- | ------- | ------- | -------
**cardHolderName** | **string** | The full name on the credit card that was charged |
**bin** | **integer** | The first six digits of the credit card, the bank identification number, which uniquely identifies the issuer |
**last4** | **string** | The last four digits of the card number |
**expiryMonth** | **integer** | MM representation of the expiration month of the card |
**expiryYear** | **integer** | yyyy representation of the expiration year of the card |
**hash** | **string** | |
**billingAddress** | **object** | The billing address for the card | Address Object
```php
    // instantiating the card model class
    $cardData = [];
    $card = new \Signifyd\Models\Card($cardData);
```
or
```php
    // instantiating the card model class
    
    $card = new \Signifyd\Models\Card();
```
### CaseModel
Data related to the case
##### Parameters
Name | Type | Description | Notes
------- | ------- | ------- | -------
**purchase** | **object** | Data related to purchase event represented in this Case Creation request | Purchase Object
**recipient** | **object** | Data related to person or organization receiving the items purchased | Recipient Object
**card** | **object** | Data related to the card that was used for the purchase and its cardholder | Card Object
**userAccount** | **object** | If you allow customers to create an account before placing an orders these data values are details from that account. You should only fill these values in if the customer has an account into which they can login. Leave them blank if this was a one-time transaction with no account (Guest Checkout). | UserAccount Object
**seller** | **object** | All data related to the seller of the product. This information is optional unless you are operating a marketplace, listing goods on behalf of multiple sellers who each hold a seller account registered with your site (e.g. Ebay). | Seller Object
```php
    // instantiating the case model class
    $caseData = [];
    $caseModel = new \Signifyd\Models\CaseModel($caseData);
```
or
```php
    // instantiating the case model class
    
    $caseModel = new \Signifyd\Models\CaseModel();
```
### DiscountCode
Any discount codes, coupons, or promotional codes used during checkout to recieve a discount on the order. You can only provide the discount code and the discount amount OR the discount percentage
##### Parameters
Name | Type | Description | Notes
------- | ------- | ------- | -------
**code** | **string** | The name of the discount code entered during checkout |
**amount** | **integer** | The fixed amount of the discount applied. e.g. $10 off purchase. This field should be NULL if a discount percentage is provided. |
**percentage** | **integer** | If a percentage discount is applied the percentage of the total order amount the discount applies to. e.g. 20% off purchase. This field should be NULL if amount is provided. |
```php
    // instantiating the discount code model class
    $discountCodeData = [];
    $discountCode = new \Signifyd\Models\DiscountCode($discountCodeData);
```
or
```php
    // instantiating the discount code model class
    
    $discountCode = new \Signifyd\Models\DiscountCode();
```
### Guarantee
Guarantee data
##### Parameters
Name | Type | Description | Notes
------- | ------- | ------- | -------
**caseId** | **string** | The name of the discount code entered during checkout |
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
##### Parameters
Name | Type | Description | Notes
------- | ------- | ------- | -------
**paymentGateway** | **string** | The gateway that processed the transaction |
**transactionId** | **string** | The unique identifier provided by the payment gateway for this order. If you have provided us with credentials for your payment gateway we can obtain additional details about the order, like AVS and CVV status, from your payment provider. |
**avsResponseCode**  | **string** | The response code from the address verification system (AVS). Accepted codes: http://www.emsecommerce.net/avs_cvv2_response_codes.htm |
**cvvResponseCode**  | **string** | The response code from the card verification value (CVV) check. Accepted codes listed on above link |
```php
    // instantiating the payment update model class
    $paymentUpdateData = [];
    $paymentUpdate = new \Signifyd\Models\PaymentUpdate($paymentUpdateData);
```
or
```php
    // instantiating the payment update model class
    
    $paymentUpdate = new \Signifyd\Models\PaymentUpdate();
```
### Product
The products purchased in the transaction
##### Parameters
Name | Type | Description | Notes
------- | ------- | ------- | -------
**itemId** | **string** | Your unique identifier for the product. This is a string because of hexadecimal identifiers. |
**itemName** | **string** | The name of the product |
**itemUrl** | **string** | The url to the product's page |
**itemImage** | **string** | The url to an image of the product |
**itemQuantity** | **integer** | The number of the items purchased |
**itemPrice** | **integer** | The price paid for each item (not the aggregate) |
**itemWeight** | **string** | The weight of each item in grams |
**itemIsDigital** | **boolean** | Indicates whether the item is electronically delivered e.g. gift cards |
**itemCategory** | **string** | The name of the top-level product category. e.g. Apparel |
**itemSubCategory** | **string** | The name of the sub-category of the product if applicable. e.g. T-Shirt |
```php
    // instantiating the product model class
    $productData = [];
    $product = new \Signifyd\Models\Product($productData);
```
or
```php
    // instantiating the product model class
    
    $product = new \Signifyd\Models\Product();
```
### Purchase
Data related to purchase event represented in this Case Creation request.
##### Parameters
Name | Type | Description | Notes
------- | ------- | ------- | -------
**orderSessionId** | **string** | The unique ID for the user's browsing session. This is to be used in conjunction with the Signifyd Fingerprinting Javascript |
**browserIpAddress** | **string** | The IP Address of the browser that was used to make the purchase. This is the IP Address that was used to connect to your site and make the purchase. You must provide a valid IP address syntax |
**orderId** | **string** | A string uniquely identifying this order |
**createdAt** | **string** | yyyy-MM-dd'T'HH:mm:ssZ The date and time when the order was placed, shown on the signifyd console. See the Dates section of these docs for more information about date formats |
**paymentGateway** | **string** | The gateway that processed the transaction |
**paymentMethod** | **string** | The method the user used to complete the purchase. | The possible values: ach, ali_pay, apple_pay, amazon_payments, android_pay, bitcoin, cash, check, credit_card, free, google_pay, loan, paypal_account, reward_points, store_credit, samsung_pay, visa_checkout |   
**currency** | **string** | The currency type of the order, in 3 letter ISO 4217 format. Defaults to USD |
**avsResponseCode** | **string** | The response code from the address verification system (AVS). Accepted codes: http://www.emsecommerce.net/avs_cvv2_response_codes.htm |
**cvvResponseCode** | **string** | The response code from the card verification value (CVV) check. Accepted codes listed on above link |
**transactionId** | **string** | The unique identifier provided by the payment gateway for this order. If you have provided us with credentials for your payment gateway we can obtain additional details about the order, like AVS and CVV status, from your payment provider. |
**orderChannel** | **string** | The method used by the buyer to place the order | web, phone, mobile_app, social, marketplace, in_store_kiosk  
**receivedBy** | **string** | If the order was was taken by a customer service or sales agent, his or her name |
**totalPrice** | **integer** | The total price of the order, including shipping price and taxes |
**products** | **array** | The products purchased in the transaction. |
**shipments** | **array** | The shipments associated with this purchase. |
**discountCodes** | **array** | Any discount codes, coupons, or promotional codes used during checkout to recieve a discount on the order. You can only provide the discount code and the discount amount OR the discount percentage. |
```php
    // instantiating the purchase address model class
    $purchaseData = [];
    $purchase = new \Signifyd\Models\Purchase($purchaseData);
```
or
```php
    // instantiating the purchase address model class
    
    $purchase = new \Signifyd\Models\Purchase();
```
### Recipient
Data related to person or organization receiving the items purchased.
##### Parameters
Name | Type | Description | Notes
------- | ------- | ------- | -------
**fullName** | **string** | The full name of the person receiving the goods. If this item is being shipped, then this field is the person it is being shipping to. Don't assume this name is the same as card.cardHolderName. Only put a value here if the name will actually appear on the shipping label. If this item is digital, then this field will likely be blank |
**confirmationEmail** | **string** | When this purchase was completed, you likely sent a confirmation email or you will be sending a confirmation email to someone once you approve the order. This is the email address to which that confirmation email will be sent. You must provide a valid email syntax |
**confirmationPhone** | **string** | The phone number that you would call if there was something wrong with this order or the phone number that was supplied with the shipping information |
**organization** | **string** | If provided by the buyer, the name of the recipient's company or organization |
**deliveryAddress** | **object** | The address to which the order will be delivered |
```php
    // instantiating the recipient model class
    $recipientData = [];
    $recipient = new \Signifyd\Models\Recipient($recipientData);
```
or
```php
    // instantiating the recipient model class
    
    $recipient = new \Signifyd\Models\Recipient();
```
### Seller
All data related to the seller of the product. This information is optional unless you are operating a marketplace, listing goods on behalf of multiple sellers who each hold a seller account registered with your site (e.g. Ebay).
##### Parameters
Name | Type | Description | Notes
------- | ------- | ------- | -------
**name** | **string** | The business name of the seller |
**domain** | **string** | The domain of the seller |
```php
    // instantiating the seller model class
    $sellerData = [];
    $seller = new \Signifyd\Models\Seller($sellerData);
```
or
```php
    // instantiating the seller model class
    
    $seller = new \Signifyd\Models\Seller();
```
### Shipment
The shipments associated with this purchase.
##### Parameters
Name | Type | Description | Notes
------- | ------- | ------- | -------
**shipper** | **string** | The name of the shipper |
**shippingMethod** | **string** | The type of the shipment method used |
**shippingPrice** | **integer** | The amount charged to the customer for shipping the product |
**trackingNumber** | **string** | The tracking number |
```php
    // instantiating the shipment model class
    $shipmentData = [];
    $shipment = new \Signifyd\Models\Shipment($shipmentData);
```
or
```php
    // instantiating the shipment model class
    
    $shipment = new \Signifyd\Models\Shipment();
```
### Team
##### Parameters
Name | Type | Description | Notes
------- | ------- | ------- | -------
**teamId** | **string** | The team id |
**teamName** | **string** | The team name |
```php
    // instantiating the team model class
    $teamData = [];
    $team = new \Signifyd\Models\Team($teamData);
```
or
```php
    // instantiating the team model class
    
    $team = new \Signifyd\Models\Team();
```
### UserAccount
##### Parameters
Name | Type | Description | Notes
------- | ------- | ------- | -------
**emailAddress** | **string** | The primary email address associated with the account |
**username** | **string** | The username associated with the account. Please supply this even if it is the same as the email address |
**phone** | **string** | The phone number associated with the account |
**createdDate** | **string** | yyyy-MM-dd'T'HH:mm:ssZ The date when the account was created. See the Dates section of these docs for more information about date formats |
**accountNumber** | **string** | Your unique identifier for the account |
**lastOrderId** | **string** | The unique identifier for the last order placed by this account, prior to the current order |
**aggregateOrderCount** | **integer** | The total count of orders placed by this account since it was created, including the current order |
**aggregateOrderDollars** | **float** | The total amount spent by this account since it was created, including the current order |
**lastUpdateDate** | **string** | yyyy-MM-dd'T'HH:mm:ssZ The last time a change was made to this account other than an order being placed. Examples include changing email addresses or adding a new credit card. See the Dates section of these docs for more information about date formats |
```php
    // instantiating the user account model class
    $userData = ['emailAddress' => '', 'username' => ''];
    $userAccount = new \Signifyd\Models\UserAccount($userData);
```
or
```php
    // instantiating the user account model class
    $userData = ['emailAddress' => '', 'username' => ''];
    $userAccount = new \Signifyd\Models\UserAccount();
```
### Webhook
##### Parameters
Name | Type | Description | Notes
------- | ------- | ------- | -------
**event** | **string** | The event type |
**url** | **string** | The webhook event url |
```php
    // instantiating the webhook model class
    $webhookData = ['event' => '', 'url' => 'Your Url'];
    $webhook = new \Signifyd\Models\Webhook($webHookData);
```
or
```php
    // instantiating the webhook model class
    $webhookData = ['event' => '', 'url' => 'Your Url'];
    $webhook = new \Signifyd\Models\Webhook($webHookData);
```
Contributing
------------

Send bug reports, feature requests, and code contributions to the [API
specifications repository](https://github.com/signifyd/signifyd-php),
as this repository contains only the generated SDK code. If you notice something wrong about this SDK in particular, feel free to raise an issue [here](https://github.com/square/connect-php-sdk/issues).

License
-------

```
The MIT License (MIT)
http://opensource.org/licenses/MIT

Copyright © 2015 SIGNIFYD Inc. All rights reserved.


Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.  IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
```

### Objects
#### 4.	Case Object

The case object is the main container for the case related information that is sent to our API on case creation as a JSON string.
The case class can be found under namespace "Signifyd\Models", located lib/Core/CaseModel.php.
The case object has as properties other objects from the "Signifyd\Models" namespace, in order to facilitate the creation of a correct object that our API will be able to process without errors.

```php
<?php 
    // instantiating the case model class
    $case = new \Signifyd\Models\CaseModel();
?>
```

The properties of the case object are as follows:
```php
<?php
    /**
     * @var \Signifyd\Models\Purchase
     */
    public $purchase;
    /**
     * @var \Signifyd\Models\Recipient
     */
    public $recipient;
    /**
     * @var \Signifyd\Models\Card
     */
    public $card;
    /**
     * @var \Signifyd\Models\UserAccount
     */
    public $userAccount;
    /**
     * @var \Signifyd\Models\Seller
     */
    public $seller;
?> 
```
#### 5.	Purchase Object

The purchase object is a container for the order information, the order that was placed in your store.
The purchase class can be found under namespace "Signifyd\Models", located lib/Core/Purchase.php.

```php
<?php 
    // instantiating the purchase model class
    $purchase = new \Signifyd\Models\Purchase();
?> 
```

The purchase object has the following properties that need to be filled in:
```php
<?php 
    public $browserIpAddress;
    public $orderId;
    public $createdAt; // datetime
    public $paymentGateway;
    public $currency;
    public $avsResponseCode;
    public $cvvResponseCode;
    public $transactionId;
    public $orderChannel;
    public $receivedBy;
    public $totalPrice; //double

    public $products; // array of objects
    public $shipments; // array of objects
?> 
```

Example:
```php
<?php 
    $purchase->browserIpAddress = '192.168.1.1';
    $purchase->orderId = '4fj58as';
    $purchase->createdAt = '2016-07-11T17:54:31-05:00';
    $purchase->paymentGateway = "stripe";
    $purchase->paymentMethod = "credit_card";
    $purchase->transactionId = "1a2sf3f44f21s1";
    $purchase->currency = "USD";
    $purchase->avsResponseCode = "Y";
    $purchase->cvvResponseCode = "M";
    $purchase->orderChannel = "PHONE";
    $purchase->receivedBy = "John Doe";
    $purchase->totalPrice = 74.99;
?> 
```
#### 6.	Product Object

The product object is a container for the product information, for the order that was placed in your store.
The product class can be found under namespace "Signifyd\Models", located lib/Core/Recipient.php.

```php
<?php 
    // instantiating the product model class
    $product = new \Signifyd\Models\Product();
?> 
```

The product object has the following properties that need to be filled in:
```php
<?php 
    public $itemId;
    public $itemName;
    public $itemUrl;
    public $itemImage;
    public $itemQuantity;
    public $itemPrice;
    public $itemWeight;
?> 
```

Example:
```php
<?php 
    $product->itemId = '2';
    $product->itemName = 'Sparkly sandals';
    $product->itemUrl = 'http://mydomain.com/sparkly-sandals';
    $product->itemImage = 'http://mydomain.com/images/sparkly-sandals.jpeg';
    $product->itemQuantity = 1;
    $product->itemPrice = 49.99;
    $product->itemWeight = 5; 
?> 
```
7.	Recipient Object

The recipient object is a container for the recipient information, for the order that was placed in your store.
The recipient class can be found under namespace "Signifyd\Models", located lib/Core/Recipient.php.

```php
<?php 
    // instantiating the recipient model class
    $recipient = new \Signifyd\Models\Recipient();
?> 
```

The recipient object has the following properties that need to be filled in:
```php
<?php 
    public $fullName;
    public $confirmationEmail;
    public $confirmationPhone;
    public $organization;
    public $deliveryAddress;
?> 
```

The delivery address in it's self an object.
Example:
```php
<?php 
    $recipient->fullName = "Bob Smith";
    $recipient->confirmationEmail = "bob@gmail.com";
    $recipient->confirmationPhone = "5047130000";
    $recipient->organization = "SIGNIFYD";
    $recipient->deliveryAddress =  $deliveryAddress; // check the Address object below
?> 
```

#### 8.	Address Object

The address object is a container for the address information, for the order that was placed in your store.
The address class can be found under namespace "Signifyd\Models", located lib/Core/Address.php.

```php
<?php 
    // instantiating the recipient model class
    $address = new \Signifyd\Models\Address();
?> 
```

The address object has the following properties that need to be filled in:
```php
<?php 
    public $streetAddress;
    public $unit;
    public $city;
    public $provinceCode;
    public $postalCode;
    public $countryCode;
    public $latitude;
    public $longitude;
?> 
```

Example:
```php
<?php 
    $address->streetAddress = '123 State Street';
    $address->unit = '2A';
    $address->city = 'Chicago';
    $address->provinceCode = 'IL';
    $address->postalCode = '60622';
    $address->countryCode = 'US';
    $address->latitude = 41.92;
    $address->longitude = -87.65;
?> 
```
#### 9.	Card Object

The card object is a container for the card information, for the order that was placed in your store.
The card class can be found under namespace "Signifyd\Models", located lib/Core/Card.php.

```php
<?php 
    // instantiating the card model class
    $card = new \Signifyd\Models\Card();
?> 
```

The address object has the following properties that need to be filled in:
```php
<?php 
    public $cardHolderName;
    public $bin;
    public $last4;
    public $expiryMonth;
    public $expiryYear;
    public $hash;
    public $billingAddress;
?> 
```

Example:
```php
<?php 
    $card->cardHolderName = 'Robert Smith';
    $card->bin = 407441;
    $card->last4 = '1234';
    $card->expiryMonth = 12;
    $card->expiryYear = 2015;
    $card->hash = '';
    $card->billingAddress = $address; //an Address object as seen above
?> 
```
#### 10.	UserAccount Object

The userAccount object is a container for the user account information, for the order that was placed in your store.
The userAccount class can be found under namespace "Signifyd\Models", located lib/Core/UserAccount.php.

```php
<?php 
    // instantiating the card model class
    $userAccount = new \Signifyd\Models\UserAccount();
?> 
```

The userAccount object has the following properties that need to be filled in:
```php
<?php 
    public $emailAddress;
    public $username;
    public $phone;
    public $createdDate;
    public $accountNumber;
    public $lastOrderId;
    public $aggregateOrderCount;
    public $aggregateOrderDollars;
    public $lastUpdateDate;
?> 
```

Example:
```php
<?php 
    $userAccount->emailAddress = 'bob@gmail.com';
    $userAccount->username = 'bobbo';
    $userAccount->phone = '5555551212';
    $userAccount->createdDate = '2013-01-18T17:54:31-05:00';
    $userAccount->accountNumber = '54321';
    $userAccount->lastOrderId = '4321';
    $userAccount->aggregateOrderCount = 40;
    $userAccount->aggregateOrderDollars = 5000;
    $userAccount->lastUpdateDate = '2013-01-18T17:54:31-05:00';
?> 
```
#### 11.	Seller Object

The seller object is a container for the seller information, for the order that was placed in your store.
The seller class can be found under namespace "Signifyd\Models", located lib/Core/Seller.php.

```php
<?php 
    // instantiating the seller model class
    $seller = new \Signifyd\Models\Seller();
?> 
```

The seller object has the following properties that need to be filled in:
```php
<?php 
    public $name;
    public $domain;
    public $shipFromAddress; // Address
    public $corporateAddress; // Address
?> 
```

Example:
```php
<?php 
    $seller->name = 'We sell awesome stuff, Inc.';
    $seller->domain = 'wesellawesomestuff.com';
    $seller->shipFromAddress = $address; //an Address object as seen above
    $seller->corporateAddress = $address1; //an Address object as seen above
?> 
```

#### 12.	Shipment Object

The shipment object is a container for the shipment information, for the order that was placed in your store.
The shipment class can be found under namespace "Signifyd\Models", located lib/Core/Shipment.php.

```php
<?php 
    // instantiating the shipment model class
    $shipment = new \Signifyd\Models\Shipment();
?> 
```

The shipment object has the following properties that need to be filled in:
```php
<?php 
    public $shipper;
    public $shippingMethod;
    public $shippingPrice;
    public $trackingNumber;
?> 
```

Example:
```php
<?php
    $shipment->shipper = 'UPS';
    $shipment->shippingMethod = 'ground';
    $shipment->shippingPrice = 10;
    $shipment->trackingNumber = '3A4U569H1572924642';
?> 
```

#### 13.	PaymentUpdate Object

The paymentUpdate object is a container for the payment update information, for the order that was placed in your store.
The paymentUpdate class can be found under namespace "Signifyd\Models", located lib/Core/PaymentUpdate.php.

```php
<?php 
    // instantiating the PaymentUpdate model class
    $paymentUpdate = new \Signifyd\Models\PaymentUpdate();
?> 
```

The paymentUpdate object has the following properties that need to be filled in:
```php
<?php 
    public $paymentGateway;
    public $transactionId;
    public $avsResponseCode;
    public $cvvResponseCode;
?> 
```

Example:
```php
<?php
    $paymentUpdate->paymentGateway = 'stripe';
    $paymentUpdate->transactionId = '1a2sf3f44f21s1';
    $paymentUpdate->avsResponseCode = 'Y';
    $paymentUpdate->cvvResponseCode = 'M';
?> 
```

###		SDK Methods

#### 14.	Create Case Method

This sends the request to our API Endpoint to create a new case. As a parameter for this method you need to send a case object that has its properties filled up.

```php
<?php
    // instantiating the settings class
    $settings = new \Signifyd\Core\SignifydSettings();
    $settings->apiKey = 'YOUR API KEY';

    // instantiating the api class
    $apiInstance = new \Signifyd\Core\SignifydAPI($settings);

    // $case is the caseModel object as described above
    // $investicationId is the response from the our API
    $investigationId = $apiInstance->createCase($case);
?> 
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

Based on the HTTP response code the createCase method can return the investigationId can be a string of characters or bool false.
If the HTTP response code is 2xx to 3xx value of the investigationId is the investigation id of the case created in our application.
If the HTTP response code is other than 2xx to 3xx the investigationId will have the value of false, which indicates that the case creation has failed.

The usual payload for a response:

{
    "investigationId": 1
}

#### 15.	Get Case Method

This sends the request to our API Endpoint to get a case. As a parameter for this method you need to send a case id, an optional parameter is the entry.

```php
<?php
    // instantiating the settings class
    $settings = new \Signifyd\Core\SignifydSettings();
    $settings->apiKey = 'YOUR API KEY';

    // instantiating the api class
    $apiInstance = new \Signifyd\Core\SignifydAPI($settings);

    // $caseId is the id of an existing case
    $case = $apiInstance->getCase($caseId);
?> 
```

Based on the HTTP response code the getCase method can return the $case, an array of values or bool false.
If the HTTP response code is 2xx to 3xx value of the case is an array with the case values from our application.
If the HTTP response code is other than 2xx to 3xx the case the value of false, which indicates that the retrieving of the case has failed.

Example of request:
GET https://api.signifyd.com/v2/cases/caseId

Example of response:
```
{
    guaranteeEligible: false,
    guaranteeDisposition: "APPROVED",
    status: "DISMISSED",
    caseId: 44,
    score: 776,
    adjustedScore: 776,
    investigationId: 44,
    uuid: "97c56c86-7984-44fa-9a3e-7d5f34d1bead",
    headline: "Maxine Trycia",
    orderId: "1234",
    orderDate: "2013-01-18T22:54:29+0000",
    orderAmount: 48,
    associatedTeam: "1",
    reviewDisposition: "GOOD",
    createdAt: "2013-03-06T23:17:17+0000",
    updatedAt: "2013-03-06T23:17:18+0000"
} 
```
#### 16.	Close Case Method

This sends the request to our API Endpoint to close a case. As a parameter for this method you need to send a case id.
```php
<?php
    // instantiating the settings class
    $settings = new \Signifyd\Core\SignifydSettings();
    $settings->apiKey = 'YOUR API KEY';

    // instantiating the api class
    $apiInstance = new \Signifyd\Core\SignifydAPI($settings);

    // $caseId is the id of an existing case
    $case = $apiInstance->closeCase($caseId);
?> 
```

Based on the HTTP response code the closeCase method can return the $response, an array of values or bool false.
If the HTTP response code is 2xx to 3xx, the value of the $case is an array with the case values from our application.
If the HTTP response code is other than 2xx to 3xx the $case value is false, which indicates that the closing of the case has failed.


#### 17.	Update Payment Method

This sends the request to our API Endpoint to update the payment for an existing case. As a parameter for this method you need to send a case id and the payment update object (as described above).
```php
<?php
    // instantiating the settings class
    $settings = new \Signifyd\Core\SignifydSettings();
    $settings->apiKey = 'YOUR API KEY';

    // instantiating the api class
    $apiInstance = new \Signifyd\Core\SignifydAPI($settings);

    // $caseId is the id of an existing case
    $update = $apiInstance->updatePayment($caseId, $paymentUpdate);
?> 
```

Based on the HTTP response code the updatePayment method can return the bool true or bool false.
If the HTTP response code is 2xx to 3xx the value of the $update is a bool true from our application, indicating the success of the update.
If the HTTP response code is other than 2xx to 3xx the $update value is a bool false, which indicates that the updating of the case has failed.


#### 18.	Update Investigation Label Method

This sends the request to our API Endpoint to get a case. As a parameter for this method you need to send a case id and new investigation label.

```php
<?php
    // instantiating the settings class
    $settings = new \Signifyd\Core\SignifydSettings();
    $settings->apiKey = 'YOUR API KEY';

    // instantiating the api class
    $apiInstance = new \Signifyd\Core\SignifydAPI($settings);

    // $caseId is the id of an existing case
    $update = $apiInstance->updateInvestigationLabel($caseId, $investigationUpdate);
?> 
```

Based on the HTTP response code the updateInvestigationLabel method can return the bool true or bool false.
If the HTTP response code is 2xx to 3xx the value of the $update is a bool true from our application, indicating the success of the update.
If the HTTP response code is other than 2xx to 3xx the $update value is a bool false, which indicates that the updating of the case has failed.
