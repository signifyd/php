<?php

namespace Signifyd\Models;

use Signifyd\Core\Model;

class Policy extends Model
{
    /**
     * The response type that should be applied to the case: an asynchronous response
     * that will require subscribing to webhook events or polling
     * the Get Case API or a synchronous response.
     *
     * @var string
     */
    public $name;

    /**
     * The result of the policy.
     *
     * @var string
     */
    public $status;

    /**
     * The suggested action that should be taken for the event.
     *
     * @var string
     */
    public $action;

    /**
     * The reason for the suggested action.
     *
     * @var string
     */
    public $reason;

    protected $fields = [
        'name',
        'status',
        'action',
        'reason'
    ];

    protected $fieldsValidation = [
        'name' => [],
        'status' => [],
        'action' => [],
        'reason' => []
    ];

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
     * Validate the policy
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function setAction($action)
    {
        $this->action = $action;
    }

    public function getReason()
    {
        return $this->reason;
    }

    public function setReason($reason)
    {
        $this->reason = $reason;
    }
}
