<?php
/**
 * Required Validator
 */
class Required implements ValidatorInterface
{
    /**
     * @param null $value
     * @return bool
     */
    public function validate($value = null)
    {
        if (!empty($value)) return true;
        return false;
    }
}