<?php
session_start();
define('ROOT', '/php3/');

use core\Application;
use core\Router;
spl_autoload_register('myAutoloader');
function myAutoloader($classname) {
	include_once(__DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php');
}
$router = new Router();
$router->addRoute('', function () {
    echo 'Main page!';
});

$router->addRoute('super/some/route', function () {
    echo 'Some Route!!!';
});

/* $router->get('post/add', function () {
    echo 'Зарос сделан методом GET!!!!';
});

$router->post('post/add', function () {
    echo 'Зарос сделан методом POST!!!!';
}); */
$router->get('hello/:name', function($name) {
	echo 'Hello, ' . $name . '!';
});

try {
    $app = new Application();
    $app->run();
}
catch (core\Exception\ErrorNotFoundException $e) {
    $app->errHundler($e->getMessage(), $e->getCode());
} 
catch (\Exception $e) {
    $app->errHundler($e->getMessage(), $e->getCode());
}

