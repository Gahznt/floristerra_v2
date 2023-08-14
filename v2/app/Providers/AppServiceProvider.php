<?php

namespace App\Providers;

use App\Models\contasModel;
use Illuminate\Support\ServiceProvider;
use App\Observers\DatabaseLogObserver;

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
    public function boot()
    {
        contasModel::observe(DatabaseLogObserver::class);
    }
}
