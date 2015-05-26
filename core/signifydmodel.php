<?php

abstract class SignifydModel
{
    protected $validationInfo = array();

    public function __construct()
    {
    }

    public function toJson()
    {
        $this->_validateObject();
        return json_encode($this);
    }

    // The idea here is that each type includes a validation method that ensures
    // the set values fall within the type requirements and value requirements
    // set by the Signifyd REST API.
    protected function _validateObject()
    {

    }

    protected function _checkInt($value, $validator)
    {
        if(!is_int($value))
        {
            // TODO - LOG ERROR: Type should be int
            return false;
        }

        foreach($validator["value"] as $valueChecker)
        {
            switch($valueChecker->type)
            {
                case "range":
                    break;
                default:
                    // TODO - LOG WARNING: invalid value check for int
            }
        }
    }

    protected function _checkDouble($value, $validator)
    {
        if(!is_double($value))
        {
            // TODO - LOG ERROR: Type should be float
            return false;
        }

        foreach($validator["value"] as $type => $data)
        {
            switch($type)
            {
                case "range":
                    break;
                default:
                    // TODO - LOG WARNING: invalid value check for float
            }
        }
    }

    protected function _checkString($value, $validator)
    {
        if(!is_string($value))
        {
            // TODO - LOG ERROR: Type should be string
            return false;
        }

        foreach($validator["value"] as $valueChecker)
        {
            switch($valueChecker->type)
            {
                case "length":
                    break;
                default:
                    // TODO - LOG WARNING: invalid value check for int
            }
        }
    }

    protected function _checkEnum($value, $validator)
    {
        if(!is_string($value))
        {
            // TODO - LOG ERROR: Type should be string
            return false;
        }

        // enum MUST have a checker for value set
        if($validator["value"]["enum_set"] == null)
        {
            // TODO - LOG ERROR: enum must have valid set of values
            return false;
        }

        foreach($validator["value"] as $valueChecker)
        {
            switch($valueChecker->type)
            {
                case "enum_set":
                    break;
                default:
                    // TODO - LOG WARNING: invalid value check for enum
            }
        }
    }

    protected function _checkSignifydModel($value, $validator)
    {
        if(!is_subclass_of($value, "SignifydModel"))
        {
            // TODO - LOG ERROR: Type should be subclass of SignifydModel
            return false;
        }

        foreach($validator["value"] as $valueChecker)
        {
            switch($valueChecker->type)
            {
                case "subtype":
                    break;
                default:
                    // TODO - LOG WARNING: invalid value check for SignifydModel
            }
        }
    }

    protected function _checkDateTime($value, $validator)
    {
        if(! date($value))
        {
            // TODO - LOG ERROR: Type should be int
            return false;
        }

        foreach($validator["value"] as $valueChecker)
        {
            switch($valueChecker->type)
            {
                case "range":
                    break;
                default:
                    // TODO - LOG WARNING: invalid value check for int
            }
        }
    }

    protected function _checkBool($value, $validator)
    {
        if(!is_int($value))
        {
            // TODO - LOG ERROR: Type should be int
            return false;
        }

        foreach($validator["value"] as $valueChecker)
        {
            switch($valueChecker->type)
            {
                case "range":
                    break;
                default:
                    // TODO - LOG WARNING: invalid value check for int
            }
        }
    }
}