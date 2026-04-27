<?php

namespace Modules\Institution\Providers\UserInstitution;

use Illuminate\Support\ServiceProvider;
use Modules\Institution\Interfaces\V1\UserInstitution\UserInstitutionRepositoryInterface;
use Modules\Institution\Interfaces\V1\UserInstitution\UserInstitutionServiceInterface;
use Modules\Institution\Repositories\V1\UserInstitutionRepository;
use Modules\Institution\Services\V1\UserInstitutionService;

class UserInstitutionServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(UserInstitutionRouteServiceProvider::class);

        $this->app->bind(UserInstitutionServiceInterface::class, UserInstitutionService::class);
        $this->app->bind(UserInstitutionRepositoryInterface::class, UserInstitutionRepository::class);
    }

    public function boot(): void
    {
    }
}
