<?php

namespace App\Http\Controllers;

use App\Application;
use App\Category;
use App\Http\Requests\ApplicationStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ApplicationDeveloperService;
use App\Services\ApplicationClientService;


class ApplicationController extends Controller

{

    public function index(ApplicationDeveloperService $application)
    {
        $myApps = $application->getApplicationForDeveloper();

        if ($myApps->count() == 0)
            return view('developer.index', compact('myApps'))->with('message', config('constants.no_app_create'));

        return view('developer.index', compact('myApps'));
    }


    public function create(ApplicationClientService $category)
    {
        $listCategory = $category->getCategories();

        return view('developer.applicationCreate', compact('listCategory'));
    }

    public function store(ApplicationDeveloperService $application, ApplicationStoreRequest $request)
    {
        
        $application->createApp($request);

        return redirect()->route('me.list', Auth::user()->name)->with('messageCreateAppSuccess', config('constants.app_create'));
    }

    public function show(ApplicationClientService $app, Application $application)
    {
      
        $showButtonDesired = true;
      
        $appState = $app->getApplicationsDetail($application);
        
        if (Auth::check()) {
            $user_rol = Auth::user()->roles->first()->name_role;

            if (!$appState["Bought"])
                return view('client.appDetail')->with('message', config('constants.app_obtained_yet'));

            elseif (!$appState["DesiredApp"]) {
                $showButtonDesired = !$showButtonDesired = true;;
                return view('client.appDetail', compact('application', 'user_rol','showButtonDesired'));

            } else
                return view('client.appDetail', compact('application','user_rol','showButtonDesired'));
        }

        return view('client.appDetail', compact('application','showButtonDesired'));
    }


    public function edit(ApplicationDeveloperService $app, Application $application)
    {

        $app = $app->getFormForEdit($application);
      
        return view('developer.applicationEdit', compact('app'));
    }


    public function update(ApplicationDeveloperService $app, Application $application,Request $request)
    {
        $app->updateApp($application, $request);

        return redirect()->route('me.list', Auth::user()->name);
    }


    public function destroy(ApplicationDeveloperService $app, Application $application)
    {
        $app->deleteApplication($application);

        return redirect()->route('me.list', Auth::user()->name);
    }


    public function desiredApp(ApplicationClientService $app, Application $application)
    {
    
       $appDesired = $app->getApplicationDesired($application);

        if( $appDesired->count() > 0 )
        return response()->json(['message' => config('constants.app_desired_add')], 405); 

        $application->users()->attach(Auth::id(), ['application_id' => $application->id, 'state_id' => 1]);

        return response()->json(['message'=> config('constants.app_desired')]);
        
    }


    public function removeDesiredApp(Application $application)
    {

        $application->users()->detach();
        return response()->json(['message'=> config('constants.app_desired')]);
        
    }



    public function showDesiredApp(ApplicationClientService $application,Request $request)
    {

        $appsDesired = $application->getAppsDesired($request->id);

        return response()->json(['appsDesired'=> $appsDesired]);
    }


    public function showAppNotBuyWhitCategory(ApplicationClientService $application, Category $category)
    {
        $allapps = $application->getAppsCanBuyWhitCategory($category->id);

        if ($allapps->count() == 0)
            return view('client.index', compact('allapps'))->with('message', config('constants.app_no_more_buy'));
        return view('client.index',  compact('allapps'));
    }

    public function  showListWhitVote(ApplicationClientService $application)
    {
        $allapps = $application->getListWhitVotes();

        if ($allapps->count() == 0)
            return view('client.index', compact('allapps'))->with('message', config('constants.app_no_more_buy'));
        return view('client.index',  compact('allapps'));
    }
}
