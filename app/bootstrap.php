<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../MVC/loader.php';

require_once __DIR__.'/config.inc.php';

$router = new JanPetr\MVC\Router();

$router->addRoute('GET', '/', array(
	'controller' => 'Homepage',
	'method' => 'default',
));

$router->addRoute('DELETE', '/api/1/:index/:id', array(
	'controller' => 'Api',
	'method' => 'deleteFromIndex',
));

$router->addRoute('POST', '/api/1/:index', array(
	'controller' => 'Api',
	'method' => 'addToIndex',
));

return new JanPetr\MVC\Application($router);