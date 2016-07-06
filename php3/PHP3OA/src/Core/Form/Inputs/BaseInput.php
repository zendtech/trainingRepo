<?php
/**
 * Abstract BaseInput Class
 */
require BASE . 'Core/Html/GlobalHtmlAtt.php';
abstract class BaseInput extends GlobalHtmlAtt
{
    const PATH_VALIDATORS = 'Core/Validator/';
    public $type;
    public $name;
    protected $label;
    public $value;
    public $required;
    protected $isValid = false;
    protected $validators;

    /**
     * @return mixed
     */
    public function getValidators()
    {
        return $this->validators;
    }

    /**
     * @param mixed $param
     * @return $this
     */
    public function setValidators($param)
    {
        if(is_array($param)){
            foreach($param as $key => $value){
                if(is_string($key)){
                    require_once BASE . static::PATH_VALIDATORS . ucfirst($key) . '.php';
                    $validator = new $key;
                    if(is_array($value)){
                        $validator->value = $value;
                    }
                    $this->validators[] = $validator;
                } elseif (is_numeric($key)){
                    require_once BASE . static::PATH_VALIDATORS . ucfirst($value) . '.php';
                    $this->validators[] = new $value;
                }
            }
        } else {
            require_once BASE . static::PATH_VALIDATORS . ucfirst($param) . '.php';
            $this->validators[] = new $param;
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabelTag()
    {
        return "<label for=\"" . strtolower($this->label) . "\">" . ucwords($this->label) . "</label>";
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return boolean
     */
    public function isValid()
    {
        return $this->isValid;
    }

    /**
     *
     */
    public function setIsValid()
    {
        $this->isValid = true;
    }
}