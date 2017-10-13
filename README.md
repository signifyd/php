SIGNIFYD client plugin for PHP. Intstall with Composer (https://getcomposer.org/)

### 1.	Overview

This document will give an overview on the available methods in the Signifyd PHP library. Also examples for this methods will be provided.
### 2.	Prerequisites

In order to authenticate with the API you need to provide your API key. You can find your API key on your account page.
### 3.	SignifydAPI CLASS

The main class that does the abstraction between your code and the API is the class SignifydAPI which can be found under namespace "Signifyd\Core", located under lib/Core/SignifydAPI.php.

In order to instantiate the main class you will need to instantiate the settings class first as the constructor of the Main class requires a settings object to be passed. The settings class is SignifydSettings can be found under the namespace "Signifyd\Core", located under lib/Core/SignifydSettings.php.

Example:
```<?php 
    // instantiating the settings class
    $settings = new \Signifyd\Core\SignifydSettings();
    $settings->apiKey = 'YOUR API KEY';

    // instantiating the api class
    $apiInstance = new \Signifyd\Core\SignifydAPI($settings);
?>
```
### Objects
#### 4.	Case Object

The case object is the main container for the case related information that is sent to our API on case creation as a JSON string.
The case class can be found under namespace "Signifyd\Models", located lib/Core/CaseModel.php.
The case object has as properties other objects from the "Signifyd\Models" namespace, in order to facilitate the creation of a correct object that our API will be able to process without errors.

```<?php 
    // instantiating the case model class
    $case = new \Signifyd\Models\CaseModel();
?>
```

The properties of the case object are as follows:
``` <?php
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

``` <?php 
    // instantiating the purchase model class
    $purchase = new \Signifyd\Models\Purchase();
?> 
```

The purchase object has the following properties that need to be filled in:
``` <?php 
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
``` <?php 
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

``` <?php 
    // instantiating the product model class
    $product = new \Signifyd\Models\Product();
?> 
```

The product object has the following properties that need to be filled in:
``` <?php 
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
``` <?php 
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

``` <?php 
    // instantiating the recipient model class
    $recipient = new \Signifyd\Models\Recipient();
?> 
```

The recipient object has the following properties that need to be filled in:
``` <?php 
    public $fullName;
    public $confirmationEmail;
    public $confirmationPhone;
    public $organization;
    public $deliveryAddress;
?> 
```

The delivery address in it's self an object.
Example:
``` <?php 
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

``` <?php 
    // instantiating the recipient model class
    $address = new \Signifyd\Models\Address();
?> 
```

The address object has the following properties that need to be filled in:
``` <?php 
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
``` <?php 
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

``` <?php 
    // instantiating the card model class
    $card = new \Signifyd\Models\Card();
?> 
```

The address object has the following properties that need to be filled in:
``` <?php 
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
``` <?php 
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

``` <?php 
    // instantiating the card model class
    $userAccount = new \Signifyd\Models\UserAccount();
?> 
```

The userAccount object has the following properties that need to be filled in:
``` <?php 
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
``` <?php 
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

``` <?php 
    // instantiating the seller model class
    $seller = new \Signifyd\Models\Seller();
?> 
```

The seller object has the following properties that need to be filled in:
``` <?php 
    public $name;
    public $domain;
    public $shipFromAddress; // Address
    public $corporateAddress; // Address
?> 
```

Example:
``` <?php 
    $seller->name = 'We sell awesome stuff, Inc.';
    $seller->domain = 'wesellawesomestuff.com';
    $seller->shipFromAddress = $address; //an Address object as seen above
    $seller->corporateAddress = $address1; //an Address object as seen above
?> 
```

#### 12.	Shipment Object

The shipment object is a container for the shipment information, for the order that was placed in your store.
The shipment class can be found under namespace "Signifyd\Models", located lib/Core/Shipment.php.

``` <?php 
    // instantiating the shipment model class
    $shipment = new \Signifyd\Models\Shipment();
?> 
```

The shipment object has the following properties that need to be filled in:
``` <?php 
    public $shipper;
    public $shippingMethod;
    public $shippingPrice;
    public $trackingNumber;
?> 
```

Example:
``` <?php
    $shipment->shipper = 'UPS';
    $shipment->shippingMethod = 'ground';
    $shipment->shippingPrice = 10;
    $shipment->trackingNumber = '3A4U569H1572924642';
?> 
```

#### 13.	PaymentUpdate Object

The paymentUpdate object is a container for the payment update information, for the order that was placed in your store.
The paymentUpdate class can be found under namespace "Signifyd\Models", located lib/Core/PaymentUpdate.php.

``` <?php 
    // instantiating the PaymentUpdate model class
    $paymentUpdate = new \Signifyd\Models\PaymentUpdate();
?> 
```

The paymentUpdate object has the following properties that need to be filled in:
``` <?php 
    public $paymentGateway;
    public $transactionId;
    public $avsResponseCode;
    public $cvvResponseCode;
?> 
```

Example:
``` <?php
    $paymentUpdate->paymentGateway = 'stripe';
    $paymentUpdate->transactionId = '1a2sf3f44f21s1';
    $paymentUpdate->avsResponseCode = 'Y';
    $paymentUpdate->cvvResponseCode = 'M';
?> 
```

###		SDK Methods

#### 14.	Create Case Method

This sends the request to our API Endpoint to create a new case. As a parameter for this method you need to send a case object that has its properties filled up.

``` <?php
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
```{
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

``` <?php
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
``` {
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
``` <?php
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
``` <?php
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
18.	Update Investigation Label Method

This sends the request to our API Endpoint to get a case. As a parameter for this method you need to send a case id and new investigation label.

``` <?php
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
