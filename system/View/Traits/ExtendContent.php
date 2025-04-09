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
            $yieldsNamesArray = $this->findYieldsNames();

            if($yieldsNamesArray){
                foreach ($yieldsNamesArray as $yieldsName)
                {
                    $this->initialYields($yieldsName);
                }
            }

            $this->content = $this->extendsContent;
        }
    }


    private function findExtends(): null|false
    {
        $filePathArray = [];

        // to use extends method or not
        preg_match("/s*@extends+\('([^)]+)'\)/",$this->content,$filePathArray);

        //  return isset($filePathArray[1]) ? $filePathArray[1] : false;
        return $filePathArray[1] ?? false;
    }

    private function findYieldsNames(): null|false
    {
        $yieldsNamesArray = [];

        // to use extends method or not
        preg_match_all("/s*@yield+\('([^)]+)'\)/",$this->extendsContent,$yieldsNamesArray,PREG_UNMATCHED_AS_NULL);

        // return isset($yieldsNamesArray[1]) ? $yieldsNamesArray[1] : false;
        return $yieldsNamesArray[1] ?? false;
    }


    private function initialYields($yieldsName)
    {
        $string = $this->content;
        $startWord = "@section('" . $yieldsName . "')";
        $endWord = "@endsection";


        // find yield value in child view
        // if yield parent is define in extends view
        // example @yield('content') -> @section('content')
        $startPos = strpos($string,$startWord);
        if($startPos === false){

            // remove @yield from extends view
            return $this->extendsContent = str_replace("@yield('$yieldsName')","",$this->extendsContent);
        }
    }

}