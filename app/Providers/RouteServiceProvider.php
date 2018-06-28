<?php
namespace Damit\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        $this->mapPublicRoutes();
    }

    protected function mapPublicRoutes()
    {
        Route::prefix('/')
            ->group(base_path('routes/web.php'));
    }
}
