<?php

namespace App\Models;

use AllowDynamicProperties;
use System\Database\ORM\Model;

#[AllowDynamicProperties]
class Category extends Model
{

    protected string $table = 'categories';

    protected array $fillable = ['title'];

    protected array $casts = [];



    public function posts()
    {
        return
            $this->hasMany('app\Models\Post','cat_id', 'id');
    }

}