<?php
/**
 * PaymentUpdate model for the Signifyd SDK
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
 * Class PaymentUpdate
 * Record class for updates to payment info
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class PaymentUpdate extends Model
{
    /**
     * The id of the case that we are updating
     *
     * @var string
     */
    public $caseId;

    /**
     * The gateway that processed the transaction.
     *
     * @var string
     */
    public $paymentGateway;

    /**
     * The unique identifier provided by the payment
     * gateway for this order. If you have provided
     * us with credentials for your payment gateway
     * we can obtain additional details about the order,
     * like AVS and CVV status, from your payment provider.
     *
     * @var string
     */
    public $transactionId;

    /**
     * The response code from the address verification system (AVS)
     *
     * @var string
     */
    public $avsResponseCode;

    /**
     * The response code from the card verification value (CVV) check
     *
     * @var string
     */
    public $cvvResponseCode;

    /**
     * Billing Address
     *
     * @var \Signifyd\Models\Address
     */
    public $billingAddress;

    /**
     * Delivery Address
     *
     * @var \Signifyd\Models\Address
     */
    public $deliveryAddress;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'caseId',
        'paymentGateway',
        'transactionId',
        'avsResponseCode',
        'cvvResponseCode'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'caseId' => [],
        'paymentGateway' => [],
        'transactionId' => [],
        'avsResponseCode' => [],
        'cvvResponseCode' => []
    ];

    /**
     * PaymentUpdate constructor.
     *
     * @param array $data The payment update data
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

            if (isset($data['billingAddress'])&& !empty($data['billingAddress'])) {
                $billingAddress = new Address($data['billingAddress']);
                $this->setBillingAddress($billingAddress);
            }

            if (isset($data['deliveryAddress'])&& !empty($data['deliveryAddress'])) {
                $deliveryAddress = new Address($data['deliveryAddress']);
                $this->setDeliveryAddress($deliveryAddress);
            }
        }
    }

    /**
     * Validate the payment update
     *
     * @return array|bool
     */
    public function validate()
    {
        $valid = [];
        // validate avs response code
        if (!$this->avsCvvValidate($this->getAvsResponseCode())) {
            $valid[] = 'Invalid AVS code';
        }

        // validate cvv response code
        if (!$this->avsCvvValidate($this->getCvvResponseCode())) {
            $valid[] = 'Invalid CVV code';
        }

        return (!isset($valid[0]))? true : $valid;
    }

    /**
     * Get the payment gateway
     *
     * @return string
     */
    public function getPaymentGateway()
    {
        return $this->paymentGateway;
    }

    /**
     * Set the payment gateway
     *
     * @param string $paymentGateway The payment gateway value
     *
     * @return void
     */
    public function setPaymentGateway($paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    /**
     * Get the transaction id
     *
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * Set the transaction id
     *
     * @param string $transactionId The transaction Id
     *
     * @return void
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    /**
     * Get the avs code
     *
     * @return string
     */
    public function getAvsResponseCode()
    {
        return $this->avsResponseCode;
    }

    /**
     * Set the avs code
     *
     * @param string $avsResponseCode The code from the payment gateway
     *
     * @return void
     */
    public function setAvsResponseCode($avsResponseCode)
    {
        $this->avsResponseCode = $avsResponseCode;
    }

    /**
     * Get the cvv code
     *
     * @return string
     */
    public function getCvvResponseCode()
    {
        return $this->cvvResponseCode;
    }

    /**
     * Set the cvv code
     *
     * @param string $cvvResponseCode The code from the payment gateway
     *
     * @return void
     */
    public function setCvvResponseCode($cvvResponseCode)
    {
        $this->cvvResponseCode = $cvvResponseCode;
    }

    /**
     * Set the case id
     *
     * @return mixed
     */
    public function getCaseId()
    {
        return $this->caseId;
    }

    /**
     * Get the case id
     *
     * @param mixed $caseId The id of the case
     *
     * @return void
     */
    public function setCaseId($caseId)
    {
        $this->caseId = $caseId;
    }

    /**
     * Get the billing address
     *
     * @return Address
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * Set the billing address
     *
     * @param Address $billingAddress The address
     *
     * @return void
     */
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;
    }

    /**
     * Get the delivery address
     *
     * @return Address
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * Set the delivery address
     *
     * @param Address $deliveryAddress The address
     *
     * @return void
     */
    public function setDeliveryAddress($deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
    }

}
