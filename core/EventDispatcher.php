<?php

namespace core;
use core\Exception\ErrorNotFoundException;

class EventDispatcher
{
    private $collection = [];

    public function addEvent($name, Closure $event)
    {
        $this->collection[$name] = $event;
    }

    public function fire($name, array $params = [])
    {
        if (!isset($this->collection[$name])) {
            return false;
        }

        call_user_func_array($this->collection[$name], $params);
    }
}