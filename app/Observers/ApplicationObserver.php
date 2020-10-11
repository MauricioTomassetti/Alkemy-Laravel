<?php

namespace App\Observers;

use App\Application;
use App\Services\ApplicationService;

class ApplicationObserver
{
    /**
     * Handle the application "created" event.
     *
     * @param  \App\Application  $application
     * @return void
     */
    public function created(Application $application)
    {
        //
    }

    /**
     * Handle the application "updated" event.
     *
     * @param  \App\Application  $application
     * @param  ApplicationService $applicationService
     * @return void
     */
    public function updated(Application $application, ApplicationService $aplicationService)
    {
        //
    }

    /**
     * Handle the application "deleted" event.
     *
     * @param  \App\Application  $application
     * @return void
     */
    public function deleted(Application $application)
    {
        //
    }

    /**
     * Handle the application "restored" event.
     *
     * @param  \App\Application  $application
     * @return void
     */
    public function restored(Application $application)
    {
        //
    }

    /**
     * Handle the application "force deleted" event.
     *
     * @param  \App\Application  $application
     * @return void
     */
    public function forceDeleted(Application $application)
    {
        //
    }
}
