<?php
namespace Damit\Providers;

use Domain\User\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    protected $adminNamespace = 'Admin\Http\Controllers';

    /**
     * @var string
     */
    protected $publicNamespace = 'PublicSite\Http\Controllers';

    /**
     * @var string
     */
    protected $userNamespace = 'User\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        parent::boot();

        $this->bind();
    }

    public function bind()
    {
        Route::model('user', User::class);
    }

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        //$this->mapAdminRoutes();
        $this->mapPublicRoutes();
        //$this->mapUserRoutes();
    }

    protected function mapAdminRoutes()
    {
        Route::middleware(['api', 'auth:admin'])
            ->namespace($this->publicNamespace)
            ->group(app_path('Modules/Admin/Http/routes.php'));
    }

    protected function mapPublicRoutes()
    {
        Route::middleware('api')
            ->namespace($this->publicNamespace)
            ->group(app_path('Modules/PublicSite/Http/routes.php'));
    }

    protected function mapUserRoutes()
    {
        Route::middleware(['api', 'auth:api'])
            ->namespace($this->publicNamespace)
            ->group(app_path('Modules/User/Http/routes.php'));
    }
}
