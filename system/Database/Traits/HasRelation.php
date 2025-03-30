<?php

namespace System\Database\Traits;
trait HasRelation
{

    // relation between two  model/table or models/tables
    // one to one & reverse
    // one to many & reverse
    // mann to many & reverse


    protected function hasOne($model,$foreignKey,$localKey)
    {

        if($this->{$this->primaryKey}){

            $modelObject = new $model;
            return $modelObject->getHasOneRelation($this->table,$foreignKey,$localKey,$this->$localKey);
        }
        return null;
    }


    public function getHasOneRelation($table,$foreignKey,$otherKey,$otherKeyValue)
    {

        

    }


}
