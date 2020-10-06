<?php

namespace App\Http\Controllers;

use App\ApplicationUserState;
use App\Application;
use App\Category;
use App\Http\Requests\ApplicationStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ApplicationService;


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
        $listCategory = $category->all();

        return view('developer.applicationCreate', compact('listCategory'));
    }


    /**
     *Comentario: El mensaje No se muestra luego de crear una App. 
     **/
    public function store(Application $application, ApplicationUserState $applicationUserState, ApplicationService $appStore, ApplicationStoreRequest $request)
    {
        $data = $request->all();

        $appStore->storeImage($data, $application, $applicationUserState, $request);

        return redirect()->route('me.list', Auth::user()->name)->with('messageCreateAppSuccess', config('constants.app_create'));
    }

    public function show(Application $application)

    {
        return view('client.appDetail', compact('application'));
    }


    public function edit(Application $application)
    {

        $app = $application->getFormForEdit();

        return view('developer.applicationEdit', compact('app'));
    }


    /**
     *Comentario: Cuando llamo directamente al modelo, sin ponerle un where ocurre un error de argumentos cuando quiero actualizar la imagen. 
     **/
    public function update(Application $application, ApplicationService $appUpdate, Request $request)
    {

        $application->where('id', $application->id)->update($appUpdate->updateImage($application, $request));

        return redirect()->route('me.list', Auth::user()->name)->with('message', 'Aplicacion actualizada con exito!');
    }

    /**
     *Comentario: Cuando llamo directamente al modelo, sin ponerle un where referenciandolo ocurre un error de argumentos. cuando quiero actualizar el estado.
     **/
    public function destroy(Application $application, ApplicationUserState $applicationUserState)
    {

        $application->where('id', $application->id)->update(['is_online' => false]);

        $applicationUserState->where('application_id', $application->id)->where('user_id', Auth::id())->where('state_id', 4)->delete();

        return redirect()->route('me.list', Auth::user()->name)->with('message', 'Aplicacion Eliminada!');
    }

    public function showAppNotBuyWhitCategory(Application $application, Category $categories) {

        $allapps = $application->getAppsCanBuy()->where('id',$categories->id);
        $categories = $application->getCategories();

        if ($allapps->count() == 0)
            return view('client.index', compact('categories','allapps'))->with('message' , config('constants.app_no_more_buy'));
        return view('client.index',  compact('categories', 'allapps'));
    }

}
