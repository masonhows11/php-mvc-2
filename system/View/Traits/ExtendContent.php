<?php


namespace System\View\Traits;


trait ExtendContent
{


    private $extendsContent;


    private function checkExtendsContent()
    {
        $layoutsFilePath = $this->findExtends();
        if($layoutsFilePath){

        }
    }


    private function findExtends(): null|false
    {
        $filePathArray = [];

        // to use extends method or not
        preg_match("/s*@extends+\('([^)]+)'\)/",$this->content,$filePathArray);

        return isset($filePathArray[1]) ? $filePathArray[1] : false;
    }


}