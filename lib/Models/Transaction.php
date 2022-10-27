<?php

namespace Signifyd\Models;

use Signifyd\Core\Model;
use Signifyd\Models\Card;

class Transaction extends Model
{

    /**
     * The unique identifier provided by the payment gateway
     * for this order.
     *
     * @var string
     */
    public $transactionId;

    /**
     * The status as returned by the payment provider
     * when the transaction was submitted.
     *
     * @var string
     */
    public $gatewayStatusCode;

    /**
     * The method the user used to complete the purchase.
     *
     * @var string
     */
    public $paymentMethod;

    /**
     * Information about the payment method as submitted
     * by the purchaser during checkout.
     *
     * @var Card
     */
    public $checkoutPaymentDetails;

    /**
     * A positive integer representing how
     * much the payment method was charged.
     *
     * @var float
     */
    public $amount;

    /**
     * The currency type of the payment,
     * in 3 letter ISO 4217 format.
     *
     * @var string
     */
    public $currency;

    /**
     * The gateway that processed the transaction.
     *
     * @var string
     */
    public $gateway;

    /**
     * These are details about the Payment Instrument
     * that are sourced directly from the institution
     * that manages that instrument, the issuing bank for example.
     *
     * @var \Signifyd\Models\SourceAccountDetails
     */
    public $sourceAccountDetails;

    /**
     * Details about the merchant's acquiring bank.
     *
     * @var \Signifyd\Models\AcquirerDetails
     */
    public $acquirerDetails;

    /**
     * If the transaction resulted in an error or failure the enumerated reason the
     * transcaction failed as provided by the payment provider.
     *
     * @var string
     */
    public $gatewayErrorCode;

    /**
     * Additional information provided by the payment provider
     * describing why the transaction succeeded or failed.
     *
     * @var string
     */
    public $gatewayStatusMessage;

    /**
     * The date and time when the transaction was processed by the
     * payment provider. Formatted as yyyy-MM-dd'T'HH:mm:ssZ
     *
     * @var string
     */
    public $createdAt;

    /**
     * If there was a previous transaction for the payment
     * like a partial AUTHORIZATION or SALE,
     * the parent id should include the originating transaction id.
     *
     * @var string
     */
    public $parentTransactionId;

    /**
     * The SCA exemption that was requested by the merchant.
     *
     * @var string
     */
    public $scaExemptionRequested;

    /**
     * @var string
     */
    public $paypalPendingReasonCode;

    /**
     * @var string
     */
    public $paypalProtectionEligibility;

    /**
     * @var string
     */
    public $paypalProtectionEligibilityType;

    /**
     * AvsCvvVerification (object) or DecomposedAvsCvvVerification
     *
     * @var \Signifyd\Models\Verifications
     */
    public $verifications;

    /**
     * These are details about the result of the 3D Secure authentication
     *
     * @var \Signifyd\Models\ThreeDsResult
     */
    public $threeDsResult;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'transactionId',
        'gatewayStatusCode',
        'paymentMethod',
        'checkoutPaymentDetails',
        'amount',
        'currency',
        'gateway',
        'sourceAccountDetails',
        'acquirerDetails',
        'gatewayErrorCode',
        'gatewayStatusMessage',
        'createdAt',
        'parentTransactionId',
        'scaExemptionRequested',
        'paypalPendingReasonCode',
        'paypalProtectionEligibility',
        'paypalProtectionEligibilityType',
        'verifications',
        'threeDsResult',
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'transactionId' => [],
        'gatewayStatusCode' => [],
        'paymentMethod' => [],
        'checkoutPaymentDetails' => [],
        'amount' => [],
        'currency' => [],
        'gateway' => [],
        'sourceAccountDetails' => [],
        'acquirerDetails' => [],
        'gatewayErrorCode' => [],
        'gatewayStatusMessage' => [],
        'createdAt' => [],
        'parentTransactionId' => [],
        'scaExemptionRequested' => [],
        'paypalPendingReasonCode' => [],
        'paypalProtectionEligibility' => [],
        'paypalProtectionEligibilityType' => [],
        'verifications' => [],
        'threeDsResult' => [],
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
                // init the class name
                $class = '\Signifyd\Models\\' . ucfirst($field);

                if ($field == 'checkoutPaymentDetails') {
                    $class = '\Signifyd\Models\\Card';
                }

