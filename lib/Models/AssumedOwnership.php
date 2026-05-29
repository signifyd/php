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
 * Class AssumedOwnership
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class AssumedOwnership extends Model
{
    /**
     * AssumedOwner is required when setting AssumedOwnership.
     * This field is passed to Signifyd to indicate the assumed owning party of the representation rights
     * upon creation of the chargeback case.
     *
     * @var string
     */
    public string $assumedOwner;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'assumedOwner'
    ];

    protected $arrayOfObjectFields = [];

    protected $stringFields = [
        'assumedOwner'
    ];

    /**
     * AassumedOwnership constructor.
     *
     * @param array $assumedOwner
     */
    public function __construct(array $assumedOwner = [])
    {
        // Check if something was passed to the class
        if (is_array($assumedOwner) && !empty($assumedOwner)) {
            foreach ($this->fields as $field) {
                // init the class name
                $class = '\Signifyd\Models\\' . ucfirst($field);

                // make sure no wild data is sent
                if (array_key_exists($field, $assumedOwner) === false) {
                    continue;
                }

                if (is_array($assumedOwner[$field]) && !empty($assumedOwner[$field])) {
                    if (in_array($field, $this->arrayOfObjectFields)) {
                        // init the class name
                        $singular = mb_substr($field,0,-1);
                        $className = ucfirst($singular);
                        $class = '\Signifyd\Models\\' . $className;

                        foreach ($assumedOwner[$field] as $item) {
                            if ($item instanceof $class) {
                                $object = $item;
                            } else {
                                $object = new $class($item);
                            }

                            $this->{'add' . $className}($object);
                        }
                    } else {
                        $this->{'set' . ucfirst($field)}($assumedOwner[$field]);
                    }
                } elseif ($assumedOwner[$field] instanceof $class) {
                    $this->{'set' . ucfirst($field)}($assumedOwner[$field]);
                } elseif (in_array($field, $this->stringFields)) {
                    $this->{'set' . ucfirst($field)}($assumedOwner[$field]);
                }
            }
        }
    }

    /**
     * Validate assumed ownership
     *
     * @return array|bool
     */
    public function validate(): bool|array
    {
        $valid = [];

        return (!isset($valid[0]))? true : $valid;
    }

    /**
     * Retrieve assumed owner
     *
     * @return string
     */
    public function getAssumedOwner(): string
    {
        return $this->assumedOwner;
    }

    /**
     * Set assumed owner
     *
     * @param string $assumedOwner
     * @return void
     */
    public function setAssumedOwner(string $assumedOwner): void
    {
        $this->assumedOwner = $assumedOwner;
    }
}
