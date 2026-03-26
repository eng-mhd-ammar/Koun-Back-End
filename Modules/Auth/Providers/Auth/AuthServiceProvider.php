<?php

namespace Modules\Auth\Providers\Auth;

use Illuminate\Support\ServiceProvider;
use Modules\Auth\Interfaces\V1\Auth\AuthServiceInterface;
use Modules\Auth\Providers\Profile\ProfileServiceProvider;
use Modules\Auth\Providers\User\UserServiceProvider;
use Modules\Auth\Services\V1\AuthService;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(AuthRouteServiceProvider::class);

        $this->app->bind(AuthServiceInterface::class, AuthService::class);

        $this->app->register(UserServiceProvider::class);
        $this->app->register(ProfileServiceProvider::class);
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . "/../../Database/migrations");
        $this->loadViewsFrom(__DIR__ . "/../../Views", 'auth');
    }
}
