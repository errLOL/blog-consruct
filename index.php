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

$router->get('post/edit/:name', function($name) {
	echo 'post/get/, ' . $name . '!';
});
$router->get('post/:name', function($name) {
	echo 'post/' . $name . '!';
});
$router->get('/', function() {
	echo 'hello' . '!';
});
try {
    $app = new Application();
    $router->run();
    $app->run();
}
catch (core\Exception\ErrorNotFoundException $e) {
    $app->errHundler($e->getMessage(), $e->getCode());
} 
catch (\Exception $e) {
    $app->errHundler($e->getMessage(), $e->getCode());
}

