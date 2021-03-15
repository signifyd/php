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
    public $itemId;
    public $itemName;
    public $itemUrl;
    public $itemImage;
    public $itemQuantity;
    public $itemPrice;
    public $itemWeight;
    public $itemIsDigital;
    public $itemCategory;
    public $itemSubCategory;
    public $sellerAccountNumber;

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
        'sellerAccountNumber'
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
        'sellerAccountNumber' => []
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
     * @return mixed
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * Set the item id
     *
     * @param mixed $itemId The item Id
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
     * @return mixed
     */
    public function getItemName()
    {
        return $this->itemName;
    }

    /**
     * Set the item name
     *
     * @param mixed $itemName The item name
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
     * @return mixed
     */
    public function getItemImage()
    {
        return $this->itemImage;
    }

    /**
     * Set the item image
     *
     * @param mixed $itemImage The link of the item image
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
     * @return mixed
     */
    public function getItemQuantity()
    {
        return $this->itemQuantity;
    }

    /**
     * Set the item quantity
     *
     * @param mixed $itemQuantity The sold item quantity
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
     * @return mixed
     */
    public function getItemPrice()
    {
        return $this->itemPrice;
    }

    /**
     * Set the item price
     *
     * @param mixed $itemPrice The price of the item
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
     * @return mixed
     */
    public function getItemWeight()
    {
        return $this->itemWeight;
    }

    /**
     * Set the item weight
     *
     * @param mixed $itemWeight The weight of the sold item
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
     * @return mixed
     */
    public function getItemIsDigital()
    {
        return $this->itemIsDigital;
    }

    /**
     * Set the type of the item
     *
     * @param mixed $itemIsDigital If the item is digital or not
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
     * @return mixed
     */
    public function getItemCategory()
    {
        return $this->itemCategory;
    }

    /**
     * Set the item category
     *
     * @param mixed $itemCategory The category of the sold item
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
     * @return mixed
     */
    public function getItemSubCategory()
    {
        return $this->itemSubCategory;
    }

    /**
     * Set the item subcategory
     *
     * @param mixed $itemSubCategory The subcategory of the sold item
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
     * @return mixed
     */
    public function getItemUrl()
    {
        return $this->itemUrl;
    }

    /**
     * Set the item url
     *
     * @param mixed $itemUrl The url of the item
     *
     * @return void
     */
    public function setItemUrl($itemUrl)
    {
        $this->itemUrl = $itemUrl;
    }

    /**
     * Get the account number of the seller that sold the product.
     *
     * @return mixed
     */
    public function getSellerAccountNumber()
    {
        return $this->sellerAccountNumber;
    }

    /**
     * Set the account number of the seller that sold the product.
     *
     * @param $sellerAccountNumber
     */
    public function setSellerAccountNumber($sellerAccountNumber)
    {
        $this->sellerAccountNumber = $sellerAccountNumber;
    }
}
