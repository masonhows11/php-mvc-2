<?php

namespace System\View\Traits;

trait ViewLoader
{
    private array $viewNameArray = [];


    private function viewLoader($path)
    {
        $dir = trim($path," .");
    }


    private function registerView($view): void
    {
        $this->viewNameArray[] = $view;
    }


}