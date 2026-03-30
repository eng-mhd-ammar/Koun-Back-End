<?php

namespace Modules\Institution\Providers\Branch;

use Illuminate\Support\ServiceProvider;
use Modules\Institution\Interfaces\V1\Branch\BranchRepositoryInterface;
use Modules\Institution\Interfaces\V1\Branch\BranchServiceInterface;
use Modules\Institution\Repositories\V1\BranchRepository;
use Modules\Institution\Services\V1\BranchService;

class BranchServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(BranchRouteServiceProvider::class);

        $this->app->bind(BranchServiceInterface::class, BranchService::class);
        $this->app->bind(BranchRepositoryInterface::class, BranchRepository::class);
    }

    public function boot(): void
    {
    }
}
