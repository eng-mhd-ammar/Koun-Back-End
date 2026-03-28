<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Auth\Providers\Auth\AuthServiceProvider;
use App\Custom\CustomPaginator;
use Modules\Core\Rules\DefaultValue;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->alias(CustomPaginator::class, LengthAwarePaginator::class);

        $this->app->register(AuthServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extendImplicit('default', function ($attribute, $value, $parameters, $validator) {
            return DefaultValue::applyToValidator($validator, $attribute, $parameters);
        });
    }
}
