<?php

namespace Phpblog\Box;
use Phpblog\Box\BoxInterface;
use Phpblog\Box\Container;
use Phpblog\Core\Validator;

class ModelsFactorie implements BoxInterface
{
    public function register(Container $container)
    {
        $container->factory('factory.models', function($name) use($container) {
            $namespace = sprintf('Phpblog\\Model\\%sModel', $name);

            if(!class_exists($namespace)) {
                throw new \Exception('Model '. $name . ' not found', 503);  
            }

            return new $namespace($container->get('db.driver'), new Validator());
        });
    }
}
