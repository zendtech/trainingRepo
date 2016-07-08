<?php
/**
 * Submit Input Class
 */
class Submit extends BaseInput implements InputInterface
{
    public $type = 'submit';
    public $name = 'submit';
    public $value = 'value';

    /**
     * @return string
     */
    public function getInput(){
        return "<input type=\"$this->type\" name=\"$this->name\" value=\"$this->value\"/>";
    }
}