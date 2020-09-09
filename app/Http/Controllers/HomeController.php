<?php

namespace App\Http\Controllers;

use App\Application;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Category $allcategories, Application $allapplication)
    {

        return view('home', ['categories' => $allcategories->all(), 'allapps' => $allapplication->all()]);
    }

    // public function show($slug)
    // {
    //     dd('llega')
    //     $categories = Category::all();

    //     $state = State::where('description', 'No-Purcharsed')->first();

    //     $user = User::where('slug',$slug)->first();

    //     $allapps = ApplicationUserState::where('user_id', $user->id)->where('state_id', $state->id)
    //         ->join('applications', 'applications.id', '=', 'applications_users_states.application_id')
    //         ->select('applications.id', 'name', 'price', 'description', 'image_src')
    //         ->get();


    //     return view('home', compact('allapps','categories'));
    // }
}
