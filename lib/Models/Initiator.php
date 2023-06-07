<?php

namespace Signifyd\Models;

use Signifyd\Core\Model;
use Signifyd\Models\Fingerprint;

class Initiator extends Model
{
    /**
     * Unique email address associated with who initiated the return.
     * Either employeeEmail or employeeId must be present.
     *
     * @var string
     */
    public $employeeEmail;

    /**
     * Unique identifier associated with who initiated the return.
     * Either employeeEmail or employeeId must be present.
     *
     * @var float
     */
    public $employeeId;

    /**
     * The class attributes
     *
     * @var array $fields The list of class fields
     */
    protected $fields = [
        'employeeEmail',
        'employeeId'
    ];

    /**
     * The validation rules
     *
     * @var array $fieldsValidation List of rules
     */
    protected $fieldsValidation = [
        'employeeEmail' => [],
        'employeeId' => []
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
    public function getEmployeeEmail()
    {
        return $this->employeeEmail;
    }

    /**
     * @param $employeeEmail
     * @return void
     */
    public function setEmployeeEmail($employeeEmail)
    {
        $this->employeeEmail = $employeeEmail;
    }

    /**
     * @return float
     */
    public function getEmployeeId()
    {
        return $this->employeeId;
    }

    /**
     * @param $employeeId
     * @return void
     */
    public function setEmployeeId($employeeId)
    {
        $this->employeeId = $employeeId;
    }
}