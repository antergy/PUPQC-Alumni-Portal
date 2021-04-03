<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $sFrontControllerNamespace = 'App\Http\Controllers\Front';
    protected $sAdminControllerNamespace = 'App\Http\Controllers\Admin';
    protected $sAPIControllerNamespace = 'App\Http\Controllers\API';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Configures all the mapped routes
     */
    public function map()
    {
        $oRoute = Route::domain(config('app.app_route'))->middleware('web');
        $this->mapFrontRoutes($oRoute);
        $this->mapAdminRoutes($oRoute);
        $this->mapAPIRoutes($oRoute);
    }

    /**
     * Map the front routes
     * @param \Illuminate\Routing\RouteRegistrar $oRoute
     */
    protected function mapFrontRoutes(\Illuminate\Routing\RouteRegistrar $oRoute)
    {
        $oRoute
            ->namespace($this->sFrontControllerNamespace)
            ->group(base_path('routes/front.php'));
    }

    /**
     * Map the admin routes
     * @param \Illuminate\Routing\RouteRegistrar $oRoute
     */
    protected function mapAdminRoutes(\Illuminate\Routing\RouteRegistrar $oRoute)
    {
        $oRoute
            ->namespace($this->sAdminControllerNamespace)
            ->group(base_path('routes/admin.php'));
    }

    /**
     * Map the API routes
     * @param \Illuminate\Routing\RouteRegistrar $oRoute
     */
    protected function mapAPIRoutes(\Illuminate\Routing\RouteRegistrar $oRoute)
    {
        $oRoute
            ->namespace($this->sAPIControllerNamespace)
            ->group(base_path('routes/api.php'));
    }
}
