<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['name', 'price', 'category_id', 'vote', 'image_src'];


    public function categories()
    {
        return $this->BelongsTo(Category::class);
    }

    public function logs()
    {
        return $this->belongsToMany(Log::class)->withTimestamps();
    }
}
