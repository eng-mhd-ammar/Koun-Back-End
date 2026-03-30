<?php

namespace Modules\Institution\Providers\Branch;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Modules\Institution\Controllers\V1\BranchController;

class BranchRouteServiceProvider extends RouteServiceProvider
{
    public function boot(): void
    {
        $this->routes(function (): void {
            Route::middleware('api')
                ->controller(BranchController::class)
                ->prefix('api/v1/branch')
                ->name('branch.')
                ->group(__DIR__ . '/../../Routes/V1/branch.php');
        });
    }
}
