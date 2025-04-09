<?php

namespace System\View;

use App\Providers\AppServiceProvider;
use Exception;
use System\View\Traits\ViewLoader;
use System\View\Traits\ExtendContent;
use System\View\Traits\IncludeContent;
class ViewBuilder
{
    use ViewLoader,ExtendContent,IncludeContent;

    public $content;


    /**
     * @throws Exception
     */
    public function run($path)
    {

        $this->content = $this->viewLoader($path);

        $this->checkExtendsContent();

        $this->checkIncludesContent();

        // setViews is call static method
        Composer::setViews($this->viewNameArray);

        $appServiceProvider = new AppServiceProvider();
        
    }



}