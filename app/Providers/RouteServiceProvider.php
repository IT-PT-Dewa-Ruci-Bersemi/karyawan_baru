<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace        = 'App\Modules\Frontend\Controllers';
    protected $namespace_api    = 'App\Modules\API\Controllers';
    protected $namespace_admin  = 'App\Modules\Admin\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
//        $this->mapApiRoutes();
        $this->mapAdminRoutes();
        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
            ->group(base_path('app/Modules/Frontend/frontend_routes.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    protected function mapAdminRoutes() {
        if(env('APP_ENV') == 'local'){
            Route::prefix('_admin')
                ->middleware('admin')
                ->namespace($this->namespace_admin)
                ->group(base_path('app/Modules/Admin/admin_routes.php'));
        }else{
            Route::middleware('admin')
                ->namespace($this->namespace_admin)
                ->group(base_path('app/Modules/Admin/admin_routes.php'));
        }
    }
}
