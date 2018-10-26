<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25-Nov-16
 * Time: 10:19
 */

namespace Signifyd\Tests;

use Signifyd\Core\SignifydAPI;
use Signifyd\Core\SignifydSettings;
use Signifyd\Models\Address;
use Signifyd\Models\CaseModel;
use Signifyd\Models\Guarantee;
use Signifyd\Models\Product;
use Signifyd\Models\Purchase;
use Signifyd\Models\Recipient;
use Signifyd\Models\Card;
use Signifyd\Models\Shipment;
use Signifyd\Models\UserAccount;
use Signifyd\Models\Seller;


class ApiTest
{
    public $settings;
    public $caseId;

    public function __construct()
    {
        $this->settings = new SignifydSettings();
        $this->settings->apiKey = 'sTZo7rkDiojxi1SJz2LExejMA';
    }

    public function run()
    {
        $this->createCase();
        $this->getCase();
        $this->closeCase();
        $this->createCase();
        $this->createGuarantee();
        $this->cancelGuarantee();
        $this->closeCase();
        $this->createCase();
        $this->updatePayment();
        $this->updateInvestigationLabel();
        $this->closeCase();
    }

    public function createCase()
    {
        $case = new CaseModel();
        $case->purchase = new Purchase();
        $case->recipient = new Recipient();
        $case->card = new Card();
        $case->userAccount = new UserAccount();
        $case->seller = new Seller();

        // Add the seller info
        $case->seller->name = 'Testing Sdk';
        $case->seller->domain = 'signifyd-uat.osf-demo.com';
        $case->seller->shipFromAddress = new Address();
        $case->seller->shipFromAddress->streetAddress = 'Alverna nr 62';
        $case->seller->shipFromAddress->unit = '1';
        $case->seller->shipFromAddress->city = 'Cluj Napoca';
        $case->seller->shipFromAddress->provinceCode = 'CJ';
        $case->seller->shipFromAddress->postalCode = '400600';
        $case->seller->shipFromAddress->countryCode = 'RO';
        $case->seller->corporateAddress = new Address();
        $case->seller->corporateAddress->streetAddress = 'Alverna nr 62';
        $case->seller->corporateAddress->unit = '1';
        $case->seller->corporateAddress->city = 'Cluj Napoca';
        $case->seller->corporateAddress->provinceCode = 'CJ';
        $case->seller->corporateAddress->postalCode = '400600';
        $case->seller->corporateAddress->countryCode = 'RO';

        // Add credit card info
        $case->card->cardHolderName = 'Testing First';
        $case->card->bin = '411111';
        $case->card->last4 = '1111';
        $case->card->expiryMonth = '02';
        $case->card->expiryYear = '2020';
//        $case->card->hash = '';
        $case->card->billingAddress = new Address();
        $case->card->billingAddress->streetAddress = 'Intre lacuri nr 6';
        $case->card->billingAddress->unit = '10';
        $case->card->billingAddress->city = 'Cluj Napoca';
        $case->card->billingAddress->provinceCode = 'CJ';
        $case->card->billingAddress->postalCode = '400680';
        $case->card->billingAddress->countryCode = 'RO';

        // Add purchase info
        $case->purchase = new Purchase();
        $case->purchase->orderSessionId = '12345678954847';
        $case->purchase->browserIpAddress = '192.168.1.120';
        $case->purchase->orderId = '2';
        $case->purchase->createdAt = date('Y-m-d\TH:i:s\Z');
        $case->purchase->currency = 'USD';
        $case->purchase->avsResponseCode = 'Y';
        $case->purchase->cvvResponseCode = 'M';
        $case->purchase->transactionId = '12548499851875121';
        $case->purchase->totalPrice = 70.00; //double

        // Add products info
        $product = new Product();
        $product->itemId = '20';
        $product->itemName = 'Falcon 9';
        $product->itemUrl = 'http://signifyd.adev/index.php/rockets/falcon-9.html';
        $product->itemImage = 'http://signifyd.adev/media/catalog/product/cache/1/thumbnail/75x/9df78eab33525d08d6e5fb8d27136e95/1/6/16512864369_2bb896c344_o.jpg';
        $product->itemQuantity = '1';
        $product->itemPrice = 65.00;
        $product->itemWeight = 5;
        $product->itemIsDigital = false;
        $product->itemCategory = 'Rockets';
        $product->itemSubCategory = 'Big Rockets';
        $case->purchase->products = [$product];

        // Add shipment info
        $shipment = new Shipment();
        $shipment->shipper = 'FEDEX';
        $shipment->shippingMethod = 'EXPRESS';
        $shipment->shippingPrice = 5;
        $shipment->trackingNumber = '1254887544887548874';
        $case->purchase->shipments = [$shipment];

        // Add recepient
        $case->recipient = new Recipient();
        $case->recipient->fullName = 'Testing Testing';
        $case->recipient->confirmationEmail = 'cristian.vatca@osf-global.com';
        $case->recipient->confirmationPhone = '124587548451844';
        $case->recipient->deliveryAddress = new Address();
        $case->recipient->deliveryAddress->streetAddress = 'Intre lacuri nr 6';
        $case->recipient->deliveryAddress->unit = '10';
        $case->recipient->deliveryAddress->city = 'Cluj Napoca';
        $case->recipient->deliveryAddress->provinceCode = 'CJ';
        $case->recipient->deliveryAddress->postalCode = '400680';
        $case->recipient->deliveryAddress->countryCode = 'RO';

        // Add user account
        $case->userAccount = new UserAccount();
        $case->userAccount->emailAddress = 'cristian.vatca@osf-global.com';
        $case->userAccount->username = 'cristian.vatca@osf-global.com';
        $case->userAccount->phone = '124587548451844';
        $case->userAccount->createdDate = date('Y-m-d\TH:i:s\Z');
        $case->userAccount->accountNumber = '2546';
        $case->userAccount->lastOrderId = '1';
        $case->userAccount->aggregateOrderCount = 2;
        $case->userAccount->aggregateOrderDollars = 125.5;
        $case->userAccount->lastUpdateDate = date('Y-m-d\TH:i:s\Z');

        $api = new SignifydAPI($this->settings);
        $response = $api->createCase($case);
        var_dump($response);
        $this->caseId = $response;
    }

    public function getCase()
    {
        $api = new SignifydAPI($this->settings);
        $response = $api->getCase($this->caseId);
        var_dump($response);
    }

    public function closeCase()
    {
        $api = new SignifydAPI($this->settings);
        $response = $api->closeCase($this->caseId);
        var_dump($response);
    }

    public function createGuarantee()
    {
        $api = new SignifydAPI($this->settings);
        $guarantee = new Guarantee();
        $guarantee->caseId = $this->caseId;
        $response = $api->createGuarantee($guarantee);
        var_dump($response);
    }

    public function cancelGuarantee()
    {
        $api = new SignifydAPI($this->settings);
        $response = $api->cancelGuarantee($this->caseId);
        var_dump($response);
    }

    public function updatePayment()
    {
        $api = new SignifydAPI($this->settings);
        $paymentUpdate = '';
        $response = $api->updatePayment($this->caseId, $paymentUpdate);
        var_dump($response);
    }

    public function updateInvestigationLabel()
    {
        $api = new SignifydAPI($this->settings);
        $investigationUpdate = '';
        $response = $api->updateInvestigationLabel($this->caseId, $investigationUpdate);
        var_dump($response);
    }
}