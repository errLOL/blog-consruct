<?php

namespace Phpblog\Box;
use Phpblog\Box\Container;

interface BoxInterface
{
    public function register(Container $container);
}