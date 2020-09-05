<?php

namespace App\Http\Controllers;

use App\Application;
use App\ApplicationUserState;
use App\Http\Requests\ApplicationStoreRequest;
use App\State;
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
    public function index(ApplicationUserState $applicationuserstate, $id)
    {
        $state = State::where('description', 'Purcharse')->first();

        $buyapps = $applicationuserstate::where('user_id', $id)->where('state_id', $state->id)
            ->join('applications', 'applications.id', '=', 'applications_users_states.id')
            ->select('applications.id', 'name', 'price', 'description', 'image_src')
            ->get();

        return view('client.index', compact('buyapps'));

        // return view ('client.index');
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
    public function store(Application $application, Request $request)
    {

        $state = State::where('description', 'Purcharse')->first();
        $user = Auth::id();
        $app = $application::find(($request->input('app_id')));

        ApplicationUserState::where('user_id', $user)
            ->where('application_id', $app->id)->where('state_id', 2)
            ->delete();

        $app->users()->attach($user, ['state_id' => $state->id]);
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
    public function destroy(ApplicationUserState $app, $id)

    {
        //$user =  Application::find($id);

        //dd($user->users()->where('id', 1)->detach($user->id));
        // $app = $application::find($id);
        //  dd($app::all());

        $state = State::where('description', 'Purcharse')->first();


        $app->where('application_id', $id)->where('user_id', Auth::id())->where('state_id', $state->id)->delete();

        // dd(Application::find($id)->users()->detach($app::all()->pluck('application_id')));


        //$app_state = $application::all();

        //  dd($app_state->users());

        //  dd($app_state->users()->get());

        //dd($user->get('id'));
        //$application->users()->where('user_id', Auth::id())->where('state_id', 2)->wherePivot('application_id', $id)->detach($id);

        // $app->users()->where('application_id', $id)->detach();

        //  $app->users()->detach($id);
    }
}
