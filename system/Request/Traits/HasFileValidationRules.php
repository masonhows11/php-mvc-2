<?php

namespace System\Request\Traits;


trait HasFileValidationRules
{


    // $name id field name
    // rulesArray is array of rule validation like required,max,min
    protected function fileValidation($name,$rulesArray)
    {
        foreach ($rulesArray as $rule){

            if($rule == "required")
            {
                $this->fileRequired($name);

            } elseif (strpos($rule, "mimes:") === 0) {

                $rule = str_replace('mimes:', "", $rule);
                $rule = explode(',',$rule);
                $this->fileType($name, $rule);

            } elseif (strpos($rule, "max:") === 0) {

                $rule = str_replace('max:', "", $rule);
                $this->maxFile($name, $rule);

            }elseif (strpos($rule, "min:") === 0) {

                $rule = str_replace('min:', "", $rule);
                $this->minFile($name, $rule);

            }
        }
    }
    
}