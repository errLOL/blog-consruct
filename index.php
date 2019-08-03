<?php

define('ROOT', '/php3/');
session_start();
include_once('vendor/autoload.php');

use Phpblog\Core\Application;
use Phpblog\Box\Container;

$app = new Application(new Container());
try {
    $app->run();
}
catch (Phpblog\Core\Exception\ErrorNotFoundException $e) {
    $app->errHundler($e->getMessage(), $e->getCode());
} 
catch (\Exception $e) {
    $app->errHundler($e->getMessage(), $e->getCode());
}

