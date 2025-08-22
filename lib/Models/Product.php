<?php
/**
 * Product model for the Signifyd SDK
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

use Signifyd\Core\Model;

/**
 * Class Product
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Product extends Model
{
    /**
     * The name of the product.
     *
     * @var string
     */
    public $itemName;

    /**
     * The price paid for each item (not the aggregate).
     *
     * @var float
     */
    public $itemPrice;

    /**
     * The quantity of this item.
     *
     * @var float
     */
    public $itemQuantity;

    /**
     * Indicates whether the item is electronically delivered e.g. gift cards.
     * If not provided, defaults to false.
     *
     * @var bool
     */
    public $itemIsDigital;

    /**
     * The name of the top-level product category. e.g. Apparel
     *
     * @var string
     */
    public $itemCategory;

    /**
     * The name of the sub-category of the product if applicable. e.g. T-Shirt
     *
     * @var string
     */
    public $itemSubCategory;

    /**
     * Your unique identifier for the product.
     *
     * @var string
     */
    public $itemId;

    /**
     * The url to an image of the product.
     *
     * @var string
     */
    public $itemImage;

    /**
     * The url to the product's page on your site.
     *
     * @var string
     */
    public $itemUrl;

    /**
     * The weight of each item in grams.
     *
     * @var float
     */
    public $itemWeight;

    /**
     * The item's shipment id.
     *
     * @var string
     */
    public $shipmentId;

    /**
     * If this product is being delivered as part of a subscription,
     * then you can include these fields to include data about the subscription itself.
     *
     * @var Subscription
     */
    public $subscription;

    /**
     * Personalized message included with the gift order.
     *
     * @var string
     */
    public $giftMessage;

    /**
     * Identifier linking the order to a specific gift registry.
     *
     * @var string
     */
    public $registryId;

    protected $fields = [
        'itemId',
        'itemName',
        'itemUrl',
        'itemImage',
        'itemQuantity',
        'itemPrice',
        'itemWeight',
        'itemIsDigital',
        'itemCategory',
        'itemSubCategory',
        'shipmentId',
        'subscription',
        'giftMessage',
        'registryId'
    ];

    protected $fieldsValidation = [
        'itemId' => [],
        'itemName' => [],
        'itemUrl' => [],
        'itemImage' => [],
        'itemQuantity' => [],
        'itemPrice' => [],
        'itemWeight' => [],
        'itemIsDigital' => [],
        'itemCategory' => [],
        'itemSubCategory' => [],
        'shipmentId' => [],
        'subscription' => [],
        'giftMessage' => [],
        'registryId' => []
    ];

    /**
     * Product constructor.
     *
     * @param array $item The product data
     */
    public function __construct($item = [])
    {
        if (!empty($item) && is_array($item)) {
            foreach ($item as $field => $value) {
                if (!in_array($field, $this->fields)) {
                    continue;
                }

                if ($field == 'subscription') {
                    if (isset($data['subscription'])) {
                        if ($data['subscription'] instanceof \Signifyd\Models\Subscription) {
                            $this->setSubscription($data['subscription']);
                        } else {
                            $subscription = new \Signifyd\Models\Subscription($data['subscription']);
                            $this->setSubscription($subscription);
                        }
                    }
                    continue;
                }

                $this->{'set' . ucfirst($field)}($value);
            }
        }
    }

    /**
     * Validate the data of the product
     *
     * @return bool
     */
    public function validate()
    {
        $valid = [];

        //TODO add code to validate product data
        return (!isset($valid[0]))? true : false;
    }

    /**
     * Get the item id
     *
     * @return string
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * Set the item id
     *
     * @param string $itemId The item Id
     *
     * @return void
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
    }

    /**
     * Get the item name
     *
     * @return string
     */
    public function getItemName()
    {
        return $this->itemName;
    }

    /**
     * Set the item name
     *
     * @param string $itemName The item name
     *
     * @return void
     */
    public function setItemName($itemName)
    {
        $this->itemName = $itemName;
    }

    /**
     * Get the item image
     *
     * @return string
     */
    public function getItemImage()
    {
        return $this->itemImage;
    }

    /**
     * Set the item image
     *
     * @param string $itemImage The link of the item image
     *
     * @return void
     */
    public function setItemImage($itemImage)
    {
        $this->itemImage = $itemImage;
    }

    /**
     * Get the item quantity
     *
     * @return float
     */
    public function getItemQuantity()
    {
        return $this->itemQuantity;
    }

    /**
     * Set the item quantity
     *
     * @param float $itemQuantity The sold item quantity
     *
     * @return void
     */
    public function setItemQuantity($itemQuantity)
    {
        $this->itemQuantity = $itemQuantity;
    }

    /**
     * Get the item price
     *
     * @return float
     */
    public function getItemPrice()
    {
        return $this->itemPrice;
    }

    /**
     * Set the item price
     *
     * @param float $itemPrice The price of the item
     *
     * @return void
     */
    public function setItemPrice($itemPrice)
    {
        $this->itemPrice = $itemPrice;
    }

    /**
     * Get the item weight
     *
     * @return float
     */
    public function getItemWeight()
    {
        return $this->itemWeight;
    }

    /**
     * Set the item weight
     *
     * @param float $itemWeight The weight of the sold item
     *
     * @return void
     */
    public function setItemWeight($itemWeight)
    {
        $this->itemWeight = $itemWeight;
    }

    /**
     * Is the item digital
     *
     * @return bool
     */
    public function getItemIsDigital()
    {
        return $this->itemIsDigital;
    }

    /**
     * Set the type of the item
     *
     * @param bool $itemIsDigital If the item is digital or not
     *
     * @return void
     */
    public function setItemIsDigital($itemIsDigital)
    {
        $this->itemIsDigital = $itemIsDigital;
    }

    /**
     * Get the item category
     *
     * @return string
     */
    public function getItemCategory()
    {
        return $this->itemCategory;
    }

    /**
     * Set the item category
     *
     * @param string $itemCategory The category of the sold item
     *
     * @return void
     */
    public function setItemCategory($itemCategory)
    {
        $this->itemCategory = $itemCategory;
    }

    /**
     * Get the item subcategory
     *
     * @return string
     */
    public function getItemSubCategory()
    {
        return $this->itemSubCategory;
    }

    /**
     * Set the item subcategory
     *
     * @param string $itemSubCategory The subcategory of the sold item
     *
     * @return void
     */
    public function setItemSubCategory($itemSubCategory)
    {
        $this->itemSubCategory = $itemSubCategory;
    }

    /**
     * Get the item url
     *
     * @return string
     */
    public function getItemUrl()
    {
        return $this->itemUrl;
    }

    /**
     * Set the item url
     *
     * @param string $itemUrl The url of the item
     *
     * @return void
     */
    public function setItemUrl($itemUrl)
    {
        $this->itemUrl = $itemUrl;
    }

    /**
     * @return string
     */
    public function getShipmentId()
    {
        return $this->shipmentId;
    }

    /**
     * @param $shipmentId
     * @return void
     */
    public function setShipmentId($shipmentId)
    {
        $this->shipmentId = $shipmentId;
    }

    /**
     * @return string
     */
    public function getGiftMessage()
    {
        return $this->giftMessage;
    }

    /**
     * @param $giftMessage
     * @return void
     */
    public function setGiftMessage($giftMessage)
    {
        $this->giftMessage = $giftMessage;
    }

    /**
     * @return string
     */
    public function getRegistryId()
    {
        return $this->registryId;
    }

    /**
     * @param $registryId
     * @return void
     */
    public function setRegistryId($registryId)
    {
        $this->registryId = $registryId;
    }

    /**
     * @return Subscription
     */
    public function getSubscription()
    {
        return $this->subscription;
    }

    /**
     * @param $subscription
     * @return void
     */
    public function setSubscription($subscription)
    {
        $this->subscription = $subscription;
    }
}
