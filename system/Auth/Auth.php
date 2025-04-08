<?php

namespace System\Auth;


use App\Models\User;
use System\Session\Session;

class Auth
{


    private string $redirectTo = '/login';


    private function userMethod()
    {
        if (!Session::get('user')) {
            return redirect($this->redirectTo);
        }

        $user = User::find(Session::get('user'));

        if (empty($user))
        {
            Session::remove('user');
            return redirect($this->redirectTo);

        } else {

            return $user;
        }


    }

    private function checkMethod()
    {

        if (!Session::get('user')) {
            return redirect($this->redirectTo);
        }

        $user = User::find(Session::get('user'));

        if (empty($user))
        {
            Session::remove('user');
            return redirect($this->redirectTo);

        } else {

            return true;
        }

    }

    private function checkLoginMethod()
    {

        if (!Session::get('user')) {
            return redirect($this->redirectTo);
        }

        $user = User::find(Session::get('user'));

        if (empty($user))
        {
            Session::remove('user');
            return redirect($this->redirectTo);

        } else {

            return true;
        }

    }

    private function idMethod()
    {

    }


    public function __call(string $name, array $arguments)
    {
        return $this->methodCaller($name, $arguments);
    }

    public static function __callStatic(string $name, array $arguments)
    {
        $instance = new self;
        return $instance->methodCaller($name, $arguments);
    }

    protected function methodCaller($method, $args)
    {
        $suffix = 'Method';
        $methodName = $method.$suffix;
        return call_user_func_array(array($this, $methodName), $args);

    }
}