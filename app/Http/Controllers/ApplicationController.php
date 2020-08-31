<?php

namespace App\Http\Controllers;

use App\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user =  Auth::user()->id;

        $apps = Application::where('user_id', $user)->get();

        return view('developer.applicationList', compact('apps'));
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
    public function store(Request $request)
    {

        $data = request()->validate([
            'name' => '',
            'price' => '',
            'id_category' => '',
            'user_id' => '',
            'vote' => '',
            'image_src' => '',
            'created_at' => '',
            'updated_at' => ''
        ]);


        $app = Application::create($data);

        return redirect('/me/app/' . $app->id);
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
    public function update(Application $application)
    {
        //$data = $application->except(['name', 'id_category']);

        $data = request()->validate([
            'name' => '',
            'price' => '',
            'id_category' => '',
            'user_id' => '',
            'vote' => '',
            'image_src' => '',
            'created_at' => '',
            'updated_at' => ''
        ]);
        $application->update($data);

        return redirect('/me/app/' . $application->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        $application->delete();

        return redirect('/me/listApp');
    }
}
