<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['name', 'price', 'category_id', 'vote', 'image_src'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'applications_users_states', 'application_id', 'user_id')
            ->withPivot('state_id')->withTimestamps();
    }


    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function logs()
    {
        return $this->belongsToMany(Log::class)->withTimestamps();;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
