<?php
/**
 * Abstract Form Superclass
 */
require_once BASE . 'Core/Form/Inputs/InputInterface.php';
require_once BASE . 'Core/Form/Inputs/BaseInput.php';
require_once BASE . 'Core/Validator/ValidatorInterface.php';
abstract class Form
{
    const INPUT_PATH = 'Core/Form/Inputs/';
    protected $elements = [];
    protected $models = [];
    protected $config = [];
    protected $rawData = [];
    protected $data = [];
    public $isValid = false;

    /**
     * Form constructor.
     * @param array $args
     */
    public function __construct(array $args){
        $this->config = $args;
    }

    /**
     * @return string
     */
    public function getStartTag(){
        return '<form ' . $this->addTagAttributes() . '>';
    }

    /**
     * @return null|string
     */
    protected function addTagAttributes(){
        $att = isset($this->config['id']) ? " id=\"{$this->config['id']}\"" : null;
        $att .= isset($this->config['class']) ? " class=\"{$this->config['class']}\"" : null;
        $att .= isset($this->config['action']) ? " action=\"{$this->config['action']}\"" : " action=\"index.php\"";
        $att .= isset($this->config['method']) ? " method=\"{$this->config['method']}\"" : " method=\"post\"";
        $att .= isset($this->config['name']) ? " name=\"{$this->config['name']}\"" : null;
        return $att;
    }

    /**
     * @return string
     */
    public function getEndTag(){
        return '</form>';
    }

    /**
     * @param $args
     * @return bool|Checkbox|Hidden|Password|Select|string|Submit|Text
     */
    public function addElement($args){
        $newElement = '';
        switch ($args['type']) {
            case 'text':
                require_once BASE . static::INPUT_PATH . 'Text.php';
                $newElement = new Text();
                isset($args['id']) ? $newElement->id = $args['id'] : null;
                isset($args['class']) ? $newElement->class = $args['class'] : null;
                isset($args['type']) ? $newElement->type = $args['type'] : null;
                isset($args['label']) ? $newElement->setLabel($args['label']) : null;
                isset($args['name']) ? $newElement->name = $args['name'] : null;
                isset($args['value']) ? $newElement->value = $args['value'] : null;
                isset($args['readonly']) ? $newElement->readonly = $args['readonly'] : null;
                isset($args['validator']) ? $newElement->setValidators($args['validator']) : null;
                break;
            case 'textarea':
                require_once BASE . static::INPUT_PATH . 'Textarea.php';
                $newElement = new Textarea();
                isset($args['type']) ? $newElement->type = ($args['type']) : null;
                isset($args['label']) ? $newElement->setLabel($args['label']) : null;
                isset($args['name']) ? $newElement->name = $args['name'] : null;
                isset($args['cols']) ? $newElement->cols = $args['cols'] : null;
                isset($args['form']) ? $newElement->form = $args['form'] : null;
                isset($args['maxlength']) ? $newElement->maxlength = $args['maxlength'] : null;
                isset($args['placeholder']) ? $newElement->placeholder = $args['placeholder'] : null;
                isset($args['rows']) ? $newElement->rows = $args['rows'] : null;
                isset($args['wrap']) ? $newElement->wrap = $args['wrap'] : null;
                isset($args['readonly']) ? $newElement->readonly = $args['readonly'] : null;
                isset($args['disabled']) ? $newElement->disabled = $args['disabled'] : null;
                isset($args['autofocus']) ? $newElement->autofocus = $args['autofocus'] : null;
                isset($args['validator']) ? $newElement->setValidators($args['validator']) : null;
                break;
            case 'password':
                require_once BASE . static::INPUT_PATH . 'Password.php';
                $newElement = new Password();
                isset($args['type']) ? $newElement->type = $args['type'] : null;
                isset($args['label']) ? $newElement->setLabel($args['label']) : null;
                isset($args['name']) ? $newElement->name = $args['name'] : null;
                isset($args['validator']) ? $newElement->setValidators($args['validator']) : null;
                break;
            case 'submit':
                require_once BASE . static::INPUT_PATH . 'Submit.php';
                $newElement = new Submit();
                isset($args['value']) ? $newElement->value = $args['value'] : null;
                break;
            case 'hidden':
                require_once BASE . static::INPUT_PATH . 'Hidden.php';
                $newElement = new Hidden();
                isset($args['value']) ? $newElement->value = $args['value'] : null;
                isset($args['name']) ? $newElement->name = $args['name'] : null;
                isset($args['validator']) ? $newElement->setValidators($args['validator']) : null;
                break;
            case 'checkbox':
                require_once BASE . static::INPUT_PATH . 'Checkbox.php';
                $newElement = new Checkbox();
                isset($args['type']) ? $newElement->type = $args['type'] : null;
                isset($args['label']) ? $newElement->setLabel($args['label']) : null;
                isset($args['name']) ? $newElement->name = $args['name'] : null;
                isset($args['validator']) ? $newElement->setValidators($args['validator']) : null;
                break;
            case 'select':
                require_once BASE . static::INPUT_PATH . 'Select.php';
                $newElement = new Select();
                $values = null;
                isset($args['multiple']) ? $newElement->multiple = $args['multiple'] : null;
                isset($args['type'])? $newElement->type = $args['type'] : null;
                isset($args['label']) ? $newElement->setLabel($args['label']) : null;
                isset($args['name']) ? $newElement->name = $args['name'] : null;
                isset($args['options']) ? $newElement->setOptions($args['options']) : null;
                isset($args['validator']) ? $newElement->setValidators($args['validator']) : null;
                break;
        }
        return $newElement ? $this->elements[] = $newElement : false;
    }

    /**
     * @param mixed $models
     * @return Form
     */
    public function setModels($models)
    {
        $this->models = $models;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModels()
    {
        return $this->models;
    }

    /**
     * @param array $config
     * @return Form
     */
    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @return mixed
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @param array $post
     * @return bool
     */
    public function setData(array $post){
        $count = [];
        $this->rawData = $post;
        foreach($this->elements as $element){
            if(array_key_exists($element->name, $post)){
                $countInvalid = [];
                $validators = $element->getValidators();
                if($validators){
                    foreach ($validators as $validator) {
                        if (!$validator->validate($post[$element->name]) && $element->required) {
                            $count[] = $countInvalid [] = $post[$element->name];
                        } else {
                            $this->data[$element->name] = $post[$element->name];
                            $element->setIsValid();
                        }
                    }
                }
                if (!count($countInvalid)) $element->setIsValid();
            }
        }
        if(count($count) === 0){
            $this->isValid = true;
        }
        return $this->isValid;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}