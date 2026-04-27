<?php

namespace Modules\Delivery\Providers\Delivery;

use Illuminate\Support\ServiceProvider;
use Modules\Delivery\Interfaces\V1\Delivery\DeliveryRepositoryInterface;
use Modules\Delivery\Interfaces\V1\Delivery\DeliveryServiceInterface;
use Modules\Delivery\Repositories\V1\DeliveryRepository;
use Modules\Delivery\Services\V1\DeliveryService;

class DeliveryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(DeliveryRouteServiceProvider::class);

        $this->app->bind(DeliveryServiceInterface::class, DeliveryService::class);
        $this->app->bind(DeliveryRepositoryInterface::class, DeliveryRepository::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . "/../../Database/migrations");
        $this->loadViewsFrom(__DIR__ . "/../../Views", 'delivery');
    }
}
