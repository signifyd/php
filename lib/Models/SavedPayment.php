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
 * Class SavedPayment
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class SavedPayment extends Model
{
    /**
     * The date this payment information was last updated or verified. Formatted as yyyy-MM-dd'T'HH:mm:ssZ.
     * See the dates section of the Introduction for more information about date formats.
     *
     * @var string
     */
    public $date;

    /**
     * The name of the Payment Method saved to the Account.
     *
     * @var string
     */
    public $paymentMethod;

    /**
     * The payment details for saved payment
     *
     * @var Card
     */
    public $paymentDetails;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'date',
        'paymentMethod',
        'paymentDetails'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'date' => [],
        'paymentMethod' => [],
        'paymentDetails' => []
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

                if ($field == 'paymentDetails') {
                    if (isset($data['paymentDetails'])) {
                        if ($data['paymentDetails'] instanceof Card) {
                            $this->setPaymentDetails($data['paymentDetails']);
                        } else {
                            $paymentDetails = new Card($data['paymentDetails']);
                            $this->setPaymentDetails($paymentDetails);
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

        //TODO add code to validate the savedPayment
        return (!isset($valid[0]))? true : false;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param $date
     * @return void
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return Card
     */
    public function getPaymentDetails()
    {
        return $this->paymentDetails;
    }

    /**
     * @param $paymentDetails
     * @return void
     */
    public function setPaymentDetails($paymentDetails)
    {
        $this->paymentDetails = $paymentDetails;
    }

    /**
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @param $paymentMethod
     * @return void
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }
}