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
    public $cardHolderName;

    /**
     * The first six digits of the credit card, the bank
     * identification number, which uniquely identifies the issuer.
     *
     * @var string
     */
    public $bin;

    /**
     * The last four digits of the card number.
     *
     * @var int
     */
    public $last4;

    /**
     * MM representation of the expiration month of the card.
     *
     * @var int
     */
    public $expiryMonth;

    /**
     * The yyyy representation of the expiration year of the card.
     *
     * @var int
     */
    public $expiryYear;

    /**
     * The hash
     *
     * @var string The hash for the card
     */
    public $hash;

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
        'cardHolderName',
        'bin',
        'last4',
        'expiryMonth',
        'expiryYear',
        'hash'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'cardHolderName' => [],
        'bin' => [],
        'last4' => [],
        'expiryMonth' => [],
        'expiryYear' => [],
        'hash' => []
    ];

    /**
     * Card constructor.
     *
     * @param array $item The card data
     */
    public function __construct($item = [])
    {
        if (!empty($item)) {
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
//        if (strlen($this->getLast4()) !== 4) {
//            $valid[] = false;
//        }

        //TODO add code to validate the address
        return (!isset($valid[0]))? true : false;
    }

    /**
     * Get the name
     *
     * @return mixed
     */
    public function getCardHolderName()
    {
        return $this->cardHolderName;
    }

    /**
     * Set the name
     *
     * @param mixed $cardHolderName The card holder name
     *
     * @return void
     */
    public function setCardHolderName($cardHolderName)
    {
        $this->cardHolderName = $cardHolderName;
    }

    /**
     * Get the bin (first 6 digits of the card)
     *
     * @return mixed
     */
    public function getBin()
    {
        return $this->bin;
    }

    /**
     * Set the bin (first 6 digits of the card)
     *
     * @param mixed $bin The bin value
     *
     * @return void
     */
    public function setBin($bin)
    {
        $this->bin = $bin;
    }

    /**
     * Get the last 4 digits
     *
     * @return mixed
     */
    public function getLast4()
    {
        return $this->last4;
    }

    /**
     * Set the last 4 digits
     *
     * @param mixed $last4 The 4 digits
     *
     * @return void
     */
    public function setLast4($last4)
    {
        $this->last4 = $last4;
    }

    /**
     * Get the expiration year of the card
     *
     * @return mixed
     */
    public function getExpiryYear()
    {
        return $this->expiryYear;
    }

    /**
     * Set the expiration year of the card
     *
     * @param mixed $expiryYear The expiration year
     *
     * @return void
     */
    public function setExpiryYear($expiryYear)
    {
        $this->expiryYear = $expiryYear;
    }

    /**
     * Get the hash
     *
     * @return mixed
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set the hash
     *
     * @param mixed $hash The expiration month
     *
     * @return void
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
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
    public function getExpiryMonth()
    {
        return $this->expiryMonth;
    }

    /**
     * Get the expiration month of the card
     *
     * @param int $expiryMonth The expiration month of the card
     *
     * @return void
     */
    public function setExpiryMonth($expiryMonth)
    {
        $this->expiryMonth = $expiryMonth;
    }
}
