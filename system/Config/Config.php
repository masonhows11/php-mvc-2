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


    private function initialConfigArray(): void
    {

         // dirname -> Returns a parent directory's path
        $configPath = dirname(dirname(__DIR__)).'/config';
        // read all config php files from config dir as array
        foreach (glob($configPath.'*.php') as $filename)
        {
            // get file content and put into $config var
            $config = require $filename;
            $key = $filename;
            $key = str_replace($configPath,"",$key);
            $key = str_replace('.php',"",$key);

            $this->config_nested_array[$key] = $config;
        }

        $this->initialDefaultValues();
        $this->config_dot_array = $this->array_dot($this->config_nested_array);

    }

    private function array_dot(): array
    {

        return  [];
    }

    private function initialDefaultValues()
    {

        $temporary = str_replace($this->config_dot_array['app']['BASE_URL'],'',explode('?',$_SERVER['REQUEST_URI'][0]));
        $temporary === "/" ? $temporary = "" : $temporary = substr($temporary,1);

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