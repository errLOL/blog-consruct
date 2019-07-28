<?php

namespace core;

//use core\Exception\ErrorNotFoundException;

class Router
{
    private $routeCollection = [];

    public function addRoute($name, \Closure $closure)
    {
        $this->routeCollection[ROOT . $name] = $closure;
    }

    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];

        if(!isset($this->routeCollection[$uri])) {
            //throw new Exception\ErrorNotFoundException();
            die('404');
        }
        $this->routeCollection[$uri]();
    }

    public function get($name, \Closure $closure)
    {
        $uri = explode(':', $name);
        $length = iconv_strlen(ROOT . $uri[0]);
        if(substr($_SERVER['REQUEST_URI'],0,$length) == ROOT . $uri[0]) {
            $name = str_replace(ROOT . $uri[0], '', $_SERVER['REQUEST_URI']);
            $name = str_word_count($name,1)[0];
            $uri[1] = $name;
            $uri = implode('', $uri);
            if ($_SERVER['REQUEST_URI'] == ROOT . $uri) {
                call_user_func($closure, $name);
            }
            //$this->addRoute($uri, $closure);
            //var_dump($this->routeCollection[$uri]);
            
        }
    }

    /* public function post($name, \Closure $closure)
    {
        $this->routeCollection[ROOT . $name] = $closure;
        if(!empty($_POST)) {
            $this->run();
        }
    }
    public function get($name, \Closure $closure)
    {
        $this->routeCollection[ROOT . $name] = $closure;
        if(empty($_POST)) {
            $this->run();
        }
    } */
}
