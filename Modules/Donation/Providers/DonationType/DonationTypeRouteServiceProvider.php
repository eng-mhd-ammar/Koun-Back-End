<?php

namespace Modules\Donation\Providers\DonationType;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Modules\Donation\Controllers\V1\DonationTypeController;

class DonationTypeRouteServiceProvider extends RouteServiceProvider
{
    public function boot(): void
    {
        $this->routes(function (): void {
            Route::middleware('api')
                ->controller(DonationTypeController::class)
                ->prefix('api/v1/donation-type')
                ->name('donation-type.')
                ->group(__DIR__ . '/../../Routes/V1/donation-type.php');
        });
    }
}
