<?php
namespace System\Database\Traits;
trait HasMethodCaller
{


    private array $allMethods =
        ['create','update','delete','all','find','save',
                           'where','whereOr','whereIn','whereNull','whereNotNull',
                           'limit','limit','orderBy','get','paginate'];


    // setAllowedMethods
    private array $AllowedMethods = ['create','update','delete','all','find','save',
        'where','whereOr','whereIn','whereNull','whereNotNull',
        'limit','limit','orderBy','get','paginate'];



    protected function  setAllowedMethods($array = []): void
    {
        $this->AllowedMethods =  $array ;
    }


}