<?php

namespace System\View\Traits;

trait IncludeContent
{


    private function checkIncludesContent(): void
    {
        while (1) {
            $includesNamesArray = $this->findIncludesNames();
            if(!empty($includesNamesArray)){
                foreach ($includesNamesArray as $includeName){
                    $this->initialIncludes($includeName);
                }
            }
        }
    }


    private function findIncludesNames(): null|false
    {
        $includesNamesArray = [];

        // to use extends method or not
        preg_match("/@include+\('([^)]+)'\)/", $this->content, $includesNamesArray);

        return isset($includesNamesArray[1]) ? $includesNamesArray[1] : false;
        //return $includesNamesArray[1] ?? false;
    }


    /**
     * @throws \Exception
     */
    private function initialIncludes($includeName): array|string
    {
        // @include('views.404')
        return $this->content = str_replace("@include('$includeName')", $this->viewLoader($includeName), $this->content);

    }
}