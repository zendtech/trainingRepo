<?php
/**
 * View Container Class
 */
class View
{
    public $template;
    public $data;
    public $args;
    public $layout;
    public $file;

    /**
     * View constructor.
     * @param $action
     */
    public function __construct($action){
        $this->setVars($action);
    }

    /**
     * @return mixed
     */
    public function render(){
        //Buffer the output
        ob_start();

        //Pull in the main layout file
        require BASE . 'View/Layouts/index.php';

        //Grab the buffer contents and return
        echo ob_get_clean();
    }

    /**
     * @param $values
     * @return $this
     */
    public function setData($values)
    {
        $this->data = $values;
        return $this;
    }

    /**
     * @param $action
     * @return $this
     */
    public function setVars($action)
    {
        $this->layout = substr($action, 0, -6);
        $this->file = $this->layout . '.php';
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param string $template
     * @return $this
     */
    public function setTemplate($template)
    {
        $this->template = $template . '.php';
        return $this;
    }
}