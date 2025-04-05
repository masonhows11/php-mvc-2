<?php

namespace System\Request;


use System\Request\Traits\HasFileValidationRules;
use System\Request\Traits\HasRunValidation;
use System\Request\Traits\HasValidationRules;

class Request
{

    use HasValidationRules, HasRunValidation, HasFileValidationRules;


    protected bool $errorExist = false;

    protected array $request;

    protected array $files;

    protected array $errorVariableName = [];


    public function __construct()
    {
        if (isset($_POST))
        {
            $this->postAttribute();
        }
        if(!empty($_FILES))
        {
            $this->files = $_FILES;
        }
    }

    public function file($name)
    {
        return isset($this->files[$name]) ? $this->files[$name] : false;
    }

    protected function postAttribute()
    {
        // key -> value = first_name : hassan
        foreach ($_POST as $key => $value) {
            $this->$key = htmlentities($value);
            $this->request[$key] = htmlentities($value);
        }
    }

    public function all()
    {
        return $this->request;
    }

}