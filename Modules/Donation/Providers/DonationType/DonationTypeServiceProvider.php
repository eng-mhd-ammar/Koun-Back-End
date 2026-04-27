<?php

namespace Modules\Donation\Providers\DonationType;

use Illuminate\Support\ServiceProvider;
use Modules\Donation\Interfaces\V1\DonationType\DonationTypeRepositoryInterface;
use Modules\Donation\Interfaces\V1\DonationType\DonationTypeServiceInterface;
use Modules\Donation\Repositories\V1\DonationTypeRepository;
use Modules\Donation\Services\V1\DonationTypeService;

class DonationTypeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(DonationTypeRouteServiceProvider::class);

        $this->app->bind(DonationTypeServiceInterface::class, DonationTypeService::class);
        $this->app->bind(DonationTypeRepositoryInterface::class, DonationTypeRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
