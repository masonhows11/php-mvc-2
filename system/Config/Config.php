<?php

namespace System\Config;

class Config
{


    private static $instance;

    private array $config_nested_array = [];
    private array $config_dot_array = [];



    /**
     * Class constructor.
     */
    private function __construct()
    {
        $this->initialConfigArray();
    }


    private function initialConfigArray(){

    }


    

}