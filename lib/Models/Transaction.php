<?php

namespace Signifyd\Models;

use Signifyd\Core\Model;
use Signifyd\Models\Card;

class Transaction extends Model
{
    /**
     * Information about the payment method as submitted
     * by the purchaser during checkout.
     *
     * @var Card
     */
    public $checkoutPaymentDetails;

    /**
     * The response code from the address verification system (AVS).
     *
     * @var string
     */
    public $avsResponseCode;

    /**
     * The response code from the card verification value (CVV) check.
     *
     * @var string
     */
    public $cvvResponseCode;

    /**
     * The unique identifier provided by the payment gateway
     * for this order.
     *
     * @var string
     */
    public $transactionId;

    /**
     * The currency type of the payment,
     * in 3 letter ISO 4217 format.
     *
     * @var string
     */
    public $currency;

    /**
     * A positive integer representing how
     * much the payment method was charged.
     *
     * @var float
     */
    public $amount;

    /**
     * The type of transaction that was
     * processed by the payment provider.
     *
     * @var string
     */
    public $type;

    /**
     * The status as returned by the payment provider
     * when the transaction was submitted.
     *
     * @var string
     */
    public $gatewayStatusCode;

    /**
     * If the transaction resulted in an error or failure the enumerated reason the
     * transcaction failed as provided by the payment provider.
     *
     * @var string
     */
    public $gatewayErrorCode;

    /**
     * The gateway that processed the transaction.
     *
     * @var string
     */
    public $gateway;

    /**
     * The method the user used to complete the purchase.
     *
     * @var string
     */
    public $paymentMethod;

