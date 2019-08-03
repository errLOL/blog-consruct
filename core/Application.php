<?php

namespace core;
use core\Exception\ErrorNotFoundException;
use core\Request;
use c\HomeController;
use Box\Container;
use Box\ModelsFactorie;
use Box\DBDriverSingle;
use Box\UserSingle;

class Application
{
    public $controller;
    public $action;
    public $container;

    public function __construct(Container $container) {
        $this->container = $container;
        $this->container->register(new DBDriverSingle());
        $this->container->register(new ModelsFactorie());
        $this->container->register(new UserSingle());
        $this->urlProcessing();
    }
   
    public function run()
    {
        $controller = $this->controller;
        $action = $this->action;

        switch ($controller) {
            case 'home':
            $controller = 'Home';
            break;
            case 'post':
            $controller = 'News';
            break;
            case 'user':
            $controller = 'User';
            break;
            
            default:
            throw new ErrorNotFoundException();
            break;
        }
        
        $controller = sprintf('c\%sController', $controller);
        $controller = new $controller(new Request($_GET, $_POST, $_SERVER, $_COOKIE, $_FILES, $_SESSION), $this->container);
        $controller->$action();
        $controller->render();
        
        return $controller;
    }

    public function errHundler($message, $code)
    {
        $controller = new HomeController();
        $controller->errHundler($message, $code);
        $controller->render();
    }
    
    private function urlProcessing()
    {
        $params = explode('/', $_GET['php1chpu']);
        $end = count($params) - 1;

        if($params[$end] === ''){
            unset($params[$end]);
            $end--;
        }
        $action = isset($params[1]) && preg_match('/^[a-z]+$/i', $params[1]) ? $params[1] : 'index';
        $this->action = sprintf('%sAction', $action);

        if(isset($params[2]) && is_numeric($params[2])) {
            $_GET['id'] = $params[2];
        }
        elseif(isset($params[1]) && is_numeric($params[1])) {
            $_GET['id'] = $params[1];
        }
        $this->controller = $params[0] ?? 'home';
    }
}