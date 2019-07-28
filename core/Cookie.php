<?php

namespace core;

class Cookie
{
    static function setCookie($name, $value, $time = 24*31*24)
    {
        $time = time()+60*60*$time;
        setcookie($name, $value, $time);
    }
}