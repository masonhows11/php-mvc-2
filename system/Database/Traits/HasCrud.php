<?php

namespace System\Database\Traits;

use System\Database\DBConnection\DBConnection;

trait HasCrud
{


    //to config fillable[] property
    protected function fill(): string
    {
        // check attribute is in cast or not
        $fillArray = array();
        foreach ($this->fillable as $attribute) {
            if (isset($this->$attribute)) {
                $fillArray[] = $this->getAttributeName($attribute) . " = ?";
                // array_push($fillArray,$this->getAttributeName($attribute) . " = ?");
                //$this->inCastAttributes($attribute) == true
                $this->inCastAttributes($attribute) ?
                    $this->addValue($attribute, $this->castEncodeValue($attribute, $this->$attribute)) :
                    $this->addValue($attribute, $this->$attribute);
            }
        }
        return implode(', ', $fillArray);
    }


    protected function save()
    {
        $fillString = $this->fill();
        // how find out we use this method
        // for save new model or update current model
        if (!isset($this->{$this->primaryKey})) {
            $this->setSql("INSERT INTO" . $this->getTableName() . " SET $fillString, " . $this->getAttributeName($this->createdAt) . "=Now()");

        } else {

            $this->setSql("UPDATE INTO" . $this->getTableName() . " SET $fillString, " . $this->getAttributeName($this->updatedAt) . "=Now()");
            $this->setWhere("AND", $this->getAttributeName($this->primaryKey) . " = ?");
            $this->addValue($this->primaryKey, $this->{$this->primaryKey});
            //  $this->primaryKey,$this->{$this->primaryKey}
            //  user->id = 2
            //  $this->primaryKey : user->id
            //  $this->{$this->primaryKey} 2
        }
        $this->executeQuery();

        
    }


}
