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
use Signifyd\Models\Address;

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
     * The full name on the credit card that was charged
     *
     * @var string
     */
    public $holderName;

    /**
     * The first six digits of the credit card, the bank
     * identification number, which uniquely identifies the issuer.
     *
     * @var string
     */
    public $cardBin;

    /**
     * The last four digits of the card number.
     *
     * @var int
     */
    public $cardLast4;

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
     * The billing address for the card
     *
     * @var Address
     */
    public $billingAddress;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'holderName',
        'cardBin',
        'cardLast4',
        'cardExpiryMonth',
        'cardExpiryYear'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'holderName' => [],
        'cardBin' => [],
        'cardLast4' => [],
        'cardExpiryMonth' => [],
        'cardExpiryYear' => []
    ];

    /**
     * Card constructor.
     *
     * @param array $item The card data
     */
    public function __construct($item = [])
    {
        if (!empty($item) && is_array($item)) {
            foreach ($item as $field => $value) {
                if (!in_array($field, $this->fields)) {
                    continue;
                }

                $this->{'set' . ucfirst($field)}($value);
            }

            if (isset($item['billingAddress']) && !empty($item['billingAddress'])) {
                $billingAddress = new Address($item['billingAddress']);
                $this->setBillingAddress($billingAddress);
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
        //if (strlen($this->getcardLast4()) !== 4) {
        //    $valid[] = false;
        //}

        //TODO add code to validate the card
        return (!isset($valid[0]))? true : false;
    }

    /**
     * Get the name
     *
     * @return mixed
     */
    public function getHolderName()
    {
        return $this->holderName;
    }

    /**
     * Set the name
     *
     * @param mixed $holderName The card holder name
     *
     * @return void
     */
    public function setHolderName($holderName)
    {
        $this->holderName = $holderName;
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
