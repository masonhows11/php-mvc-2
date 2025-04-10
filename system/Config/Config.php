<?php

namespace System\Config;

use Exception;

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



    private static function getInstance(): Config
    {
            if(empty(self::$instance))
            {
                self::$instance = new self;
            }

            return self::$instance;
    }


    /**
     * @throws Exception
     */
    public static function get($key)
    {
        $instance = self::getInstance();
        if(isset($instance->config_dot_array[$key])){

            return $instance->config_dot_array[$key];

        }else{

            throw new Exception('"'. $key .'" not exist in config ');
        }
    }
    

}