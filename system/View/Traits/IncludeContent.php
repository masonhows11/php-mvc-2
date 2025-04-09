<?php

namespace System\View\Traits;

trait IncludeContent
{




    private function checkIncludesContent(): void
    {

    }


    private function findExtends(): null|false
    {
        $filePathArray = [];

        // to use extends method or not
        preg_match("/s*@extends+\('([^)]+)'\)/",$this->content,$filePathArray);

        //  return isset($filePathArray[1]) ? $filePathArray[1] : false;
        return $filePathArray[1] ?? false;
    }




    private function initialIncludes($includeName)
    {
       
        return $this->extendsContent = str_replace("@yield('$yieldsName')",$sectionContent,$this->extendsContent);

    }
}