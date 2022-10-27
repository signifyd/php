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
 * Class Policies
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Policies extends Model
{
    /**
     * @var Policy
     */
    public $default;

    /**
     * The overriding policies configured at the Checkpoint in Decision Center.
     *
     * @var array of Policy
     */
    public $overriding = [];

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'default',
        'overriding'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'default' => [],
        'overriding' => []
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

                if ($field == 'default') {
                    if (isset($data['default'])) {
                        if ($data['default'] instanceof Policy) {
                            $this->setDefault($data['default']);
                        } else {
                            $policy = new Policy($data['default']);
                            $this->setDefault($policy);
                        }
                    }
                    continue;
                }

                if ($field == 'overriding') {
                    foreach ($value as $item) {
                        if ($item instanceof Policy) {
                            $object = $item;
                        } else {
                            $object = new Policy($item);
                        }

                        $this->addOverriding($object);
                    }
                }
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

    /**
     * @return Policy
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param $default
     * @return void
     */
    public function setDefault($default)
    {
        $this->default = $default;
    }

    /**
     * @param $overriding
     * @return void
     */
    public function addOverriding($overriding)
    {
        $this->overriding[] = $overriding;
    }
}