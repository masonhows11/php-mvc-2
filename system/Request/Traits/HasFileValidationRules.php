<?php

namespace System\Request\Traits;


trait HasFileValidationRules
{


    // $name id field name
    // rulesArray is array of rule validation like required,max,min
    protected function fileValidation($name, $rulesArray)
    {
        foreach ($rulesArray as $rule) {

            if ($rule == "required") {
                $this->fileRequired($name);

            } elseif (strpos($rule, "mimes:") === 0) {

                $rule = str_replace('mimes:', "", $rule);
                $rule = explode(',', $rule);
                $this->fileType($name, $rule);

            } elseif (strpos($rule, "max:") === 0) {

                $rule = str_replace('max:', "", $rule);
                $this->maxFile($name, $rule);

            } elseif (strpos($rule, "min:") === 0) {

                $rule = str_replace('min:', "", $rule);
                $this->minFile($name, $rule);

            }
        }
    }


    protected function fileRequired($name): void
    {

        if (!isset($this->files[$name]['name']) || empty($this->files[$name]['name']) && $this->checkFirstError($name)) {
            $this->setError($name, "$name is required");
        }
    }

    protected function fileType($name,$typesArray)
    {
        if($this->checkFirstError($name) && $this->checkFieldExists($name)){

            $currentFileType = explode('/',$this->files[$name]['type'][1]);

            if(!in_array($currentFileType,$typesArray))
            {
                $this->setError($name, "$name type must be".implode(',',$typesArray));
            }
        }
    }

    protected function MaxFile($name,$size)
    {
        // size as byte
        // kb to byte
        $size = $size * 1024;
        if($this->checkFirstError($name) && $this->checkFieldExists($name)){

            if($this->files[$name]['size'] > $size)
            {
                $this->setError($name, "$name size must be lower than ".($size / 1024)." Kb ");
            }
        }


    }

    protected function minFile($name,$size)
    {
        $size = $size * 1024;

        if($this->checkFirstError($name) && $this->checkFieldExists($name)){

            if($this->files[$name]['size'] < $size)
            {
                $this->setError($name, "$name size must be bigger than ".($size / 1024)." Kb ");
            }
        }
    }

}