<?php
/**
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
 * Class Reason
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Reason extends Model
{
    /**
     * Payment processor (e.g. WORLDPAY, ADYEN, PAYPAL etc.).
     *
     * @var string
     */
    public string $processorName;

    /**
     * Reason code issued by payment processor.
     *
     * @var string
     */
    public string $processorReasonCode;

    /**
     * Detailed reason description issued by payment processor.
     *
     * @var string
     */
    public string $processorReasonDescription;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'processorName',
        'processorReasonCode',
        'processorReasonDescription'
    ];

    protected $arrayOfObjectFields = [];

    protected $stringFields = [
        'processorName',
        'processorReasonCode',
        'processorReasonDescription'
    ];

    /**
     * Reason constructor.
     *
     * @param array $reason
     */
    public function __construct(array $reason = [])
    {
        // Check if something was passed to the class
        if (is_array($reason) && !empty($reason)) {
            foreach ($this->fields as $field) {
                // init the class name
                $class = '\Signifyd\Models\\' . ucfirst($field);

                // make sure no wild data is sent
                if (array_key_exists($field, $reason) === false) {
                    continue;
                }

                if (is_array($reason[$field]) && !empty($reason[$field])) {
                    if (in_array($field, $this->arrayOfObjectFields)) {
                        // init the class name
                        $singular = mb_substr($field,0,-1);
                        $className = ucfirst($singular);
                        $class = '\Signifyd\Models\\' . $className;

                        foreach ($reason[$field] as $item) {
                            if ($item instanceof $class) {
                                $object = $item;
                            } else {
                                $object = new $class($item);
                            }

                            $this->{'add' . $className}($object);
                        }
                    } else {
                        $this->{'set' . ucfirst($field)}($reason[$field]);
                    }
                } elseif ($reason[$field] instanceof $class) {
                    $this->{'set' . ucfirst($field)}($reason[$field]);
                } elseif (in_array($field, $this->stringFields)) {
                    $this->{'set' . ucfirst($field)}($reason[$field]);
                }
            }
        }
    }

    /**
     * Validate reason
     *
     * @return array|bool
     */
    public function validate(): bool|array
    {
        $valid = [];

        return (!isset($valid[0]))? true : $valid;
    }

    /**
     * Retrieve processor name
     *
     * @return string
     */
    public function getProcessorName(): string
    {
        return $this->processorName;
    }

    /**
     * Set processor name
     *
     * @param string $processorName
     * @return void
     */
    public function setProcessorName(string $processorName): void
    {
        $this->processorName = $processorName;
    }

    /**
     * Retrieve processor reason code
     *
     * @return string
     */
    public function getProcessorReasonCode(): string
    {
        return $this->processorReasonCode;
    }

    /**
     * Set processor reason code
     *
     * @param string $processorReasonCode
     * @return void
     */
    public function setProcessorReasonCode(string $processorReasonCode): void
    {
        $this->processorReasonCode = $processorReasonCode;
    }

    /**
     * Retrieve processor reason description
     *
     * @return string
     */
    public function getProcessorReasonDescription(): string
    {
        return $this->processorReasonDescription;
    }

    /**
     * Set processor reason description
     *
     * @param string $processorReasonDescription
     * @return void
     */
    public function setProcessorReasonDescription(string $processorReasonDescription): void
    {
        $this->processorReasonDescription = $processorReasonDescription;
    }
}
