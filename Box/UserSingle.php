<?php

namespace Box;
use Box\BoxInterface;
use Box\Container;
use core\User;

class UserSingle implements BoxInterface
{
    public function register(Container $container)
    {
        $container->single('user', function() use($container) {

            return new User(
                $container->fabricate('factory.models', 'Users'),
                $container->fabricate('factory.models', 'Session')
            );
        });
    }
}
