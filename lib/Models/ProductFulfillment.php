<?php

namespace Signifyd\Models;

use Signifyd\Core\Model;

/**
 * Class ProductFulfillment
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class ProductFulfillment extends Model
{
    /**
     * The name of the product.
     *
     * @var string
     */
    public $itemName;

    /**
     * The quantity of this item.
     *
     * @var float
     */
    public $itemQuantity;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'itemName',
        'itemQuantity'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'itemName' => [],
        'itemQuantity' => []
    ];

    /**
     * UserAccount constructor.
     *
     * @param array $data The user account data
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
     * Validate the user account
     *
     * @return bool
     */
    public function validate()
    {
        $valid = [];

        //TODO add code to validate the user account
        return (!isset($valid[0]))? true : false;
    }

    public function getItemName()
    {
        return $this->itemName;
    }

    public function setItemName($itemName)
    {
        $this->itemName = $itemName;
    }

    public function getItemQuantity()
    {
        return $this->itemQuantity;
    }

    public function setItemQuantity($itemQuantity)
    {
        $this->itemQuantity = $itemQuantity;
    }
}