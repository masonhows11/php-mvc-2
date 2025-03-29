<?php

namespace System\Database\Traits;

use System\Database\DBConnection\DBConnection;

trait HasCrud
{

    // space in query string is very, very important

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


    protected function save(): \System\Database\ORM\Model
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
        $this->resetQuery();


        if (!isset($this->{$this->primaryKey})) {

            $object = $this->findLastStoreRecord(DBConnection::newInsertId());
            // get default properties define in class & store in $defaultVars
            $defaultVars = get_class_vars(get_called_class());
            // get all properties define in obj of model/class & store in $allVars
            $allVars = get_object_vars($object);

            // compare to array and return different items
            $differentVars = array_diff(array_keys($allVars), array_keys($defaultVars));
            foreach ($differentVars as $attribute) {

                $this->inCastAttributes($attribute) ?
                    $this->registerAttribute($this, $attribute, $this->castEncodeValue($attribute, $object->$attribute)) :
                    $this->registerAttribute($this, $attribute, $object->$attribute);
            }

        }

        $this->resetQuery();
        $this->setAllowedMethods(['update', 'delete', 'find']);

        return $this;

    }

    protected function all(): array
    {
        $this->setSql("SELECT * FROM " . $this->getTableName());
        $statement = $this->executeQuery();
        $data = $statement->fetchAll();
        if ($data) {
            $this->arrayToObjects($data);
            return  $this->collection;
        }
        return [];

    }

    protected function find($id)
    {
        $this->setSql("SELECT * FROM " . $this->getTableName());
        $this->setWhere("AND", $this->getAttributeName($this->primaryKey) . " = ? ");
        $this->addValue($this->primaryKey, $id);
        $statement = $this->executeQuery();
        $data = $statement->fetch();
        $this->setAllowedMethods(['update', 'delete', 'find']);
        if ($data)
        {
            return  $this->arrayToAttributes($data);
        }
        return [];
    }


    protected function delete($id = null)
    {

        $object = $this; // refer to current model -> user / category / product
        $this->resetQuery();
        if ($id) {
            $object = $this->find($id);
            $this->resetQuery();
        }

        $object->setSql("DELETE FROM " . $object->getTableName());
        $object->setWhere("AND", $this->getAttributeName($this->primaryKey) . " = ? ");
        $object->addValue($object->primaryKey, $object->{$object->primaryKey});

        return $object->executeQuery();

    }

    //    protected function findLastStoreRecord(false|string $newInsertId)
    //    {
    //
    //    }


}
