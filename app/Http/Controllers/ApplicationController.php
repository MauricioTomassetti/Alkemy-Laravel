<?php

namespace App\Http\Controllers;

use App\Application;
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
    public function index()
    {

        //   $apps = Application::all()->where('id', Auth::id());

        return view('developer.applicationList', compact('apps'));
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
     * @param  \Illuminate\Http\Request  $request
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {

        return view('developer.application', compact('application'));
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
    public function update(Application $application, ApplicationStoreRequest $request)
    {
        $application->update($request->except(['name', 'category_id']));

        return redirect('/me/my-list-app');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        //$application->delete();

        Application::find($id)->delete();

        //    $application->delete();

        return redirect('/me/my-list-app');
    }
}
