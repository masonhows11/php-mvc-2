<?php

namespace System\View;

use System\View\Traits\ViewLoader;
class ViewBuilder
{
    use ViewLoader;

    public $content;

    public function run($path)
    {

        $this->content = $this->viewLoader($path);
        
    }

}