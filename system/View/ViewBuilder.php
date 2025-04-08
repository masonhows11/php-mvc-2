<?php

namespace System\View;

use System\View\Traits\ViewLoader;
use System\View\Traits\ExtendContent;
class ViewBuilder
{
    use ViewLoader,ExtendContent;

    public $content;

    public function run($path)
    {

        $this->content = $this->viewLoader($path);

        $this->checkExtendsContent();
        
    }

}