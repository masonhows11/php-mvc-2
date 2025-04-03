<?php

namespace App\Models;

use System\Database\ORM\Model;

class Role extends Model
{
    protected string $table = 'roles';

    protected array $fillable = ['name'];

    protected array $casts = [];
}