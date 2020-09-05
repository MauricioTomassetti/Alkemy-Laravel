<?php

namespace App\Http\Controllers;

use App\Application;
use App\Role;
use App\State;
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
    public function index()
    {
        $allapps = Application::all();
        $typeUser = Role::where('name_role', 'Cliente')->first();

        return view('home', compact('allapps', 'typeUser'));
    }
}
