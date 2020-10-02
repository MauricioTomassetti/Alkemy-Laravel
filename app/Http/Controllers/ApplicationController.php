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
    public function index(Application $application,ApplicationUserState $applicationUserState, $slug)
    {

        $myApps = $application->whereIn('id', function($query) {
            $query->select('application_id')->from('applications_users_states')
                                            ->where('applications_users_states.user_id', Auth::id())
                                            ->where('state_id', 4)->get();})
                                            ->get();

            if ($myApps->count() == 0 )
            return view('developer.index', ['myapps' => $myApps,'messageNotAppCreated' => 'Usted no tiene ninguna applicacion creada']);

    return view('developer.index', ['myapps' => $myApps,'messageNotAppCreated' => '']);
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
        $appsNotBuy = $application->whereNotIn('id', function($query) {
            $query->select('application_id')->from('applications_users_states')
                                            ->where('applications_users_states.user_id', Auth::id())
                                            ->where('state_id', 2)->get();})->where('category_id',$category->id)->get();

                if ($appsNotBuy->count() == 0 )
                return view('client.applicationCategory', ['categories' => $category->all(),'applicationsCategory' => $appsNotBuy,'message' => 'Su usuario, ya no tiene mas aplicaciones para poder comprar']);

        return view('client.applicationCategory',  ['categories' => $category->all(),'applicationsCategory' => $appsNotBuy,'message' => '']);
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
