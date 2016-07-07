<?php

/**
 * Db Exception Class
 */
class ModelException extends Exception
{
    public function __construct($msg, $en = null){
        parent::__construct($msg, $en);
    }
}