<?php

namespace System\Auth;


use App\Models\User;
use System\Session\Session;

class Auth
{


    public function __call(string $name, array $arguments)
    {
       return $this->methodCaller($name,$arguments);
    }

    public static function __callStatic(string $name, array $arguments)
    {
       $instance = new self;
       return $instance->methodCaller($name,$arguments);
    }

    protected function methodCaller($method, $args)
    {
        $suffix = 'Method';
        $methodName = $method.$suffix;

        return call_user_func_array(array($this,$methodName), $args);

    }
}