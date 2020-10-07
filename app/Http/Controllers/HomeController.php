<?php

namespace App\Http\Controllers;

use App\Application;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Application $application)
    {
        $categories = $application->getCategories();
        $allapps = $application->getAppsCanBuy();

        if (Auth::check()) {
            if ($allapps->count() == 0)
                return view('home', compact('categories', 'allapps'))->with('message', config('constants.app_no_more_buy'));
        }

        return view('home', compact('categories', 'allapps'));
    }
}
