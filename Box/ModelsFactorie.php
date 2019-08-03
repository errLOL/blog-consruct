<?php

namespace Box;
use Box\BoxInterface;
use Box\Container;
use core\Validator;

class ModelsFactorie implements BoxInterface
{
    public function register(Container $container)
    {
        $container->factory('factory.models', function($name) use($container) {
            $namespace = sprintf('model\\%sModel', $name);

            if(!class_exists($namespace)) {
                throw new \Exception('Model '. $name . ' not found', 503);  
            }

            return new $namespace($container->get('db.driver'), new Validator());
        });
    }
}
