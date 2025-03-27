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


    protected function arrayToAttribute(array $array, $object = null)
    {

        if (!$object) {
            $className = get_called_class();
            $object = new $className;
        }
        foreach ($array as $attribute => $value) {

            if ($this->inHiddenAttributes($attribute))
                continue;
            $this->registerAttribute($object,$attribute,$value);
        }

        return $object;
    }


    protected function arrayToObjects(array $array)
    {
        // creat nested array level
        $collection = [];

        foreach ($array as $value){
            $object = $this->arrayToAttribute($value);
            array_push($collection,$object);
        }

        $this->collection = $collection;
    }

    private function inHiddenAttributes($attribute): bool
    {
        return in_array($attribute,$this->hidden);
    }

    private function inCastAttributes($attribute): bool
    {
        return in_array($attribute,array_keys($this->casts));
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