<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];


    public function applications()
    {
        $this->hasMany(Application::class, 'id');
    }
}
