<?php


namespace System\Application;


class Application{



    public function __construct()
    {
        $this->loadProviders();
        $this->loadHelpers();
        $this->registerRoutes();
        $this->routing();
    }

    private function loadProviders()
    {


    }

    private function loadHelpers()
    {

    }

    private function registerRoutes()
    {
    }

    private function routing()
    {
        
    }


}