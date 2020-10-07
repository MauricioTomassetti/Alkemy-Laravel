<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ApplicationUserState extends Model

{
    protected $table = 'applications_users_states';


    protected $fillable = ['application_id', 'user_id', 'state_id'];


    public function user()
    {
        return $this->belongsToMany(User::class, 'applications_users_states', 'application_id', 'user_id')->withPivot('state_id')->withTimestamps();
    }

    public function application()
    {
        return $this->belongsToMany(Application::class);
    }
}
