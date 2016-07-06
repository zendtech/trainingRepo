<?php
/**
 * Text Input Class
 * Note: Class only partially abstracted
 */
class Text extends BaseInput implements InputInterface
{
    public $type = 'text';
    public $size;
    public $readonly;

    /**
     * @return string
     */
    public function getInput()
    {
        $input = "<input type=\"$this->type\"";
        $input .= isset($this->id) ? "id=\"$this->id\"" : null;
        $input .= isset($this->value) ? "value=\"$this->value\"" : null;
        $input .= isset($this->class) ? "class=\"$this->class\"" : null;
        $input .= isset($this->name) ? "name=\"$this->name\"" : null;
        $input .= isset($this->size) ? "size=\"$this->size\"" : null;
        $input .= isset($this->required) ? 'required' : null;
        $input .= isset($this->readonly) ? 'readonly' : null;
        $input .= '>';
        return $input;
    }
}