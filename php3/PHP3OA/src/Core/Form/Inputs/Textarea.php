<?php
/**
 * Textarea Input Class
 * Note: This example illustrates a full textarea input element abstraction
 * Most frameworks will provide this level of abstraction.
 */
class Textarea extends BaseInput implements InputInterface
{
    public $autofocus;
    public $cols = 100;
    public $disabled;
    public $form;
    public $maxlength;
    public $placeholder;
    public $readonly;
    public $rows;
    public $wrap = 'soft';

    /**
     * @return string
     */
    public function getInput()
    {
        $textarea = "<textarea";
        $textarea .= isset($this->name) ? " name=\"$this->name\"" : null;
        $textarea .= isset($this->cols) ? " cols=\"$this->cols\"" : null;
        $textarea .= isset($this->form) ? " form=\"$this->form\"" : null;
        $textarea .= isset($this->maxlength) ? " maxlength=\"$this->maxlength\"" : null;
        $textarea .= isset($this->placeholder) ? ' ' . $this->placeholder : null;
        $textarea .= isset($this->rows) ? " rows=\"$this->rows\"" : null;
        $textarea .= isset($this->wrap) ? " wrap=\"$this->wrap\"" : null;
        $textarea .= isset($this->readonly) ? ' ' . $this->readonly : null;
        $textarea .= isset($this->disabled) ? ' ' . $this->disabled : null;
        $textarea .= isset($this->autofocus) ? ' ' . $this->autofocus : null;
        $textarea .= isset($this->required) ? ' ' . $this->required : null;
        $textarea .= '>';
        $textarea .= "</textarea>";
        return $textarea;
    }
}