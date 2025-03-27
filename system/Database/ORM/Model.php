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

    protected $table ;
    protected $fillable = [];

    protected  $hidden = [];

    protected $casts = [];

    protected  $primaryKey =  'id';

    protected $createdAt = 'created_at';
    protected $updatedAt = 'updated_at';

    protected $deleteAt = null;

    protected $collection = [];


}