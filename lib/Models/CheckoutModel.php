<?php
/**
 * CaseModel for the Signifyd SDK
 *
 * PHP version 5.6
 *
 * @category  Signifyd_Fraud_Protection
 * @package   Signifyd\Core
 * @author    Signifyd <info@signifyd.com>
 * @copyright 2018 SIGNIFYD Inc. All rights reserved.
 * @license   See LICENSE.txt for license details.
 * @link      https://www.signifyd.com/
 */
namespace Signifyd\Models;

use Laminas\Filter\Boolean;
use Signifyd\Core\Model;

/**
 * Class CheckoutModel
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class CheckoutModel extends Model
{
    /**
     * Unique identifier for a checkout..
     *
     * @var string
     */
    public $checkoutId;

    /**
     * Unique identifier for an Order.
     *
     * @var string
     */
    public $orderId;

    /**
     * Data related to purchase event represented in
     * this Case Creation request.
     *
     * @var \Signifyd\Models\Purchase
     */
    public $purchase;

    /**
     * If you allow customers to create an account before
     * placing an orders these data values are details from
     * that account.
     *
     * @var \Signifyd\Models\UserAccount
     */
    public $userAccount;

    /**
     * The membership object should be used to indicate the usage of a
     * rewards, discount, or admission program by the buyer when they completed the checkout.
     *
     * @var array Array of Membership objects
     */
    public $memberships;

    /**
     * The types of coverages requested.
     *
     * @var array Array of strings
     */
    public $coverageRequests;

    /**
     * A Merchant Category Code (MCC) is a four-digit number listed in ISO 18245 for retail financial services.
     *
     * @var string
     */
    public $merchantCategoryCode;

    /**
     * Data about the device that was used by the user to complete the actions.
     *
     * @var \Signifyd\Models\Device
     */
    public $device;

    /**
     * Details about the merchant's commerce platform.
     *
     * @var \Signifyd\Models\MerchantPlatform
     */
    public $merchantPlatform;

    /**
     * Details about the Signifyd plugin that the merchant is using
     *
     * @var \Signifyd\Models\SignifydClient
     */
    public $signifydClient;

    /**
     * A list of payment instruments and associated payment
     * details used to pay for the order.
     *
     * @var array $transactions Array of PreAuthTransaction objects
     */
    public $transactions = [];

    /**
     * Use only if you operate a marketplace (e.g. eBay)
     * and allow other merchants to list and sell products on the online store.
     *
     * @var array sellers
     */
    public $sellers;

    /**
     * A list of attributes or short descriptors associated with the order.
     *
     * @var array strings
     */
    public $tags;

    /**
     * The types of additional evaluations requested.
     * If no additional evaluation object is provided or is empty, additional evaluation will not take place.
     *
     * @var array strings
     */
    public $additionalEvalRequests;

    /**
     * If you have a legacy risk system independent of Signifyd,
     * use this field to pass us the decision from that system.
     * This is most commonly used when onboarding.
     *
     * @var string
     */
    public $customerOrderRecommendation;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'checkoutId',
        'orderId',
        'purchase',
        'userAccount',
        'memberships',
        'coverageRequests',
        'merchantCategoryCode',
        'device',
        'merchantPlatform',
        'signifydClient',
        'transactions',
        'sellers',
        'tags',
        'additionalEvalRequests',
        'customerOrderRecommendation'
    ];

    protected $arrayOfObjectFields = [
        'memberships',
        'sellers'
    ];

    protected $stringFields = [
        'checkoutId',
        'orderId',
        'merchantCategoryCode',
        'customerOrderRecommendation'
    ];

    /**
     * CaseModel constructor.
     *
     * @param array $case The case data
     */
    public function __construct($case = [])
    {
        // Check if something was passed to the class
        if (is_array($case) && !empty($case)) {
            foreach ($this->fields as $field) {
                // init the class name
                $class = '\Signifyd\Models\\' . ucfirst($field);

                // make sure no wild data is sent
                if (array_key_exists($field, $case) === false) {
                    continue;
                }

                if ($field == 'transactions' && is_array($case['transactions'])) {
                    foreach ($case['transactions'] as $preAuthTransaction) {
                        if ($preAuthTransaction instanceof PreAuthTransaction) {
                            $this->addTransaction($preAuthTransaction);
                        } else {
                            $objectTransaction = new PreAuthTransaction($preAuthTransaction);
                            $this->addTransaction($objectTransaction);
                        }
                    }
                    continue;
                }

                if ($field == 'purchase') {
                    if ($case['purchase'] instanceof Purchase) {
                        $this->setPurchase($case['purchase']);
                    } elseif (is_array($case['purchase'])) {
                        $objectPurchase = new Purchase($case['purchase']);
                        $this->setPurchase($objectPurchase);
                    }
                    continue;
                }

                if (is_array($case[$field]) && !empty($case[$field])) {
                    if (in_array($field, $this->arrayOfObjectFields)) {
                        // init the class name
                        $singular = substr($field,0,-1);
                        $className = ucfirst($singular);
                        $class = '\Signifyd\Models\\' . $className;

                        foreach ($case[$field] as $item) {
                            if ($item instanceof $class) {
                                $object = $item;
                            } else {
                                $object = new $class($item);
                            }

                            $this->{'add' . $className}($object);
                        }
                    } else {
                        $this->{'set' . ucfirst($field)}($case[$field]);
                    }
                } elseif ($case[$field] instanceof $class) {
                    $this->{'set' . ucfirst($field)}($case[$field]);
                } elseif (in_array($field, $this->stringFields)) {
                    $this->{'set' . ucfirst($field)}($case[$field]);
                }
            }
        }
    }

    /**
     * Validate the case data
     *
     * @return array|bool
     */
    public function validate()
    {
        $valid = [];

        return (!isset($valid[0]))? true : $valid;
    }

    /**
     * @param $checkoutId
     * @return void
     */
    public function setCheckoutId($checkoutId)
    {
        $this->checkoutId = $checkoutId;
    }

    /**
     * @return string
     */
    public function getCheckoutId()
    {
        return $this->checkoutId;
    }

    /**
     * @param $orderId
     * @return void
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param $purchase
     * @return void
     */
    public function setPurchase($purchase)
    {
        $this->purchase = $purchase;
    }

    /**
     * @return Purchase
     */
    public function getPurchase()
    {
        return $this->purchase;
    }

    /**
     * @param $userAccount
     * @return void
     */
    public function setUserAccount($userAccount)
    {
        $this->userAccount = $userAccount;
    }

    /**
     * @return UserAccount
     */
    public function getUserAccount()
    {
        return $this->userAccount;
    }

    /**
     * @param $membership
     * @return void
     */
    public function addMembership($membership)
    {
        $this->memberships[] = $membership;
    }

    /**
     * @param $coverageRequest
     * @return void
     */
    public function addCoverageRequest($coverageRequest)
    {
        $this->coverageRequests[] = $coverageRequest;
    }

    /**
     * @param $coverageRequests
     * @return void
     */
    public function setCoverageRequests($coverageRequests)
    {
        $this->coverageRequests = $coverageRequests;
    }

    /**
     * @return array
     */
    public function getCoverageRequests()
    {
        return $this->coverageRequests;
    }

    /**
     * @param $merchantCategoryCode
     * @return void
     */
    public function setMerchantCategoryCode($merchantCategoryCode)
    {
        $this->merchantCategoryCode = $merchantCategoryCode;
    }

    /**
     * @return string
     */
    public function getMerchantCategoryCode()
    {
        return $this->merchantCategoryCode;
    }

    /**
     * @param $device
     * @return void
     */
    public function setDevice($device)
    {
        $this->device = $device;
    }

    /**
     * @return Device
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param $merchantPlatform
     * @return void
     */
    public function setMerchantPlatform($merchantPlatform)
    {
        $this->merchantPlatform = $merchantPlatform;
    }

    /**
     * @return MerchantPlatform
     */
    public function getMerchantPlatform()
    {
        return $this->merchantPlatform;
    }

    /**
     * @param $signifydClient
     * @return void
     */
    public function setSignifydClient($signifydClient)
    {
        $this->signifydClient = $signifydClient;
    }

    /**
     * @return SignifydClient
     */
    public function getSignifydClient()
    {
        return $this->signifydClient;
    }

    /**
     * @param $transaction
     * @return void
     */
    public function addTransaction($transaction)
    {
        $this->transactions[] = $transaction;
    }

    /**
     * @param $seller
     * @return void
     */
    public function addSeller($seller)
    {
        $this->sellers[] = $seller;
    }

    /**
     * @param $tag
     * @return void
     */
    public function addTag($tag)
    {
        $this->tags[] = $tag;
    }

    /**
     * @param $tags
     * @return void
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param $additionalEvalRequest
     * @return void
     */
    public function addAdditionalEvalRequest($additionalEvalRequest)
    {
        $this->additionalEvalRequests[] = $additionalEvalRequest;
    }

    /**
     * @param $additionalEvalRequests
     * @return void
     */
    public function setAdditionalEvalRequests($additionalEvalRequests)
    {
        $this->additionalEvalRequests = $additionalEvalRequests;
    }

    /**
     * @return array
     */
    public function getAdditionalEvalRequests()
    {
        return $this->additionalEvalRequests;
    }

    /**
     * @param $customerOrderRecommendation
     * @return void
     */
    public function setCustomerOrderRecommendation($customerOrderRecommendation)
    {
        $this->customerOrderRecommendation = $customerOrderRecommendation;
    }

    /**
     * @return string
     */
    public function getCustomerOrderRecommendation()
    {
        return $this->customerOrderRecommendation;
    }
}
