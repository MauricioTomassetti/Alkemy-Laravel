<?php

namespace App\Http\Controllers;

use App\ApplicationUserState;
use App\Application;
use App\ApplicationLog;
use App\Category;
use App\Http\Requests\ApplicationStoreRequest;
use App\LogApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ApplicationService;
use App\User;

class ApplicationController extends Controller

{

    public function index(Application $application)
    {
        $myApps = $application->getApplicationForDeveloper();

        if ($myApps->count() == 0)
            return view('developer.index')->with('message', config('constants.no_app_create'));

        return view('developer.index', compact('myApps'));
    }


    public function create(Category $category)
    {
        //Consulto las categorias que hay disponible para asignar
        $listCategory = $category->all();

        return view('developer.applicationCreate', compact('listCategory'));
    }


    /**
     *Comentario: El mensaje No se muestra luego de crear una App.
     **/
    public function store(Application $application, ApplicationUserState $applicationUserState, ApplicationLog $logprice, ApplicationService $appStore, ApplicationStoreRequest $request)
    {
        $data = $request->all();

        //Valido la imagen de carga apoyandome en una clase.
        $appDate = $appStore->storeImage($data, $application, $request);

        //Creo un registro de applicacion
        $appCreate = $application->create($appDate);

        //Creo un registro que relaciona usuario - applicacion - estado
        $applicationUserState->user()->attach(Auth::id(), ['application_id' => $appCreate->id, 'state_id' => 4]);

        //Creo un registro del precio y la applicacion.
        $logprice->create(['application_id' => $appCreate->id, 'price' => $appCreate->price]);

        return redirect()->route('me.list', Auth::user()->name)->with('messageCreateAppSuccess', config('constants.app_create'));
    }

    public function show(Application $application)

    {
        $appWasPurcharse = $application->getDetailApplicationsCanBuy($application->id);

        if ($appWasPurcharse > 0)
            return view('client.appDetail')->with('message', 'Usted ya pose esta applicacion en su perfil');

        return view('client.appDetail', compact('application'));
    }


    public function edit(Application $application)
    {

        $app = $application->getFormForEdit();

        return view('developer.applicationEdit', compact('app'));
    }


    public function update(Application $application, ApplicationService $appUpdate, ApplicationLog $logprice, Request $request)
    {

        $application->update([$appUpdate->updateImage($application, $request)]);
        //Creo un registro del precio y la applicacion.
        $logprice->create(['application_id' => $application->id, 'price' => $request->price]);

        return redirect()->route('me.list', Auth::user()->name)->with('message', 'Aplicacion actualizada con exito!');
    }

    /**
     *Comentario: Cuando llamo directamente al modelo, sin ponerle un where referenciandolo ocurre un error de argumentos. cuando quiero actualizar el estado.
     **/
    public function destroy(Application $application, ApplicationUserState $applicationUserState)
    {

        $application->where('id', $application->id)->update(['is_online' => false]);

        //$applicationUserState->where('application_id', $application->id)->where('user_id', Auth::id())->where('state_id', 4)->delete();
        $applicationUserState->user()->detach();


        return redirect()->route('me.list', Auth::user()->name)->with('message', 'Aplicacion Eliminada!');
    }

    public function showAppNotBuyWhitCategory(Application $application, Category $category)
    {
        $allapps = $application->getAppsCanBuyWhitCategory($category->id);
        $categories = $application->getCategories();

        if ($allapps->count() == 0)
            return view('client.index', compact('categories', 'allapps'))->with('message', config('constants.app_no_more_buy'));
        return view('client.index',  compact('categories', 'allapps'));
    }

    public function  showListWhitVote(Application $application)
    {
        $allapps = $application->getListWhitVotes();
        $categories = $application->getCategories();

        if ($allapps->count() == 0)
            return view('client.index', compact('categories', 'allapps'))->with('message', config('constants.app_no_more_buy'));
        return view('client.index',  compact('categories', 'allapps'));
    }
}
