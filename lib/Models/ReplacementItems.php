<?php

namespace Signifyd\Models;

use Signifyd\Core\Model;

class ReplacementItems extends Model
{
    /**
     * A list of products that will be shipped to the buyer as replacements.
     *
     * @var array of Product
     */
    public $products = [];

    /**
     * Details about the delivery destinations and the products for each one.
     *
     * @var array of Shipment
     */
    public $shipments = [];

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'products',
        'shipments',
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'products' => [],
        'shipments' => [],
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

                if ($field == 'products') {
                    foreach ($value as $item) {
                        if ($item instanceof Product) {
                            $object = $item;
                        } else {
                            $object = new Product($item);
                        }

                        $this->addProduct($object);
                    }
                    continue;
                }

                if ($field == 'shipments') {
                    foreach ($value as $item) {
                        if ($item instanceof Shipment) {
                            $object = $item;
                        } else {
                            $object = new Shipment($item);
                        }

                        $this->addShipment($object);
                    }
                    continue;
                }
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

    /**
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param $products
     * @return void
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

    /**
     * @param $product
     * @return void
     */
    public function addProduct($product)
    {
        $this->products[] = $product;
    }

    /**
     * @return array
     */
    public function getShipments()
    {
        return $this->shipments;
    }

    /**
     * @param $shipments
     * @return void
     */
    public function setShipments($shipments)
    {
        $this->shipments = $shipments;
    }

    /**
     * @param $shipment
     * @return void
     */
    public function addShipment($shipment)
    {
        $this->shipments[] = $shipment;
    }
}