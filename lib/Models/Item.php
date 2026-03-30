<?php
/**
 * PHP version 8.2
 *
 * @category  Signifyd_Fraud_Protection
 * @package   Signifyd\Core
 * @author    Signifyd <info@signifyd.com>
 * @copyright 2026 SIGNIFYD Inc. All rights reserved.
 * @license   See LICENSE.txt for license details.
 * @link      https://www.signifyd.com/
 */
namespace Signifyd\Models;

use Signifyd\Core\Model;
use Signifyd\Models\Subscription;

/**
 * Class Item
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Item extends Model
{
    /**
     * Type of post-sale action for the item.
     *
     * @var string
     */
    public string $requestedAction;

    /**
     * The reason that the buyer is making this post-sale action:
     *
     * @var string
     */
    public string $reason;

    /**
     * Further information on the reason that the buyer is making this post-sale action.
     * SubReasons should only be used alongside the relevant primary reason as laid out below:
     *
     * @var ?string
     */
    public ?string $subReason;

    /**
     * Timestamp of when the request was initiated. Defaults to current time if not provided.
     *
     * @var ?string
     */
    public ?string $requestedAt;

    /**
     * Unique identifier for a specific instance of an item within a post-sale action (e.g., return or exchange).
     * This is not the SKU — it's a per-item-level identifier that the merchant may assign when tracking
     * individual units (e.g., serialized inventory, barcoded units, etc.).
     *
     * @var ?string
     */
    public ?string $orderProductId;

    /**
     * The name of the product. If provided, can facilitate debugging and analytics.
     *
     * @var string
     */
    public string $itemName;

    /**
     * The price paid for each item (not the aggregate).
     *
     * @var float
     */
    public float $itemPrice;

    /**
     * The currency in which the itemPrice and all other amounts are denominated.
     * If omitted,the currency is assumed to be USD.
     *
     * @var ?string
     */
    public ?string $itemPriceCurrency;

    /**
     * Number of units of this item included in the post-sale action.
     *
     * @var float
     */
    public float $itemQuantity;

    /**
     * Unique identifier for the item. Must match the itemId from Checkout or Sale API.
     *
     * @var string
     */
    public string $itemId;

    /**
     * Unique identifier for the shipment. Must match the shipmentId used in the Fulfillment API.
     *
     * @var string
     */
    public string $shipmentId;

    /**
     * Indicates whether the item is electronically delivered, e.g., gift cards. If not provided, defaults to false.
     *
     * @var string
     */
    public string $itemIsDigital;

    /**
     * The name of the top-level product category, e.g., Apparel.
     *
     * @var string
     */
    public string $itemCategory;

    /**
     * The name of the sub-category of the product if applicable, e.g., T-Shirt.
     *
     * @var string
     */
    protected string $itemSubCategory;

    /**
     * The url to an image of the product.
     *
     * @var string
     */
    protected string $itemImage;

    /**
     * The url to the product's page on your site.
     *
     * @var string
     */
    protected string $itemUrl;

    /**
     * The weight of each item in grams.
     *
     * @var float
     */
    protected float $itemWeight;

    /**
     * If this product is being delivered as part of a subscription,
     * then you can include these fields to include data about the subscription itself.
     * The entire itemQuantity on this product should be purchased via the subscription.
     * If the buyer added extra items of the same product, those should be listed in separate product line item.
     *
     * @var Subscription
     */
    protected Subscription $subscription;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'requestedAction',
        'reason',
        'subReason',
        'orderProductId',
        'itemName',
        'itemPrice',
        'itemPriceCurrency',
        'itemQuantity',
        'itemId',
        'shipmentId',
        'itemIsDigital',
        'itemCategory',
        'itemSubCategory',
        'itemImage',
        'itemUrl',
        'itemWeight',
        'subscription'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'requestedAction' => [],
        'reason' => [],
        'subReason' => [],
        'orderProductId' => [],
        'itemName' => [],
        'itemPrice' => [],
        'itemPriceCurrency' => [],
        'itemQuantity' => [],
        'itemId' => [],
        'shipmentId' => [],
        'itemIsDigital' => [],
        'itemCategory' => [],
        'itemSubCategory' => [],
        'itemImage' => [],
        'itemUrl' => [],
        'itemWeight' => [],
        'subscription' => []
    ];

    /**
     * Item constructor.
     *
     * @param array $data The item data
     */
    public function __construct($data = [])
    {
        if (!empty($data) && is_array($data)) {
            foreach ($data as $field => $value) {
                if (!in_array($field, $this->fields)) {
                    continue;
                }

                $this->{'set' . ucfirst($field)}($value);
            }
        }
    }

    /**
     * Retrieve requested action
     *
     * @return string
     */
    public function getRequestedAction(): string
    {
        return $this->requestedAction;
    }

    /**
     * Set requested action
     *
     * @param string $requestedAction
     * @return void
     */
    public function setRequestedAction(string $requestedAction): void
    {
        $this->requestedAction = $requestedAction;
    }

    /**
     * Retrieve reason
     *
     * @return string
     */
    public function getReason(): string
    {
        return $this->reason;
    }

    /**
     * Set reason
     *
     * @param string $reason
     * @return void
     */
    public function setReason(string $reason): void
    {
        $this->reason = $reason;
    }

    /**
     * Retrieve sub reason
     *
     * @return string
     */
    public function getSubReason(): string
    {
        return $this->subReason;
    }

    /**
     * Set sub reason
     *
     * @param string $subReason
     * @return void
     */
    public function setSubReason(string $subReason): void
    {
        $this->subReason = $subReason;
    }

    /**
     * Retrieve order product id
     *
     * @return string
     */
    public function getOrderProductId(): string
    {
        return $this->orderProductId;
    }

    /**
     * Set order product id
     *
     * @param string $orderProductId
     * @return void
     */
    public function setOrderProductId(string $orderProductId): void
    {
        $this->orderProductId = $orderProductId;
    }

    /**
     * Retrieve item name
     *
     * @return string
     */
    public function getItemName(): string
    {
        return $this->itemName;
    }

    /**
     * Set requested action
     *
     * @param string $itemName
     * @return void
     */
    public function setItemName(string $itemName): void
    {
        $this->itemName = $itemName;
    }

    /**
     * Retrieve item price
     *
     * @return float
     */
    public function getItemPrice(): float
    {
        return $this->itemPrice;
    }

    /**
     * Set item price
     *
     * @param float $itemPrice
     * @return void
     */
    public function setItemPrice(float $itemPrice): void
    {
        $this->itemPrice = $itemPrice;
    }

    /**
     * Retrieve item price currency
     *
     * @return string
     */
    public function getItemPriceCurrency(): string
    {
        return $this->itemPriceCurrency;
    }

    /**
     * Set item price currency
     *
     * @param string $itemPriceCurrency
     * @return void
     */
    public function setItemPriceCurrency(string $itemPriceCurrency): void
    {
        $this->itemPriceCurrency = $itemPriceCurrency;
    }

    /**
     * Retrieve item quantity
     *
     * @return float
     */
    public function getItemQuantity(): float
    {
        return $this->itemQuantity;
    }

    /**
     * Set item quantity
     *
     * @param float $itemQuantity
     * @return void
     */
    public function setItemQuantity(float $itemQuantity): void
    {
        $this->itemQuantity = $itemQuantity;
    }

    /**
     * Retrieve item id
     *
     * @return string
     */
    public function getItemId(): string
    {
        return $this->itemId;
    }

    /**
     * Set item id
     *
     * @param string $itemId
     * @return void
     */
    public function setItemId(string $itemId): void
    {
        $this->itemId = $itemId;
    }

    /**
     * Retrieve shipment id
     *
     * @return string
     */
    public function getShipmentId(): string
    {
        return $this->shipmentId;
    }

    /**
     * Set shipment id
     *
     * @param string $shipmentId
     * @return void
     */
    public function setShipmentId(string $shipmentId): void
    {
        $this->shipmentId = $shipmentId;
    }

    /**
     * Retrieve if the item is digital
     *
     * @return bool
     */
    public function getItemIsDigital(): bool
    {
        return $this->itemIsDigital;
    }

    /**
     * Set if the item is digital
     *
     * @param bool $itemIsDigital
     * @return void
     */
    public function setItemIsDigital(bool $itemIsDigital): void
    {
        $this->itemIsDigital = $itemIsDigital;
    }

    /**
     * Retrieve item category
     *
     * @return string
     */
    public function getItemCategory(): string
    {
        return $this->itemCategory;
    }

    /**
     * Set item category
     *
     * @param string $itemCategory
     * @return void
     */
    public function setItemCategory(string $itemCategory): void
    {
        $this->itemCategory = $itemCategory;
    }

    /**
     * Retrieve item sub category
     *
     * @return string
     */
    public function getItemSubCategory(): string
    {
        return $this->itemSubCategory;
    }

    /**
     * Set item sub category
     *
     * @param string $itemSubCategory
     * @return void
     */
    public function setItemSubCategory(string $itemSubCategory): void
    {
        $this->itemSubCategory = $itemSubCategory;
    }

    /**
     * Retrieve item image
     *
     * @return string
     */
    public function getItemImage(): string
    {
        return $this->itemImage;
    }

    /**
     * Set item image
     *
     * @param string $itemImage
     * @return void
     */
    public function setItemImage(string $itemImage): void
    {
        $this->itemImage= $itemImage;
    }

    /**
     * Retrieve item url
     *
     * @return string
     */
    public function getItemUrl(): string
    {
        return $this->itemUrl;
    }

    /**
     * Set item url
     *
     * @param string $itemUrl
     * @return void
     */
    public function setItemUrl(string $itemUrl): void
    {
        $this->itemUrl = $itemUrl;
    }

    /**
     * Retrieve item weight
     *
     * @return float
     */
    public function getItemWeight(): float
    {
        return $this->itemWeight;
    }

    /**
     * Set item weight
     *
     * @param float $itemWeight
     * @return void
     */
    public function setItemWeight(float $itemWeight): void
    {
        $this->itemWeight= $itemWeight;
    }

    /**
     * Retrieve subscription
     *
     * @return Subscription
     */
    public function getSubscription(): Subscription
    {
        return $this->subscription;
    }

    /**
     * Set subscription
     *
     * @param Subscription $subscription
     * @return void
     */
    public function setSubscription(Subscription $subscription): void
    {
        $this->subscription = $subscription;
    }
}
