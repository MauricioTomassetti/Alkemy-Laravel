<?php

namespace App\Http\Controllers;

use App\Application;
use App\ApplicationUserState;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ApplicationDeveloperService;
use App\Services\ApplicationClientService;

class ClientController extends Controller
{

    public function index(ApplicationClientService $application)
    {
        $allapps = $application->getAppsBought();

        if ($allapps->count() == 0)
            return view('client.index', compact('allapps'))->with('message', config('constants.app_no_bought'));

        return view('client.index', compact('allapps'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Application $application, Request $request)
    {

        $application->users()->attach(Auth::id(), ['application_id' => $request->input('app_id'), 'state_id' => 2]);

        return response()->json(['url' => route('home')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application, Request $request)
    { 
        $application::findOrFail($request->id)->users()->detach();
     
    }
}
