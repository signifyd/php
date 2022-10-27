<?php

namespace Signifyd\Models;

use Signifyd\Core\Model;

/**
 * Class ExemptionDetails
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class ExemptionDetails extends Model
{
    /**
     * SCA Exemption
     *
     * @var string
     */
    public $exemption;

    /**
     * Whether the transaction should be authenticated or sent straight to authorization.
     *
     * @var string
     */
    public $placement;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'exemption',
        'placement'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'exemption' => [],
        'placement' => []
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

    /**
     * @return string
     */
    public function getExemption()
    {
        return $this->exemption;
    }

    /**
     * @param $exemption
     * @return void
     */
    public function setExemption($exemption)
    {
        $this->exemption = $exemption;
    }

    /**
     * @return string
     */
    public function getPlacement()
    {
        return $this->placement;
    }

    /**
     * @param $placement
     * @return void
     */
    public function setPlacement($placement)
    {
        $this->placement = $placement;
    }
}