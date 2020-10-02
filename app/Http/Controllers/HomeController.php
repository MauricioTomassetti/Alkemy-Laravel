<?php

namespace App\Http\Controllers;

use App\Application;
use App\Category;
use Illuminate\Support\Facades\Auth;

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
    public function index(Category $categories, Application $application)
    {
       
        if(Auth::check()){   
                $appsNotBuy = $application->whereNotIn('id', function($query) {
                            $query->select('application_id')->from('applications_users_states')
                                                            ->where('applications_users_states.user_id', Auth::id())
                                                            ->where('state_id', 2)->get();})->get();

                    if ($appsNotBuy->count() == 0 )
                    return view('home', ['categories' => $categories->all(),'allapps' => $appsNotBuy,'message' => 'Su usuario, ya no tiene mas aplicaciones para poder comprar']);     
            
        }

        return view('home', ['categories' => $categories->all(), 'allapps' => $application->all(),'message' => '']);
    }
}
