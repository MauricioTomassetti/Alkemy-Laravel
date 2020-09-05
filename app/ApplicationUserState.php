<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ApplicationUserState extends Model

{
    protected $table = 'applications_users_states';


    protected $fillable = ['application_id', 'user_id', 'state_id'];


    public function users()
    {
        return $this->belongsTo(User::class, 'applications_users_states');
    }

    public function application()
    {
        return $this->belongsTo(Application::class, 'applications_users_states');
    }
}
