<?php

namespace System\Database\Traits;

use System\Database\DBConnection\DBConnection;

trait HasCrud
{


    //to config fillable[] property
    protected function fill()
    {
        // check attribute is in cast or not
        $fillArray = array();
        foreach ($this->fillable as $attribute) {

            if (isset($this->$attribute))
            {
                $fillArray[] = $this->getAttributeName($attribute) . " = ?";
                // array_push($fillArray,$this->getAttributeName($attribute) . " = ?");

                //$this->inCastAttributes($attribute) == true
                $this->inCastAttributes($attribute) ?
                $this->addValue($attribute,$this->castEncodeValue($attribute,$this->$attribute)) :
                $this->addValue($attribute,$this->$attribute);

            }

        }


        return implode(', ',$fillArray);
    }


}
