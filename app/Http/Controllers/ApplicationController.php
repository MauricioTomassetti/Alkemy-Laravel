<?php

namespace App\Http\Controllers;

use App\ApplicationUserState;
use App\Application;
use App\Category;
use App\Http\Requests\ApplicationStoreRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Application $application)
    {

        $myApps = $application->whereIn('id', function ($query) {
            $query->select('application_id')->from('applications_users_states')
                ->where('applications_users_states.user_id', Auth::id())
                ->where('state_id', 4)->get();
        })
            ->get();

        if ($myApps->count() == 0)
            return view('developer.index', ['myapps' => $myApps, 'messageNotAppCreated' => 'Usted no tiene ninguna applicacion creada']);

        return view('developer.index', ['myapps' => $myApps, 'messageNotAppCreated' => '']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        $listCategory = $category->all();
        return view('developer.applicationCreate', compact('listCategory'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Application $application, ApplicationUserState $applicationUserState, Request $request)
    {
        // return Validator::make($data, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        //     'type-user' => ['required', 'string'],
        // ]);
        $data = $this->validate($request, [
            'name'         => 'required|min:3|max:190',
            'category_id'   => 'required',
            'price'         => 'required|between:0,9999.99',
            'description'   => 'required|min:3|max:900',
        ]);

        $data['slug'] = Str::slug($request->name . Str::random(50), '-');
        $data['vote'] = 0;
        //$validatedData['slug'] = Str::slug($validatedData['slug'], '-');


        // $data = [
        //     'name' => $request->name,
        //     'category_id' => $request->category,
        //     'slug' => str_slug('fooBar')($request->name, '-');
        //     'price' => $request->price,
        //     'description' => $request->description
        // ];

        if ($files = $request->file('image')) {
            $destinationPath = 'images/applications/';
            $fileImage = $files->getClientOriginalName();
            $fileForCreate = "$destinationPath" . "$fileImage";

            $files->move($destinationPath, $fileImage);
            $data['image_src'] = $fileForCreate;
        }

        $myNewApp = $application->create($data);
        $user = User::findOrFail(Auth::id());
        $applicationUserState->users()->attach($user, ['application_id' => $myNewApp->id, 'state_id' => 4]);



        return redirect()
            ->route('me.list', Auth::user()->name)
            ->with('message', 'Aplicacion Creada con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category, Application $application)

    {
        $appsNotBuy = $application->whereNotIn('id', function ($query) {
            $query->select('application_id')->from('applications_users_states')
                ->where('applications_users_states.user_id', Auth::id())
                ->where('state_id', 2)->get();
        })->where('category_id', $category->id)->get();

        if ($appsNotBuy->count() == 0)
            return view('client.applicationCategory', ['categories' => $category->all(), 'applicationsCategory' => $appsNotBuy, 'message' => 'Su usuario, ya no tiene mas aplicaciones para poder comprar']);

        return view('client.applicationCategory',  ['categories' => $category->all(), 'applicationsCategory' => $appsNotBuy, 'message' => '']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {

        $app = $application
            ->join('categories', 'categories.id', '=', 'applications.category_id')
            ->where('applications.id', $application->id)
            ->select('applications.id', 'applications.name as nameapp', 'applications.slug', 'categories.name as namecat', 'price', 'image_src')
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
        $dataForUpdate = ['price' => $request->price];

        if ($files = $request->file('image')) {
            $destinationPath = 'images/applications/';
            $fileImage = $files->getClientOriginalName();
            $fileForUpdate = "$destinationPath" . "$fileImage";
            //You can also check existance of the file in storage.
            if (Storage::exists($fileForUpdate)) {
                unlink($fileForUpdate); //delete from storage
                // Storage::delete($file_path); //Or you can do it as well
            }

            $files->move($destinationPath, $fileImage);
            $dataForUpdate['image_src'] = $fileForUpdate;
        }

        $application->where('id', $application->id)->update($dataForUpdate);


        return redirect()
            ->route('me.list', Auth::user()->name)
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
