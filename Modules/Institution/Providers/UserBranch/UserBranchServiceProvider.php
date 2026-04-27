<?php

namespace Modules\Institution\Providers\UserBranch;

use Illuminate\Support\ServiceProvider;
use Modules\Institution\Interfaces\V1\UserBranch\UserBranchRepositoryInterface;
use Modules\Institution\Interfaces\V1\UserBranch\UserBranchServiceInterface;
use Modules\Institution\Repositories\V1\UserBranchRepository;
use Modules\Institution\Services\V1\UserBranchService;

class UserBranchServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(UserBranchRouteServiceProvider::class);

        $this->app->bind(UserBranchServiceInterface::class, UserBranchService::class);
        $this->app->bind(UserBranchRepositoryInterface::class, UserBranchRepository::class);
    }

    public function boot(): void
    {
    }
}
