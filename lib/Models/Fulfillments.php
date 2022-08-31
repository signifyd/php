<?php
/**
 * UserAccount model for the Signifyd SDK
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
 * Class Device
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Fulfillments extends Model
{
    /**
     * The id that uniquely identifies the order the shipment is for.
     * This should be the same orderId provided when created by Checkout or Sale event.
     *
     * @var string
     */
    public $orderId;

    /**
     * Statuses to indicate fulfillment state.
     *
     * @var string
     */
    public $fulfillmentStatus;

    /**
     * A list of fulfillments associated with an order.
     *
     * @var array of Fulfillment
     */
    public $fulfillments;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'orderId',
        'fulfillmentStatus',
        'fulfillments'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'orderId' => [],
        'fulfillmentStatus' => [],
        'fulfillments' => []
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

                if ($field == 'fulfillments') {
                    foreach ($value as $item) {
                        if ($item instanceof Fulfillment) {
                            $object = $item;
                        } else {
                            $object = new Fulfillment($item);
                        }

                        $this->addFulfillment($object);
                    }
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

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    public function getFulfillmentStatus()
    {
        return $this->fulfillmentStatus;
    }

    public function setFulfillmentStatus($fulfillmentStatus)
    {
        $this->fulfillmentStatus = $fulfillmentStatus;
    }

    public function getFulfillments()
    {
        return $this->fulfillments;
    }

    public function setFulfillments($fulfillments)
    {
        $this->fulfillments = $fulfillments;
    }

    public function addFulfillment($fulfillment)
    {
        $this->fulfillments[] = $fulfillment;
    }
}