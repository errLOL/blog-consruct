<?php

namespace core;

use core\Exception\ErrorNotFoundException;

class Router
{
    private $routeCollection = [];

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $router = $this->routeCollection[$method];
        $uri = str_replace(ROOT , '' , $_SERVER['REQUEST_URI']);
        $uriParts = explode('/', $uri);
        $src = '';
        $countParts = count($uriParts);
        $flag = false;
        
        for ($i=0; $i < count($uriParts); $i++) {
            $src .= $uriParts[$i] . '/';
            $countParts--;
            if (!isset($router[$src])) {
                unset($uriParts[$i]);
                continue;
            }elseif($router[$src]['params'] == $countParts) {
                unset($uriParts[$i]);
                $callback = $router[$src]['callback'];
                $flag = true;
                break;
            }else {
                unset($uriParts[$i]);
            }
        }

        if(!$flag) {
            throw new ErrorNotFoundException();
        }
        call_user_func_array($callback, $uriParts);
    }

    public function get($name, \Closure $closure)
    {
        $uri = explode(':', $name);
        $this->routeCollection['GET'][$uri[0]] = [
            'callback' => $closure,
            'params' => count($uri) - 1
        ];
    }
    public function post($name, \Closure $closure)
    {
        $uri = explode(':', $name);
        $this->routeCollection['POST'][$uri[0]] = [
            'callback' => $closure,
            'params' => count($uri) - 1
        ];
    }
}
