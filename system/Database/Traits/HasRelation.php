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
        // sql = 'select phones.* from users join  phones on users.id = phones.user_id';
        // a left table like users
        // b right table like phone
        // user hasOne phone

        $this->setSql( "SELECT `b`.* FROM `{$table}` AS `a` JOIN ".$this->getTableName()." AS `b` ON `a`.`{$otherKey}` = `b`.`{$foreignKey}` ");
        $this->setWhere('AND',"`a`.`{$otherKey}` = ? ");
        $this->table = 'b';
        $this->addValue($otherKey,$otherKeyValue);
        $statement = $this->executeQuery();
        $data = $statement->fetch();
        if($data){
            return $this->arrayToAttributes($data);
        }
        return null;

    }


}
