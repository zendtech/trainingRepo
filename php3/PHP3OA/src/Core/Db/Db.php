<?php
/**
 * PDO Database Wrapping Class
 * Note: This wraps a PDO instance so the DB can be a singleton instance
 */
final class Db
{
    private static $db;

    /**
     * @return Db
     */
    public static function getInstance(){
        if(!self::$db){
            self::$db = new self();
        }
        return self::$db;
    }

    /**
     * Constructor is private because this class canno be instantiated directly.
     */
    private function __construct(){
        $this->getDbConnection();
    }

    /**
     * Connect to the database
     */
    private function getDbConnection()
    {
        // Get the db access credentials
        $services = Services::getInstance();
        $cred = $services->get('db');
        try{
            $this->pdo = new PDO($cred['dsn'], $cred['username'], $cred['password']);
        }catch (PDOException $e){
            //Append the error to the defined log
            error_log($e->getMessage(), 3, 'error.log');
        }
    }

    /**
     * Singletons may not be cloned
     */
    private function __clone() {
        throw new Exception('Cannot clone object');
    }
}