                if (!in_array($field, $this->fields)) {
                    continue;
                }

                if (is_array($data[$field]) && !empty($data[$field])) {
                    // instantiate the class
                    $object = new $class($data[$field]);
                    $this->{'set' . ucfirst($field)}($object);
                } else {
                    $this->{'set' . ucfirst($field)}($data[$field]);
                }
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
            "CREDIT_CARD", "GIFT_CARD", "DEBIT_CARD", "PREPAID_CARD", "SNAP_CARD",
        ];
        $validMethod = $this->enumValid($this->getPaymentMethod(), $allowedMethods);
        if (false === $validMethod) {
            $valid[] = 'Invalid payment method';
        }

        $allowedGatewayStatusCode = [
            "SUCCESS", "PENDING", "FAILURE", "ERROR",  "CANCELLED", "EXPIRED", "SOFTDECLINE"
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

    /**
     * @return SourceAccountDetails
     */
    public function getSourceAccountDetails()
    {
        return $this->sourceAccountDetails;
    }

    /**
     * @param $sourceAccountDetails
     * @return void
     */
    public function setSourceAccountDetails($sourceAccountDetails)
    {
        $this->sourceAccountDetails = $sourceAccountDetails;
    }

    /**
     * @return AcquirerDetails
     */
    public function getAcquirerDetails()
    {
        return $this->acquirerDetails;
    }

    /**
     * @param $acquirerDetails
     * @return void
     */
    public function setAcquirerDetails($acquirerDetails)
    {
        $this->acquirerDetails = $acquirerDetails;
    }

    /**
     * @return string
     */
    public function getGatewayStatusMessage()
    {
        return $this->gatewayStatusMessage;
    }

    /**
     * @param $gatewayStatusMessage
     * @return void
     */
    public function setGatewayStatusMessage($gatewayStatusMessage)
    {
        $this->gatewayStatusMessage = $gatewayStatusMessage;
    }

    /**
     * @return string
     */
    public function getParentTransactionId()
    {
        return $this->parentTransactionId;
    }

    /**
     * @param $parentTransactionId
     * @return void
     */
    public function setParentTransactionId($parentTransactionId)
    {
        $this->parentTransactionId = $parentTransactionId;
    }

    /**
     * @return string
     */
    public function getScaExemptionRequested()
    {
        return $this->scaExemptionRequested;
    }

    /**
     * @param $scaExemptionRequested
     * @return void
     */
    public function setScaExemptionRequested($scaExemptionRequested)
    {
        $this->scaExemptionRequested = $scaExemptionRequested;
    }

    /**
     * @return string
     */
    public function getPaypalPendingReasonCode()
    {
        return $this->paypalPendingReasonCode;
    }

    /**
     * @param $paypalPendingReasonCode
     * @return void
     */
    public function setPaypalPendingReasonCode($paypalPendingReasonCode)
    {
        $this->paypalPendingReasonCode = $paypalPendingReasonCode;
    }

    /**
     * @return string
     */
    public function getPaypalProtectionEligibility()
    {
        return $this->paypalProtectionEligibility;
    }

    /**
     * @param $paypalProtectionEligibility
     * @return void
     */
    public function setPaypalProtectionEligibility($paypalProtectionEligibility)
    {
        $this->paypalProtectionEligibility = $paypalProtectionEligibility;
    }

    /**
     * @return string
     */
    public function getPaypalProtectionEligibilityType()
    {
        return $this->paypalProtectionEligibilityType;
    }

    /**
     * @param $paypalProtectionEligibilityType
     * @return void
     */
    public function setPaypalProtectionEligibilityType($paypalProtectionEligibilityType)
    {
        $this->paypalProtectionEligibilityType = $paypalProtectionEligibilityType;
    }

    /**
     * @return Verifications
     */
    public function getVerifications()
    {
        return $this->verifications;
    }

    /**
     * @param $verifications
     * @return void
     */
    public function setVerifications($verifications)
    {
        $this->verifications = $verifications;
    }

    /**
     * @return ThreeDsResult
     */
    public function getThreeDsResult()
    {
        return $this->threeDsResult;
    }

    /**
     * @param $threeDsResult
     * @return void
     */
    public function setThreeDsResult($threeDsResult)
    {
        $this->threeDsResult = $threeDsResult;
    }
}