<?php

namespace System\Database\Traits;
trait HasQueryBuilder
{


    private string $sql = '';
    protected array $where = [];

    private array $orderBy = [];

    private array $limit = [];

    private array $values = [];

    private array $bindValues = [];



    protected function setSql($query): void
    {
        $this->sql = $query;
    }

    protected function getSql(): string
    {
        return $this->sql;
    }
    
    protected function resetSql(): void
    {
        $this->sql = '';
    }


    protected function setWhere($operator,$condition)
    {
      $array = ['operator' => $operator,'condition' => $condition];
      array_push($this->where , $array);

    }

    protected function resetWhere(): void
    {
       $this->where = [];

    }

    protected function setOrderBy($name,$expression)
    {
        array_push($this->orderBy,$name.' '.$expression);
    }

    protected function resetOrderBy(): void
    {
       $this->orderBy = [];
    }


    protected function setLimit($from,$number): void
    {
        $this->limit['from'] = (int)$from;
        $this->limit['number'] = (int)$number;
    }

    protected function resetLimit(): void
    {
        unset($this->limit['from']);
        unset($this->limit['from']);
    }


    protected function addValue($attribute,$value)
    {
        //// this for prepared bind
        
        // cat_id = 2 -> 3
        // attribute : cat_id = 2
        // value : 3
        // cat_id = 3

        // values cat_id = 2
        // bindValue 2

        $this->values[$attribute] = $value;
        array_push($this->bindValues,$value);

    }


    protected function removeValues(): void
    {
        $this->values  = [];
        $this->bindValues = [];
    }


    protected function resetQuery(): void
    {
        $this->resetSql();
        $this->resetWhere();
        $this->resetOrderBy();
        $this->resetLimit();
        $this->removeValues();
    }
}