    /**
     * The date and time when the transaction was processed by the
     * payment provider. Formatted as yyyy-MM-dd'T'HH:mm:ssZ
     *
     * @var string
     */
    public $createdAt;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'avsResponseCode',
        'cvvResponseCode',
        'transactionId',
        'currency',
        'amount',
        'type',
        'gatewayStatusCode',
        'gatewayErrorCode',
        'gateway',
        'paymentMethod',
        'createdAt'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'avsResponseCode' => [],
        'cvvResponseCode' => [],
        'transactionId' => [],
        'currency' => [],
        'amount' => [],
        'type' => [],
        'gatewayStatusCode' => [],
        'gatewayErrorCode' => [],
        'gateway' => [],
        'paymentMethod' => [],
        'createdAt' => []
    ];

    /**
     * Transactions constructor.
     *
     * @param array $data The transactions data
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

            if (isset($data['checkoutPaymentDetails']) && !empty($data['checkoutPaymentDetails'])) {
                $checkoutPaymentDetails = new Card($data['checkoutPaymentDetails']);
                $this->setCheckoutPaymentDetails($checkoutPaymentDetails);
            }
        }
    }

    /**
     * Validate the Transactions
     *
     * @return array|bool
     */
    public function validate()
    {
        $valid = [];

        $allowedMethods = [
            "ach", "ali_pay", "apple_pay", "amazon_payments", "android_pay",
            "bitcoin", "cash", "check", "credit_card", "free", "google_pay",
            "loan", "paypal_account", "reward_points", "store_credit",
            "samsung_pay", "visa_checkout"
        ];
        $validMethod = $this->enumValid($this->getPaymentMethod(), $allowedMethods);
        if (false === $validMethod) {
            $valid[] = 'Invalid payment method';
        }

        // validate avs response code
        if (!$this->avsCvvValidate($this->getAvsResponseCode())) {
            $valid[] = 'Invalid AVS code';
        }

        // validate cvv response code
        if (!$this->avsCvvValidate($this->getCvvResponseCode())) {
            $valid[] = 'Invalid CVV code';
        }

        $allowedType = [
            "preauthorization", "authorization", "sale"
        ];
        $validType = $this->enumValid($this->getType(), $allowedType);
        if (false === $validType) {
            $valid[] = 'Invalid Type';
        }

        $allowedGatewayStatusCode = [
            "success", "pending", "failure", "error"
        ];
        $validGatewayStatusCode = $this->enumValid($this->getGatewayStatusCode(), $allowedGatewayStatusCode);

        if (false === $validGatewayStatusCode) {
            $valid[] = 'Invalid Gateway Status Code';
        }

        $allowedGatewayErrorCode = [
            "CARD_DECLINED", "CALL_ISSUER", "EXPIRED_CARD", "FRAUD_DECLINE", "INCORRECT_NUMBER", "INVALID_NUMBER",
            "INVALID_EXPIRY_DATE", "INVALID_CVC", "INCORRECT_CVC", "INCORRECT_ZIP", "INCORRECT_ADDRESS",
            "INSUFFICIENT_FUNDS", "PROCESSING_ERROR", "PICK_UP_CARD", "RESTRICTED_CARD", "STOLEN_CARD",
            "TEST_CARD_DECLINE"
        ];
        $validGatewayErrorCode = $this->enumValid($this->getGatewayErrorCode(), $allowedGatewayErrorCode);

        if (false === $validGatewayErrorCode) {
            $valid[] = 'Invalid Gateway Error Code';
        }

        return (isset($valid[0]))? $valid : true;
    }

    /**
     * Information about the payment method
     *
     * @return Card
     */
    public function getCheckoutPaymentDetails()
    {
        return $this->checkoutPaymentDetails;
    }

    /**
     * set the checkoutPaymentDetails
     *
     * @param $checkoutPaymentDetails
     *
     * @return void
     */
    public function setCheckoutPaymentDetails($checkoutPaymentDetails)
    {
        $this->checkoutPaymentDetails = $checkoutPaymentDetails;
    }

    /**
     * Get the AVS code
     *
     * @return mixed
     */
    public function getAvsResponseCode()
    {
        return $this->avsResponseCode;
    }

    /**
     * Set the AVS code
     *
     * @param mixed $avsResponseCode Code received from gateway
     *
     * @return void
     */
    public function setAvsResponseCode($avsResponseCode)
    {
        $this->avsResponseCode = $avsResponseCode;
    }

    /**
     * Get the CVV code
     *
     * @return mixed
     */
    public function getCvvResponseCode()
    {
        return $this->cvvResponseCode;
    }

    /**
     * Set the CVV code
     *
     * @param mixed $cvvResponseCode Code received from gateway
     *
     * @return void
     */
    public function setCvvResponseCode($cvvResponseCode)
    {
        $this->cvvResponseCode = $cvvResponseCode;
    }

    /**
     * Get the transaction id
     *
     * @return mixed
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * Set the transaction id
     *
     * @param mixed $transactionId Id received from gateway
     *
     * @return void
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    /**
     * Get the currency type of the payment
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set the currency type
     *
     * @param $currency
     *
     * @return void
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * Get the amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the amount
     *
     * @param $amount
     *
     * @return void
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Get the type of transaction
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the type of transaction
     *
     * @param $type
     *
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get the status as returned
     * by the payment provider
     *
     * @return string
     */
    public function getGatewayStatusCode()
    {
        return $this->gatewayStatusCode;
    }

    /**
     * Set the gateway status code
     *
     * @param $gatewayStatusCode
     *
     * @return void
     */
    public function setGatewayStatusCode($gatewayStatusCode)
    {
        $this->gatewayStatusCode = $gatewayStatusCode;
    }

    /**
     * Get the error as returned
     * by the payment provider
     *
     * @return string
     */
    public function getGatewayErrorCode()
    {
        return $this->gatewayErrorCode;
    }

    /**
     * Set the gateway error code
     *
     * @param $gatewayErrorCode
     *
     * @return void
     */
    public function setGatewayErrorCode($gatewayErrorCode)
    {
        $this->gatewayErrorCode = $gatewayErrorCode;
    }

    /**
     * Get the payment gateway
     *
     * @return mixed
     */
    public function getGateway()
    {
        return $this->gateway;
    }

    /**
     * Set the payment gateway
     *
     * @param mixed $gateway The name of payment gateway
     *
     * @return void
     */
    public function setGateway($gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * Get the payment method
     *
     * @return mixed
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * Set the payment method
     *
     * @param mixed $paymentMethod The payment method name
     *
     * @return void
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * Get the transaction creation date
     *
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the transaction creation date
     *
     * @param mixed $createdAt The create date
     *
     * @return void
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
}