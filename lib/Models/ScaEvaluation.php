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
 * Class ScaEvaluation
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class ScaEvaluation extends Model
{
    /**
     * Outcomes for Signifyd's SCA Evaluation product:
     *
     * @var string
     */
    public $outcome;

    /**
     * Details on Signifyd's evaluation that the order is out of SCA regulatory scope.
     *
     * @var ExclusionDetails
     */
    public $exclusionDetails;

    /**
     * Details on Signifyd's evaluation that the order is out of SCA regulatory scope.
     *
     * @var ExemptionDetails
     */
    public $exemptionDetails;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'outcome',
        'exclusionDetails',
        'exemptionDetails',
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'outcome' => [],
        'exclusionDetails' => [],
        'exemptionDetails' => [],
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

                if ($field == 'exclusionDetails') {
                    if (isset($value)) {
                        if ($value instanceof ExclusionDetails) {
                            $this->setExclusionDetails($value);
                        } else {
                            $exclusionDetails = new ExclusionDetails($value);
                            $this->setExclusionDetails($exclusionDetails);
                        }
                    }
                    continue;
                }

                if ($field == 'exemptionDetails') {
                    if (isset($value)) {
                        if ($value instanceof ExemptionDetails) {
                            $this->setExemptionDetails($value);
                        } else {
                            $exemptionDetails = new ExemptionDetails($value);
                            $this->setExemptionDetails($exemptionDetails);
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

        //TODO add code to validate the user account
        return (!isset($valid[0]))? true : false;
    }

    /**
     * @return string
     */
    public function getOutcome()
    {
        return $this->outcome;
    }

    /**
     * @param $outcome
     * @return void
     */
    public function setOutcome($outcome)
    {
        $this->outcome = $outcome;
    }

    /**
     * @return ExclusionDetails
     */
    public function getExclusionDetails()
    {
        return $this->exclusionDetails;
    }

    /**
     * @param $exclusionDetails
     * @return void
     */
    public function setExclusionDetails($exclusionDetails)
    {
        $this->exclusionDetails = $exclusionDetails;
    }

    /**
     * @return ExemptionDetails
     */
    public function getExemptionDetails()
    {
        return $this->exemptionDetails;
    }

    /**
     * @param $exemptionDetails
     * @return void
     */
    public function setExemptionDetails($exemptionDetails)
    {
        $this->exemptionDetails = $exemptionDetails;
    }
}