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
 * Class CheckoutTransaction
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class CheckoutTransaction extends Model
{
    /**
     * Unique identifier for a checkout.
     * This id is used to link these transactions with the original Record Checkout event.
     * It must be supplied to ensure proper linking.
     *
     * @var string
     */
    public $checkoutId;
    /**
     * Unique identifier for an Order.
     * This is required to link this transaction to the original Order created by the Checkout event.
     *
     * @var string
     */
    public $orderId;

    /**
     * Details about the delivery destinations and the products for each one.
     *
     * @var array of Transaction
     */
    public $transactions = [];

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'checkoutId',
        'orderId',
        'transactions',
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'checkoutId' => [],
        'orderId' => [],
        'transactions' => [],
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

                if ($field == 'transactions') {
                    foreach ($value as $item) {
                        if ($item instanceof Transaction) {
                            $object = $item;
                        } else {
                            $object = new Transaction($item);
                        }

                        $this->addTransaction($object);
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

    public function getCheckoutId()
    {
        return $this->checkoutId;
    }

    public function setCheckoutId($checkoutId)
    {
        $this->checkoutId = $checkoutId;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    public function getTransactions()
    {
        return $this->transactions;
    }

    public function setTransactions($transactions)
    {
        $this->transactions = $transactions;
    }

    public function addTransaction($transaction)
    {
        $this->transactions[] = $transaction;
    }
}