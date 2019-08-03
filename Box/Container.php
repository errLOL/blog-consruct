<?php

namespace Box;
use Box\BoxInterface;

class Container
{
    private $factories = [];
    private $singles = [];

    public function factory(string $name, \Closure $closure)
    {
        $this->factories[$name] = $closure;
    }
    
    public function single($name, \Closure $closure , ...$params)
    {
        $this->singles[$name] = $this->invoke($closure);
    }

    public function get(string $name)
    {
        if (!array_key_exists($name, $this->singles)) {
            throw new \Exception('Key '. $name . ' not found', 503);
        }

        return $this->singles[$name];
    }
    
    public function fabricate($name, ...$params)
    {
        if (!array_key_exists($name, $this->factories)) {
            throw new \Exception('Key '. $name . ' not found', 503);
        }

        return $this->invoke($this->factories[$name], $params);
    }
    
    public function register(BoxInterface $box)
    {
        $box->register($this);
    }

    protected function invoke(\Closure $closure, array $params = [])
    {
        
       return call_user_func_array($closure, $params);
    }
}
