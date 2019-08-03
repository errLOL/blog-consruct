<?php

namespace Phpblog\Box;
use Phpblog\Box\BoxInterface;
use Phpblog\Box\Container;
use Phpblog\Core\DBDriver;
use Phpblog\Core\DB;

class DBDriverSingle implements BoxInterface
{
    public function register(Container $container)
    {
        $container->single('db.driver', function() {

            return new DBDriver(DB::getConnect());
        });
    }
}
