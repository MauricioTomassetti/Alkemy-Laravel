<?php

namespace App\Http\Controllers;

use App\ApplicationUserState;
use App\Application;
use App\Category;
use App\State;
use App\Http\Requests\ApplicationStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ApplicationUserState $applicationUserState, $slug)
    {
        $state = State::where('description', 'Created')->first();

        $myapps = $applicationUserState
            ::where('applications_users_states.slug', $slug)
            ->where('state_id', $state->id)
            ->join('applications', 'applications.id', '=', 'applications_users_states.application_id')
            ->select('applications.id', 'name', 'price', 'description', 'image_src')
            ->get();

        return view('developer.index', compact('myapps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd('aca');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Application $application, ApplicationStoreRequest $request)
    {
        $application->create($request->all());

        return redirect('/me/my-list-app');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category, Application $application)

    {
        dd($application);

        return $application;

        //$applicationsCategory = $application->where('id', $slug)->get();
        //$applicationsCategory = $application;

        //return view('client.applicationCategory', compact('applicationsCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application, $id)
    {
        $app = $application
            ->find($id)
            ->join('categories', 'categories.id', '=', 'applications.id')
            ->where('applications.id', $id)
            ->select('applications.id', 'applications.name as nameapp', 'categories.name as namecat', 'price', 'image_src')
            ->first();

        return view('developer.applicationEdit', compact('app'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Application $application, ApplicationStoreRequest $request)
    {
        $application->update($request->except(['name', 'category_id']));

        return redirect()
            ->route('/me/myListApp', Auth::user()->name)
            ->with('message', 'Aplicacion actualizada con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$application->delete();

        Application::find($id)->delete();

        // $application->delete();

        return redirect('/me/my-list-app');
    }

    public function showapp(Application $application, Request $request)
    {
        $appDetail = $application->where('id', $request->id)->get();

        return view('client.appDetail', compact('appDetail'));
    }
}
