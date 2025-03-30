<?php

namespace System\Database\Traits;

trait HasSoftDelete
{



    protected function deleteModel($id = null)
    {
        $object = $this; // refer to current model -> user / category / product

        if ($id)
        {
            $this->resetQuery();
            $object = $this->findMethod($id);

        }
        if($object)
        {
            $object->resetQuery();
            $object->setSql("UPDATE ".$object->getTableName()." SET ".$this->getAttributeName($this->deleteAt)." = NOW()");
            $object->setWhere("AND", $this->getAttributeName($object->primaryKey) . " = ? ");
            $object->addValue($object->primaryKey, $object->{$object->primaryKey});
            return $object->executeQuery();
        }


    }
    

}