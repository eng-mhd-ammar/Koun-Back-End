<?php

namespace Modules\Delivery\Providers\Delivery;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Modules\Delivery\Controllers\V1\DeliveryController;

class DeliveryRouteServiceProvider extends RouteServiceProvider
{
    public function boot(): void
    {
        $this->routes(function (): void {
            Route::middleware('api')
                ->controller(DeliveryController::class)
                ->prefix('api/v1/delivery')
                ->name('delivery.')
                ->group(__DIR__ . '/../../Routes/V1/delivery.php');
        });
    }
}
