<?php

namespace App\Models;

use System\Database\ORM\Model;

class Role extends Model
{
    protected string $table = 'roles';

    protected array $fillable = ['title','body','cat_id'];

    protected array $casts = [];
}