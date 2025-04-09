<?php

namespace System\View;

use System\View\Traits\ViewLoader;
use System\View\Traits\ExtendContent;
use System\View\Traits\IncludeContent;
class ViewBuilder
{
    use ViewLoader,ExtendContent,IncludeContent;

    public $content;


    public function run($path)
    {

        $this->content = $this->viewLoader($path);

        $this->checkExtendsContent();

        $this->checkIncludesContent();
        
    }



}