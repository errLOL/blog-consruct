<?php

namespace Phpblog\Box;
use Phpblog\Box\BoxInterface;
use Phpblog\Box\Container;
use Phpblog\Core\User;

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
