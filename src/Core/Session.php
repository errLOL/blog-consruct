<?php

namespace Phpblog\Core;

class Session
{
    static function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}