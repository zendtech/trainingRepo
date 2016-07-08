<?php
/**
 * Abstract Controller
 */

abstract class AbstractController implements ServiceInterface
{
    protected $services;
    protected $domain;

    /**
     * AbstractController constructor.
     */
    public function __construct(){
        $this->setServices();

        //Add the business logic container object
        $this->domain = $this->services->getDomain();
    }

    /**
     * @return $this
     */
    public function setServices(){
        $this->services = new Services();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getServices(){
        return $this->services;
    }

    /**
     * @param $method
     * @param null $params
     */
    public function __call($method, $params = null){
        $methodName = strtolower($method) . 'Action';
        if($params){
            $this->$methodName($params);
        } else {
            $this->$methodName();
        }
    }
}