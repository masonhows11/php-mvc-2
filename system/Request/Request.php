<?php

namespace System\Request;


use System\Request\Traits\HasFileValidationRules;
use System\Request\Traits\HasRunValidation;
use System\Request\Traits\HasValidationRules;
class Request
{

    use HasValidationRules,HasRunValidation,HasFileValidationRules;


    protected bool $errorExist = false;

    protected $request;

    protected $files = null;

    protected array $errorVariableName = [];


    public function __construct()
    {
        
    }

}