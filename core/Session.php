<?php

namespace core;

class Session
{
    static function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}