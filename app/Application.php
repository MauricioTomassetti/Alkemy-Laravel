<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Application extends Model
{
    use Sluggable;

    protected $fillable = ['name', 'price', 'category_id', 'slug', 'description', 'vote', 'image_src', "is_online"];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'applications_users_states', 'application_id', 'user_id')->withPivot('state_id')->withTimestamps();
    }


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
