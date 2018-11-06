<?php
/**
 * DiscountCode model for the Signifyd SDK
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
 * Class DiscountCode
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class DiscountCode extends Model
{
    public $code;
    public $amount;
    public $percentage;

    protected $fields = [
        'code',
        'amount',
        'percentage'
    ];

    protected $fieldsValidation = [
        'code' => [],
        'amount' => [],
        'percentage' => []
    ];

    /**
     * DiscountCode constructor.
     *
     * @param array $item The discount code data
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
        }
    }

    /**
     * Validate the discount code data
     *
     * @return bool
     */
    public function validate()
    {
        //TODO add code to validate the discount
        return true;
    }

    /**
     * Get the discount code
     *
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the discount code
     *
     * @param mixed $code The discount code
     *
     * @return void
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * Get the discount amount
     *
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the discount amount
     *
     * @param mixed $amount The amount of the discount
     *
     * @return void
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Get the discount percentage
     *
     * @return mixed
     */
    public function getPercentage()
    {
        return $this->percentage;
    }

    /**
     * Set the discount percentage
     *
     * @param mixed $percentage The percentage of the discount
     *
     * @return void
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;
    }
}
