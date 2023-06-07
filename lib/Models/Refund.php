<?php

namespace Signifyd\Models;

use Signifyd\Core\Model;
use Signifyd\Models\Fingerprint;

class Refund extends Model
{
    /**
     * The method by which the refund will be issued:
     *
     * @var string
     */
    public $method;

    /**
     * The total amount of the refund that you are going to give back to the buyer.
     * This amount may not exceed the original price in the Checkout or Sale call.
     *
     * @var float
     */
    public $amount;

    /**
     * The currency in which the amount is denominated.
     * If not included, we assume the same currency as the original purchase.
     *
     * @var string
     */
    public $currency;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'method',
        'amount',
        'currency'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'method' => [],
        'amount' => [],
        'currency' => []
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

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param $method
     * @return void
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param $amount
     * @return void
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return float
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param $currency
     * @return void
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }
}