<?php

namespace System\Database\ORM;

use System\Database\Traits\HasAttributes;
use System\Database\Traits\HasCrud;
use System\Database\Traits\HasSoftDelete;
use System\Database\Traits\HasRelation;
use System\Database\Traits\HasQueryBuilder;
use System\Database\Traits\HasNethodCaller;


abstract  class Model
{
    use HasNethodCaller,HasQueryBuilder,HasRelation,HasSoftDelete,HasAttributes,HasCrud;

    protected string $table;
    protected array $fillable = [];

    protected array  $hidden = [];

    protected array $casts = [];

    protected  string $primaryKey =  'id';

    protected string $createdAt = 'created_at';
    protected string $updatedAt = 'updated_at';

    protected bool|null $deleteAt = null;

    protected array $collection = [];


}