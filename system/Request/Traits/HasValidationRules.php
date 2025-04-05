<?php

namespace System\Request\Traits;


use System\Database\DBConnection\DBConnection;

trait HasValidationRules
{

    public function normalValidation($name, $rulesArray)
    {
        foreach ($rulesArray as $rule) {

            if ($rule == 'required') {

                $this->required($name);

            } elseif (strpos($rule, "max:") === 0) {

                $rule = str_replace('max:', "", $rule);
                $this->maxStr($name, $rule);

            } elseif (strpos($rule, "min:") === 0) {

                $rule = str_replace('min:', "", $rule);
                $this->minStr($name, $rule);

            } elseif (strpos($rule, "exists:") === 0) {

                $rule = str_replace('exists:', "", $rule);
                $rule = explode(',', $rule);
                $key = isset($rule[1]) == false ? null : $rule[1];
                $this->existsIn($name, $rule[0], $key);

            } elseif ($rule == 'email') {

                $this->email($name);

            } elseif ($rule == 'date') {

                $this->date($name);

            }


        }
    }

    protected function email()
    {

    }

    protected function date()
    {

    }

    protected function required()
    {

    }

    protected function maxStr()
    {

    }

    protected function minStr()
    {

    }


    protected function existsIn()
    {

    }
}