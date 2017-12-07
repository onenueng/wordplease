<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class APIsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Contracts\PatientDataAPI','App\APIs\FakePatientData');
    }
}
