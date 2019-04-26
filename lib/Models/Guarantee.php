<?php
/**
 * Guarantee model for the Signifyd SDK
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
 * Class Guarantee
 *
 * @category Signifyd_Fraud_Protection
 * @package  Signifyd\Core
 * @author   Signifyd <info@signifyd.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.signifyd.com/
 */
class Guarantee extends Model
{
    /**
     * Case id
     */
    public $caseId;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'caseId'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'caseId' => []
    ];

    /**
     * Guarantee constructor.
     *
     * @param array $data Guarantee data
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
     * Validate the guarantee
     *
     * @return bool
     */
    public function validate()
    {
        $valid = [];

        //TODO add code to validate the guarantee
        return (!isset($valid[0]))? true : false;
    }

    /**
     * Get the case Id
     *
     * @return mixed
     */
    public function getCaseId()
    {
        return $this->caseId;
    }

    /**
     * Set the case id
     *
     * @param mixed $caseId The case id
     *
     * @return void
     */
    public function setCaseId($caseId)
    {
        $this->caseId = $caseId;
    }

}