<?php

namespace System\View;

class Composer
{

    private static $instance;

    private array $vars = [];

    private array $viewArray = [];

    private function __construct()
    {

    }


    private function setViewArray($viewArray)
    {
        $this->viewArray = $viewArray;

    }
    private static function getInstance()
    {
        if(empty(self::$instance))
        {
            self::$instance = new self;
            return self::$instance;
        }
    }

}