<?php
/**
 * Abstract Db Class
 */
require 'ModelInterface.php';
require 'ModelException.php';
class AbstractModel implements ModelInterface
{
    const ERROR_LOG = 'error.log';

    protected $services;
    protected $pdo;

    /**
     * AbstractModel constructor.
     * @param Services $services
     */
    public function __construct(Services $services){
        $this->services = $services;

        //Get the singleton PDO and cache it so all models have it.
        $this->pdo = $this->services->getDb()->pdo;

    }
}