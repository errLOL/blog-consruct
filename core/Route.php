<?php

namespace core;
use core\Exception\ErrorNotFoundException;

class Route
{
    private $routeCollection = []

    public function addRoute($name, Closure $closure)
    {
        $this->routeCollection[$name] = $closure;
    }

    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];

        if(!isset($this->$routeCollection[$uri])) {
            throw new ErrorNotFoundException();  
        }
        $this->$routeCollection[$uri]();
    }
}
