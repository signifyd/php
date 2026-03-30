<?php
/**
 * CaseModel for the Signifyd SDK
 *
 * PHP version 8.2
 *
 * @category  Signifyd_Fraud_Protection
 * @package   Signifyd\Core
 * @author    Signifyd <info@signifyd.com>
 * @copyright 2026 SIGNIFYD Inc. All rights reserved.
 * @license   See LICENSE.txt for license details.
 * @link      https://www.signifyd.com/
 */
namespace Signifyd\Models;

use Signifyd\Core\Model;

/**
 * Class Amount
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Amount extends Model
{
    /**
     * The amount of the transaction.
     * This must be greater than zero and less than or equal to the original order amount.
     *
     * @var float
     */
    public float $amount;

    /**
     * The ISO 4217 code for the currency.
     *
     * @var string
     */
    public string $currencyCode;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        '$amount',
        '$currencyCode'
    ];

    protected $arrayOfObjectFields = [];

    protected $stringFields = [
        '$amount',
        '$currencyCode'
    ];

    /**
     * Create constructor.
     *
     * @param array $amout
     */
    public function __construct(array $amout = [])
    {
        // Check if something was passed to the class
        if (is_array($amout) && !empty($amout)) {
            foreach ($this->fields as $field) {
                // init the class name
                $class = '\Signifyd\Models\\' . ucfirst($field);

                // make sure no wild data is sent
                if (array_key_exists($field, $amout) === false) {
                    continue;
                }

                if (is_array($amout[$field]) && !empty($amout[$field])) {
                    if (in_array($field, $this->arrayOfObjectFields)) {
                        // init the class name
                        $singular = mb_substr($field,0,-1);
                        $className = ucfirst($singular);
                        $class = '\Signifyd\Models\\' . $className;

                        foreach ($amout[$field] as $item) {
                            if ($item instanceof $class) {
                                $object = $item;
                            } else {
                                $object = new $class($item);
                            }

                            $this->{'add' . $className}($object);
                        }
                    } else {
                        $this->{'set' . ucfirst($field)}($amout[$field]);
                    }
                } elseif ($amout[$field] instanceof $class) {
                    $this->{'set' . ucfirst($field)}($amout[$field]);
                } elseif (in_array($field, $this->stringFields)) {
                    $this->{'set' . ucfirst($field)}($amout[$field]);
                }
            }
        }
    }

    /**
     * Validate the post sale
     *
     * @return array|bool
     */
    public function validate(): bool|array
    {
        $valid = [];

        return (!isset($valid[0]))? true : $valid;
    }

    /**
     * Retrieve amount
     *
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Set amount
     *
     * @param float $amount
     * @return void
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * Retrieve currency code
     *
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    /**
     * Set currency code
     *
     * @param string $currencyCode
     * @return void
     */
    public function setCurrencyCode(string $currencyCode): void
    {
        $this->currencyCode = $currencyCode;
    }
}
