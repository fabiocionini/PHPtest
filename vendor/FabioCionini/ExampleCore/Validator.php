<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 13/05/15
 * Time: 00:53
 */

namespace FabioCionini\ExampleCore;


/**
 * Class Validator
 * Provides a validation method which checks for required fields, fields type and min/max length given a configuration array
 * Also provides detailed errors if validation fails.
 *
 * @package FabioCionini\ExampleCore
 */
class Validator {

    private $fields;
    private $errors = [];

    public function __construct(array $fields) {
        $this->fields = $fields;
    }

    public function isRequired($field) {
        if (isset($this->fields[$field]['required'])) {
            return $this->fields[$field]['required'];
        }
        else {
            return false;
        }
    }

    public function checkType($field, $value) {
        if (isset($this->fields[$field]['type'])) {
            switch ($this->fields[$field]['type']) {
                case 'string':
                    return is_string($value);
                    break;
                case 'integer':
                    return is_integer($value);
                    break;
                case 'float':
                    return is_float($value);
                    break;
                case 'boolean':
                    return is_bool($value);
                    break;
                default:
                    return true;
                    break;
            }
        }
        else {
            return true;
        }
    }

    public function checkMinLength($field, $value) {
        if (isset($this->fields[$field]['min_length'])) {
            return strlen($value) >= $this->fields[$field]['min_length'];
        }
        else {
            return true;
        }
    }

    public function checkMaxLength($field, $value) {
        if (isset($this->fields[$field]['max_length'])) {
            return strlen($value) <= $this->fields[$field]['max_length'];
        }
        else {
            return true;
        }
    }

    /**
     * Validates a parameter array against validation rules
     * Returns true or false if valid or not
     *
     * @param $params
     * @return bool
     */
    public function validate($params) {
        $this->errors = [];
        foreach ($this->fields as $field=>$properties) {
            error_log($field);
            if ($this->isRequired($field) && !isset($params[$field])) {
                $this->addError("Field '".$field."' is required.");
            }
            else {
                if (!$this->checkType($field, $params[$field])) {
                    $this->addError("Field '".$field."' must be of type ".$properties['type'].".");
                }
                if (!$this->checkMinLength($field, $params[$field])) {
                    $this->addError("Field '".$field."' length must be at least ".$properties['min_length']." characters.");
                }
                if (!$this->checkMaxLength($field, $params[$field])) {
                    $this->addError("Field '".$field."' length must be no more than ".$properties['max_length']." characters.");
                }
            }
        }

        if (count($this->errors)) return false;
        else return true;
    }

    public function addError($error) {
        $this->errors[] = $error;
    }

    /**
     * Returns all the error messages for the last validation
     *
     * @return array
     */
    public function getErrors() {
        return $this->errors;
    }
}