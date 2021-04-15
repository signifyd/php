<?php

namespace Signifyd\Models;

use Signifyd\Core\Model;

class DecisionRequest extends Model
{
    /**
     * Type of prediction being requested for the payment fraud use case.
     *
     * @var string
     */
    public $paymentFraud;

    protected $fields = [
      'paymentFraud'
    ];

    protected $fieldsValidation = [
        'paymentFraud' => []
    ];

    public function __construct($data = [])
    {
        if (is_array($data) && !empty($data)) {
            foreach ($data as $field => $value) {
                if (!in_array($field, $this->fields)) {
                    continue;
                }

                $this->{'set' . ucfirst($field)}($value);
            }
        }
    }

    /**
     * Validate the decision request
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
    public function getPaymentFraud()
    {
        return $this->paymentFraud;
    }

    /**
     * @param string $paymentFraud
     */
    public function setPaymentFraud(string $paymentFraud)
    {
        $this->paymentFraud = $paymentFraud;
    }


}
