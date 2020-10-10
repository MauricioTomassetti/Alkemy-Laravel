<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Services\ApplicationClientService;

class HomeController extends Controller
{
    public function index(ApplicationClientService $application)
    {
        
        $allapps = $application->getAppsCanBuy();

        if (Auth::check()) {
            if ($allapps->count() == 0)
                return view('home', compact('allapps'))->with('message', config('constants.app_no_more_buy'));
        }

        return view('home', compact('allapps'));
    }
}
