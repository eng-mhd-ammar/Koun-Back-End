<?php

namespace Modules\Donation\Providers\Donation;

use Illuminate\Support\ServiceProvider;
use Modules\Donation\Interfaces\V1\Donation\DonationRepositoryInterface;
use Modules\Donation\Interfaces\V1\Donation\DonationServiceInterface;
use Modules\Donation\Providers\DonationItem\DonationItemServiceProvider;
use Modules\Donation\Providers\DonationRequest\DonationRequestServiceProvider;
use Modules\Donation\Providers\DonationType\DonationTypeServiceProvider;
use Modules\Donation\Providers\Unit\UnitServiceProvider;
use Modules\Donation\Repositories\V1\DonationRepository;
use Modules\Donation\Services\V1\DonationService;

class DonationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(DonationRouteServiceProvider::class);

        $this->app->bind(DonationServiceInterface::class, DonationService::class);
        $this->app->bind(DonationRepositoryInterface::class, DonationRepository::class);

        $this->app->register(UnitServiceProvider::class);
        $this->app->register(DonationItemServiceProvider::class);
        $this->app->register(DonationTypeServiceProvider::class);
        $this->app->register(DonationRequestServiceProvider::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . "/../../Database/migrations");
        $this->loadViewsFrom(__DIR__ . "/../../Views", 'donation');
    }
}
