<?php

namespace App\Http\Controllers;

use App\Application;
use App\ApplicationUserState;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
 
    public function index(Application $application, Category $categories)
    {
        $allapps = $application->getAppsBought();
        $categories = $application->getCategories();

            if ($allapps->count() == 0 )
                    return view('client.index', compact('categories','allapps'))->with('message', config('constants.app_no_bought'));          
       
            return view('client.index',compact('categories','allapps'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicationUserState $applicationUserState, Request $request)
    {

        $user = User::findOrFail(Auth::id());
        $applicationUserState->users()->attach($user, ['application_id' =>$request->input('app_id'),'state_id' => 2]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApplicationUserState $applicationUserState, Request $request)
    {//tratar de poner el dettach
        //$applicationUserState->applications()->detach($request->input('app_id'));
        $applicationUserState->where('application_id', $request->input('app_id'))->where('user_id', Auth::id())->where('state_id', 2)->delete();
            
    }
}
