<?php
/**
 * Class InputCheckbox
 */
class Checkbox extends BaseInput implements InputInterface
{
    public $valueString;
    public $type = 'checkbox';
    public $value = true;

    /**
     * @return string
     */
    public function getInput(){
        return "<input type=\"checkbox\" name=\"$this->name\" value=\"$this->value\"> $this->valueString";
    }

    /**
     * @return mixed
     */
    public function getValueString()
    {
        return $this->valueString;
    }
}