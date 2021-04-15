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

    protected $fields = [
        'name'
    ];

    protected $fieldsValidation = [
        'name' => []
    ];

    public function __construct($data = [])
    {
        if (is_array($data) && !empty($data)) {
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


}
