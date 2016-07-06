<?php
/**
 * Option Class
 */
class Option extends GlobalHTMLAtt
{
    public $label;
    public $disabled = false;
    public $selected = false;
    public $value;

    /**
     * Option constructor.
     * @param array|null $att
     */
    public function __construct(array $att = null)
    {
        if($att)$this->setAttributes();
    }

    /**
     * @return string
     */
    public function getOption() : string
    {
        $option = "<option ";
        $option .= $this->label ? " label=\"$this->label\"" : null;
        $option .= $this->disabled ? " disabled=\"$this->disabled\"" : null;
        $option .= $this->selected ? " selected=\"$this->selected\"" : null;
        $option .= $this->value ? " value=\"$this->value\"" : null;
        $option .= ">";
        $option .= ucwords($this->value);
        $option .= "</option>";
        return $option;
    }

    /**
     * @param $options
     * @return mixed
     */
    public function getOptions(array $options) : mixed
    {
        $results = null;
        foreach ($options as $option) {
            $results .= $this->getOption($option);
        }
        return $results ?: false;
    }

    /**
     * @return mixed
     */
    protected function setAttributes() : mixed
    {
        $att = null;
        foreach(get_class_vars($this) as $var){
            $att .= "$var=\"\"";
        }
        return $att ?: null;
    }

    /**
     * @return boolean
     */
    public function isDisabled() : bool
    {
        return $this->disabled;
    }

    /**
     * @return boolean
     */
    public function isSelected() : bool
    {
        return $this->selected;
    }
}