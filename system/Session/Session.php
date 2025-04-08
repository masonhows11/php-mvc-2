<?php

namespace System\Session;

class Session
{


    public function set($name, $value): void
    {
        $_SESSION[$name] = $value;
    }


    public function get($name)
    {
        // isset($_SESSION[$name]) ? $_SESSION[$name] : false ;
        return $_SESSION[$name] ?? false;
    }

    public function remove($name): void
    {
        if (isset($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
    }


    public static function __callStatic(string $name, array $arguments)
    {
        // TODO: Implement __callStatic() method.
    }

}