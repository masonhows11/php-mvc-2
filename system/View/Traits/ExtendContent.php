<?php


namespace System\View\Traits;


trait ExtendContent
{


    private $extendsContent;


    /**
     * @throws \Exception
     */
    private function checkExtendsContent()
    {
        $layoutsFilePath = $this->findExtends();
        if($layoutsFilePath){

            $this->extendsContent = $this->viewLoader($layoutsFilePath);
        }
    }


    private function findExtends(): null|false
    {
        $filePathArray = [];

        // to use extends method or not
        preg_match("/s*@extends+\('([^)]+)'\)/",$this->content,$filePathArray);

        return isset($filePathArray[1]) ? $filePathArray[1] : false;
    }

    private function findYieldsNames(): null|false
    {
        $yieldsNamesArray = [];

        // to use extends method or not
        preg_match_all("/s*@yield+\('([^)]+)'\)/",$this->extendsContent,$yieldsNamesArray);

        return isset($filePathArray[1]) ? $filePathArray[1] : false;
    }


}