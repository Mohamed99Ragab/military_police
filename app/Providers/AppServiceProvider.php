<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SoliderService;
use App\Models\SoliderStatus;

use App\Observers\SoliderServiceObserver;
use App\Observers\SoliderStatusObserver;
use Illuminate\Pagination\Paginator;

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

        SoliderService::observe(SoliderServiceObserver::class);
        SoliderStatus::observe(SoliderStatusObserver::class);

        Paginator::useBootstrap(); 

        
    }
}
