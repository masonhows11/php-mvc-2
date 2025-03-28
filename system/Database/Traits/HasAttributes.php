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

        // creat first array from object in final result query as collection
        // like 0 = [
        //  name => ali001,
        //  f_name => ali,
        //  l_name => hasany,
        //  phone => 5551212,
        //  ]
        
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

    private function castDecodeValue($attributeKey,$value)
    {
        // unserialize -> for read the data

        if($this->casts[$attributeKey] == 'array' || $this->casts[$attributeKey] == 'object' )
        {
            return unserialize($value);
        }

        return  $value;
    }

    private function castEncodeValue($attributeKey,$value)
    {
        // serialize -> for store the data

        if($this->casts[$attributeKey] == 'array' || $this->casts[$attributeKey] == 'object' )
        {
            return serialize($value);
        }

        return  $value;
    }


    protected function arrayToCastEncodeValue($values)
    {
        $newArray = [];
        foreach ($values as $attribute => $value)
        {
            $this->inCastAttributes($attribute) ?
                $newArray[$attribute] = $this->castEncodeValue($attribute,$value) :
                $newArray[$attribute] = $value;
        }

        return $newArray;
    }
}