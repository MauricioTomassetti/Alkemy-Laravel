<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description'
    ];


    public function application()
    {
        $this->belongsTo(Application::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
