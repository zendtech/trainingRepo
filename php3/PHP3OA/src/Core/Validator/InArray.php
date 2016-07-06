<?php
/**
 * InArray Validator
 */
class InArray implements ValidatorInterface
{
    public $values = [];

    /**
     * @param null $value
     * @return bool
     */
    public function validate($value = null)
    {
        if ($this->values && in_array($value, $this->values)) {
            return true;
        }
        return false;
    }
}