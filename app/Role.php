<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name_role', 'description_role'
    ];


    public function users()
    {
        return $this->belongsTo(User::class)->withTimestamps();
    }
}
