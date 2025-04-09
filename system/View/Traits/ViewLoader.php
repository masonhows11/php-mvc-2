<?php

namespace System\View\Traits;

use Exception;

trait ViewLoader
{
    private array $viewNameArray = [];


    private function viewLoader($path)
    {
        $dir = trim($path," .");

        $dir = str_replace(".","/",$dir);

        // to check files/directories is exits
        if(file_exists( dirname(dirname(dirname(__DIR__)))."/resources/view/$dir.php" ))
        {

            $this->registerView($dir);
            $viewContents = htmlentities(file_get_contents( dirname(dirname(dirname(__DIR__)))."/resources/view/$dir.php" ));   
            return $viewContents;
            
        }else {

            throw new Exception('view not found! 404');
        }
    }


    private function registerView($view): void
    {
        $this->viewNameArray[] = $view;
    }


}