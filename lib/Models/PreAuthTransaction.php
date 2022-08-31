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
 * Class PreAuthTransaction
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class PreAuthTransaction extends Model
{
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
     * @var SourceAccountDetails
     */
    public $sourceAccountDetails;

    /**
     * Details about the merchant's acquiring bank.
     *
     * @var AcquirerDetails
     */
    public $acquirerDetails;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'paymentMethod',
        'checkoutPaymentDetails',
        'amount',
        'currency',
        'gateway',
        'sourceAccountDetails',
        'acquirerDetails'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'paymentMethod' => [],
        'checkoutPaymentDetails' => [],
        'amount' => [],
        'currency' => [],
        'gateway' => [],
        'sourceAccountDetails' => [],
        'acquirerDetails' => []
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

                if ($field == 'checkoutPaymentDetails') {
                    if (isset($data['checkoutPaymentDetails'])) {
                        if ($data['checkoutPaymentDetails'] instanceof Card) {
                            $this->setCheckoutPaymentDetails($data['checkoutPaymentDetails']);
                        } else {
                            $checkoutPaymentDetails = new Card($data['checkoutPaymentDetails']);
                            $this->setCheckoutPaymentDetails($checkoutPaymentDetails);
                        }
                    }
                    continue;
                }

                if ($field == 'sourceAccountDetails') {
                    if (isset($data['sourceAccountDetails'])) {
                        if ($data['sourceAccountDetails'] instanceof SourceAccountDetails) {
                            $this->setSourceAccountDetails($data['sourceAccountDetails']);
                        } else {
                            $sourceAccountDetails = new SourceAccountDetails($data['sourceAccountDetails']);
                            $this->setSourceAccountDetails($sourceAccountDetails);
                        }
                    }
                    continue;
                }

                if ($field == 'acquirerDetails') {
                    if (isset($data['acquirerDetails'])) {
                        if ($data['acquirerDetails'] instanceof AcquirerDetails) {
                            $this->setAcquirerDetails($data['acquirerDetails']);
                        } else {
                            $acquirerDetails = new AcquirerDetails($data['acquirerDetails']);
                            $this->setAcquirerDetails($acquirerDetails);
                        }
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

    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function getCheckoutPaymentDetails()
    {
        return $this->checkoutPaymentDetails;
    }

    public function setCheckoutPaymentDetails($checkoutPaymentDetails)
    {
        $this->checkoutPaymentDetails = $checkoutPaymentDetails;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    public function getGateway()
    {
        return $this->gateway;
    }

    public function setGateway($gateway)
    {
        $this->gateway = $gateway;
    }

    public function getSourceAccountDetails()
    {
        return $this->sourceAccountDetails;
    }

    public function setSourceAccountDetails($sourceAccountDetails)
    {
        $this->sourceAccountDetails = $sourceAccountDetails;
    }

    public function getAcquirerDetails()
    {
        return $this->acquirerDetails;
    }

    public function setAcquirerDetails($acquirerDetails)
    {
        $this->acquirerDetails = $acquirerDetails;
    }
}