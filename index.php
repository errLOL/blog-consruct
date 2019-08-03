<?php

define('ROOT', '/php3/');
session_start();
//require_once ROOT . 'vendor/autoload.php';

use core\Application;
use Box\Container;

spl_autoload_register('myAutoloader');
function myAutoloader($classname) {
	include_once(__DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php');
}

$app = new Application(new Container());
try {
    $app->run();
}
catch (core\Exception\ErrorNotFoundException $e) {
    $app->errHundler($e->getMessage(), $e->getCode());
} 
catch (\Exception $e) {
    $app->errHundler($e->getMessage(), $e->getCode());
}

