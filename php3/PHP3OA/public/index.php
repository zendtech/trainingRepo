<?php
/**
 * Application Entry
 */

/*Note: An autoloader can eliminate all of
the requires except for the autoloader itself*/
define('BASE', __DIR__ . '/../src/');

// Load the core classes
require BASE . 'Core/Service/ServiceInterface.php';
require BASE . 'Core/Controller/AbstractController.php';
require BASE . 'Core/Db/Db.php';
require BASE . 'Core/Db/AbstractModel.php';
require BASE . 'Core/Service/Services.php';
require BASE . 'Core/Form/Form.php';
require BASE . 'Core/View/View.php';
require BASE . 'Core/Messaging/Messenger.php';

// Load the front controller
require BASE . 'Controller/IndexController.php';

//Setup the services instance
Services::getInstance();

//Get a new index controller and startup
$controller = new IndexController();
$controller->index();