<?php
session_start();
define('ROOT', '/php3/');

use core\Application;
spl_autoload_register('myAutoloader');
function myAutoloader($classname) {
	include_once(__DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php');
}

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

