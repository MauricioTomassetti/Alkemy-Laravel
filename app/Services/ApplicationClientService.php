<?php

namespace App\Services;

use App\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApplicationClientService extends Application
{
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
    * Obtengo las applicaciones que estan online y que puedo comprar.
    *
    * @return Paginate Application.
    */
    public function getAppsCanBuy()
    {
        return $this->application->whereNotIn('id', function ($query) 
        {
            $query->select('application_id')->from('applications_users_states')
                ->where('applications_users_states.user_id', Auth::id())
                ->where('state_id', 2)->get();
        })->where('is_online', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    /**
    * Obtengo la aplicacion que estoy siguiendo y/o deseadas,
    *Funciona como paso previo a guardar una nueva app para seguir, verificando que no este ya guardada
    *esa aplicacion para ese usuario en particular. El resultado lo utilizo para contabilizar
    *
    * @return Collection Model Application.
    * @param Model $application Intancia del modelo.
    */
    public function getApplicationDesired($application)
    {

        return $application->select('*')->from('applications_users_states')
            ->where('applications_users_states.user_id', Auth::id())
            ->where('application_id', $application->id)->get();
    }

    /**
    * Valido el uso del botton Agregar a deseados y Comprar.
    *
    * @return array $appState.
    * @param Instance $application from model Application.
    */
    public function getApplicationsDetail($application)
    {
        $appState["Bought"] = true;
        $appState["DesiredApp"] = true;

        $app = $application->select('*')->from('applications_users_states')
            ->where('applications_users_states.user_id', Auth::id())
            ->where('application_id', $application->id)->get();

        foreach ($app as $item) 
        {
            if ($item->state_id == 2)
            $appState["Bought"] = false;
        }

        if ($app->count() > 0)
            $appState["DesiredApp"] = false;
        return $appState;
    }


    /**
    * Obtengo las applicaciones que no fueron compradas y estan online.
    *
    * @return Paginate Application.
    * @param string $categorie identidicador de la categoria que estoy solicitando.
    */
    public function getAppsCanBuyWhitCategory($categorie)
    {
        return $this->application->whereNotIn('id', function ($query) {
            $query->select('application_id')->from('applications_users_states')
                ->where('applications_users_states.user_id', Auth::id())
                ->where('state_id', 2)->get();
        })->where('is_online', true)
            ->where('category_id', $categorie)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    /**
    * Obtengo las categorias y la cantidad de productos por cada una de ella.
    *
    * @return Collection Categories.
    */
    public function getCategories()
    {
        return $this->application->select('categories.id', 'categories.name', 'categories.slug', DB::raw('count(applications.id) as cantApp'))
            ->join('categories', 'applications.category_id', '=', 'categories.id')
            ->where('is_online', true)
            ->groupBy('categories.id', 'categories.name', 'categories.slug')
            ->orderBy('name')
            ->get();
    }

    /*
    * Obtengo las Applicaciones que ya compre esten online o no.
    *
    * @return Paginate Application.
    */
    public function getAppsBought()
    {
        return $this->application->whereIn('id', function ($query) {
            $query->select('application_id')->from('applications_users_states')
                    ->where('applications_users_states.user_id', Auth::id())->where('state_id', 2)->get();
        })->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    /**
    * Obtengo las applicaciones que son deseadas y/o siguiendo.
    * Para luego listarlas al usuario.
    *
    * @return Collection Application.
    */
    public function getAppsDesired()
    {
        return $this->application->whereIn('id', function ($query) {
            $query->select('application_id')->from('applications_users_states')
                ->where('applications_users_states.user_id', Auth::id())
                ->where('state_id', 1)->get();
        })->orderBy('created_at', 'desc')->get();
    }

    /**
    * Obtengo las aplicaciones mas votadas.
    *
    * @return Paginate Model Application.
    */
    public function getListWhitVotes()
    {
        return $this->application->where('vote', '>=', '2')->orderBy('vote', 'desc')->paginate(5);;
    }
}
