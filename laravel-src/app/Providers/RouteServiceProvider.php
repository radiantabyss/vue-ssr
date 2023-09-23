<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        //load routes
        \Route::middleware('routes')
            ->namespace('App\Domains')
            ->group(base_path('routes/routes.php'));
    }
}
