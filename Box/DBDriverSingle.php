<?php

namespace Box;
use Box\BoxInterface;
use Box\Container;
use core\DBDriver;
use core\DB;

class DBDriverSingle implements BoxInterface
{
    public function register(Container $container)
    {
        $container->single('db.driver', function() {

            return new DBDriver(DB::getConnect());
        });
    }
}
