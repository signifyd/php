<?php
/**
 * Card model for the Signifyd SDK
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
 * Class Card
 * Credit card data. If the payment type is not CC, this ma not be used
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Card extends Model
{

    /**
     * The billing address for the card
     *
     * @var Address
     */
    public $billingAddress;

    /**
     * The full name of the account holder as provided during checkout.
     *
     * @var string
     */
    public $accountHolderName;

    /**
     * The unique taxpayer identifier for the account holder.
     * Due to legal restrictions, the only values currently accepted here are Brazilian CPF numbers.
     * All other values provided will be removed.
     *
     * @var string
     */
    public $accountHolderTaxId;

    /**
     * The country that issued the accountHolderTaxId.
     * Due to legal restrictions, the only value currently accepted here is BR.
     *
     * @var string
     */
    public $accountHolderTaxIdCountry;

    /**
     * The last 4 digits of the bank account number as provided during checkout.
     *
     * @var string
     */
    public $accountLast4;

    /**
     * The routing number (ABA) of the bank account that was used as provided during checkout.
     *
     * @var string
     */
    public $abaRoutingNumber;

    /**
     * A unique string value as provided by the cardTokenProvider
     * which replaces the card Primary Account Number (PAN).
     *
     * @var string
     */
    public $cardToken;

    /**
     * The issuer of the cardToken, that is, whomever generated the cardToken originally.
     *
     * @var string
     */
    public $cardTokenProvider;

    /**
     * The first six digits of the credit card, the bank
     * identification number, which uniquely identifies the issuer.
     *
     * @var string
     */
    public $cardBin;

    /**
     * MM representation of the expiration month of the card.
     *
     * @var int
     */
    public $cardExpiryMonth;

    /**
     * The yyyy representation of the expiration year of the card.
     *
     * @var int
     */
    public $cardExpiryYear;

    /**
     * The last four digits of the card number.
     *
     * @var string
     */
    public $cardLast4;

    /**
     * The name of the card brand, e.g. Visa or Mastercard.
     * Note, it is preferred that you provide a cardBin rather than providing this field directly.
     *
     * @var string
     */
    public $cardBrand;

    /**
     * The funding methodology of the card.
     * Note, it is preferred that you provide a cardBin rather than providing this field directly.
     *
     * @var string
     */
    public $cardFunding;

    /**
     * Details about the installment plan used to make the purchase.
     *
     * @var CardInstallments
     */
    public $cardInstallments;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'billingAddress',
        'accountHolderName',
        'accountHolderTaxId',
        'accountHolderTaxIdCountry',
        'accountLast4',
        'abaRoutingNumber',
        'cardToken',
        'cardTokenProvider',
        'cardBin',
        'cardExpiryMonth',
        'cardExpiryYear',
        'cardLast4',
        'cardBrand',
        'cardFunding',
        'cardInstallments',
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'billingAddress' => [],
        'accountHolderName' => [],
        'accountHolderTaxId' => [],
        'accountHolderTaxIdCountry' => [],
        'accountLast4' => [],
        'abaRoutingNumber' => [],
        'cardToken' => [],
        'cardTokenProvider' => [],
        'cardBin' => [],
        'cardExpiryMonth' => [],
        'cardExpiryYear' => [],
        'cardLast4' => [],
        'cardBrand' => [],
        'cardFunding' => [],
        'cardInstallments' => [],
    ];

    /**
     * Card constructor.
     */
    public function __construct($data = [])
    {
        if (!empty($data) && is_array($data)) {
            foreach ($data as $field => $value) {
                if (!in_array($field, $this->fields)) {
                    continue;
                }

                if ($field == 'billingAddress') {
                    if (isset($data['billingAddress'])) {
                        if ($data['billingAddress'] instanceof Address) {
                            $this->setBillingAddress($data['billingAddress']);
                        } else {
                            $billingAddress = new Address($data['billingAddress']);
                            $this->setBillingAddress($billingAddress);
                        }
                    }
                    continue;
                }

                if ($field == 'cardInstallments') {
                    if (isset($data['cardInstallments'])) {
                        if ($data['cardInstallments'] instanceof CardInstallments) {
                            $this->setCardInstallments($data['cardInstallments']);
                        } else {
                            $cardInstallments = new CardInstallments($data['cardInstallments']);
                            $this->setCardInstallments($cardInstallments);
                        }
                    }
                    continue;
                }

                $this->{'set' . ucfirst($field)}($value);
            }
        }
    }

    /**
     * Validate the card
     *
     * @return bool
     */
    public function validate()
    {
        $valid = [];

        //TODO add code to validate the card
        return (!isset($valid[0]))? true : false;
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
     * @param Address $billingAddress The address object
     *
     * @return void
     */
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;
    }

    public function getAccountHolderName()
    {
        return $this->accountHolderName;
    }

    public function setAccountHolderName($accountHolderName)
    {
        $this->accountHolderName = $accountHolderName;
    }

    public function getAccountHolderTaxId()
    {
        return $this->accountHolderTaxId;
    }

    public function setAccountHolderTaxId($accountHolderTaxId)
    {
        $this->accountHolderTaxId = $accountHolderTaxId;
    }

    public function getAccountHolderTaxIdCountry()
    {
        return $this->accountHolderTaxIdCountry;
    }

    public function setAccountHolderTaxIdCountry($accountHolderTaxIdCountry)
    {
        $this->accountHolderTaxIdCountry = $accountHolderTaxIdCountry;
    }

    public function getAccountLast4()
    {
        return $this->accountLast4;
    }

    public function setAccountLast4($accountLast4)
    {
        $this->accountLast4 = $accountLast4;
    }

    public function getAbaRoutingNumber()
    {
        return $this->abaRoutingNumber;
    }

    public function setAbaRoutingNumber($abaRoutingNumber)
    {
        $this->abaRoutingNumber = $abaRoutingNumber;
    }

    public function getCardToken()
    {
        return $this->cardToken;
    }

    public function setCardToken($cardToken)
    {
        $this->cardToken = $cardToken;
    }

    public function getCardTokenProvider()
    {
        return $this->cardTokenProvider;
    }

    public function setCardTokenProvider($cardTokenProvider)
    {
        $this->cardTokenProvider = $cardTokenProvider;
    }

    /**
     * Get the cardBin (first 6 digits of the card)
     *
     * @return mixed
     */
    public function getCardBin()
    {
        return $this->cardBin;
    }

    /**
     * Set the cardBin (first 6 digits of the card)
     *
     * @param mixed $cardBin The cardBin value
     *
     * @return void
     */
    public function setCardBin($cardBin)
    {
        $this->cardBin = $cardBin;
    }

    /**
     * Get the last 4 digits
     *
     * @return mixed
     */
    public function getCardLast4()
    {
        return $this->cardLast4;
    }

    /**
     * Set the last 4 digits
     *
     * @param mixed $cardLast4 The 4 digits
     *
     * @return void
     */
    public function setCardLast4($cardLast4)
    {
        $this->cardLast4 = $cardLast4;
    }

    public function getCardBrand()
    {
        return $this->cardBrand;
    }

    public function setCardBrand($cardBrand)
    {
        $this->cardBrand = $cardBrand;
    }

    public function getCardFunding()
    {
        return $this->cardFunding;
    }

    public function setCardFunding($cardFunding)
    {
        $this->cardFunding = $cardFunding;
    }

    public function getCardInstallments()
    {
        return $this->cardInstallments;
    }

    public function setCardInstallments($cardInstallments)
    {
        $this->cardInstallments = $cardInstallments;
    }

    /**
     * Get the expiration year of the card
     *
     * @return mixed
     */
    public function getCardExpiryYear()
    {
        return $this->cardExpiryYear;
    }

    /**
     * Set the expiration year of the card
     *
     * @param mixed $cardExpiryYear The expiration year
     *
     * @return void
     */
    public function setCardExpiryYear($cardExpiryYear)
    {
        $this->cardExpiryYear = $cardExpiryYear;
    }

    /**
     * Get the expiration month of the card
     *
     * @return int
     */
    public function getCardExpiryMonth()
    {
        return $this->cardExpiryMonth;
    }

    /**
     * Get the expiration month of the card
     *
     * @param int $cardExpiryMonth The expiration month of the card
     *
     * @return void
     */
    public function setCardExpiryMonth($cardExpiryMonth)
    {
        $this->cardExpiryMonth = $cardExpiryMonth;
    }
}
