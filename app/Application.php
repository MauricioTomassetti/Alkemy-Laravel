<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Application extends Model
{
    protected $fillable = ['name', 'price', 'category_id', 'slug', 'description', 'vote', 'image_src', "is_online"];
    use Sluggable;

    public function categories()
    {
        return $this->BelongsTo(Category::class);
    }

    public function logs()
    {
        return $this->belongsToMany(Log::class)->withTimestamps();
    }

    //Obtengo las applicaciones creadas por un desarrollador.
    public function getApplicationForDeveloper()
    {

        return $this->whereIn('id', function ($query) {
            $query->select('application_id')->from('applications_users_states')
                ->where('applications_users_states.user_id', Auth::id())
                ->where('state_id', 4)->orderBy('created_at','desc')->get();
        })
            ->get();
    }

    //Obtengo el formulario para poder editar una aplicacion de un desarrollador.
    public function getFormForEdit()
    {

        return $this->join('categories', 'categories.id', '=', 'applications.category_id')
            ->where('applications.id', $this->id)
            ->select('applications.id', 'applications.name as nameapp', 'applications.slug', 'categories.name as namecat', 'price', 'image_src')
            ->first();
    }

    //Obtengo las aplicaciones que todavia no compre y que se encuentran online
    public function getAppsCanBuy()
    {
        return $this->whereNotIn('id', function ($query) {
            $query->select('application_id')->from('applications_users_states')
                ->where('applications_users_states.user_id', Auth::id())
                ->where('state_id', 2)->get();
        })->where('is_online', true)
            ->orderBy('created_at','desc')
            ->paginate(5);
        
    }

    //Obtengo la cantidad de applicaciones segun su categoria.
    public function getCategories()
    {
        return $this->select('categories.name','categories.slug',DB::raw('count(applications.id) as cantApp'))
                    ->join('categories','applications.category_id','=','categories.id')
                    ->groupBy('categories.name','categories.slug')
                    ->orderBy('name')
                    ->get();
    
    }

    //Obtengo las aplicaciones que ya compre y que se encuentran online o offline
    public function getAppsBought(){

        return $this->whereIn('id', function($query) {
            $query->select('application_id')->from('applications_users_states')
                ->where('applications_users_states.user_id', Auth::id())->where('state_id', 2)->get();
            }) ->orderBy('created_at','desc')
            ->paginate(5);
               

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
