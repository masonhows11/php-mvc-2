<?php

namespace System\Database\Traits;

trait HasAttributes
{
    private function registerAttribute($object, string $attribute, $value)
    {

        // like cast in laravel cast to get or cast to write
        // $object->$attribute example $user->name or $product->price
        $this->inCastAttributes($attribute) == true ?

        $object->$attribute = $this->castDecodeValue($attribute, $value) :

        $object->$attribute = $value;

    }


    protected function arrayToAttribute(array $array,$object = null)
    {

        if(!$object){
            $className =
        }
    }


    protected function arrayToObjects()
    {

    }

    private function inHiddenAttributes()
    {

    }

    private function inCastAttributes()
    {
        return;
    }

    private function castDecodeValue()
    {

    }

    private function castEncodeValue()
    {

    }


    protected function arrayToCastEncodeValue()
    {

    }
}