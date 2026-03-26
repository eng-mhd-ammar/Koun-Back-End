<?php

namespace Modules\Auth\Providers\User;

use Illuminate\Support\ServiceProvider;
use Modules\Auth\Interfaces\V1\User\UserRepositoryInterface;
use Modules\Auth\Interfaces\V1\User\UserServiceInterface;
use Modules\Auth\Repositories\V1\UserRepository;
use Modules\Auth\Services\V1\UserService;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(UserRouteServiceProvider::class);

        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    public function boot()
    {
        //
    }
}
