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

        $appConfigs = require dirname(dirname(__DIR__)).'/config/app.php';
        $providers = $appConfigs['providers'];
        // call & run each provider -> make obj from provider item array
        // & call boot method
        foreach ($providers as $provider){

            $providerObj = new $provider();
            $providerObj->boot();

        }

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