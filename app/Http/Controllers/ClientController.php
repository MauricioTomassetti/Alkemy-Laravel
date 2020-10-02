<?php

namespace App\Http\Controllers;

use App\Application;
use App\ApplicationUserState;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Application $application)
    {

        $buyapps = $application->whereIn('id', function($query) {
                                                $query->select('application_id')->from('applications_users_states')
                                                    ->where('applications_users_states.user_id', Auth::id())->where('state_id', 2)->get();})->get();

                        if ($buyapps->count() == 0 )
                        return view('client.purcharseList', ['buyapps' => $buyapps,'message' => 'Su usuario, No realizo ninguna compra']);          
       
            return view('client.purcharseList', ['buyapps' => $buyapps,'message' => '']);

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
    public function store(ApplicationUserState $applicationUserState, Application $application, Request $request)
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
    public function destroy(ApplicationUserState $applicationUserState, $id)

    {
        $applicationUserState->where('application_id', $id)->where('user_id', Auth::id())->where('state_id', 2)->delete();
            
    }
}
