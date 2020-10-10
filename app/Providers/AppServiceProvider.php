<?php

namespace App\Providers;

use App\Application;
use App\Observers\ApplicationObserver;
use App\Services\ApplicationClientService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(ApplicationClientService $application)
    {

        $categories =  $application->getCategories();
       
        View::share('categories',  $categories );

        Application::observe(ApplicationObserver::class);
    }
}
