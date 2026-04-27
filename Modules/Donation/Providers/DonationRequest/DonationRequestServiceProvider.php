<?php

namespace Modules\Donation\Providers\DonationRequest;

use Illuminate\Support\ServiceProvider;
use Modules\Donation\Interfaces\V1\DonationRequest\DonationRequestRepositoryInterface;
use Modules\Donation\Interfaces\V1\DonationRequest\DonationRequestServiceInterface;
use Modules\Donation\Repositories\V1\DonationRequestRepository;
use Modules\Donation\Services\V1\DonationRequestService;

class DonationRequestServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(DonationRequestRouteServiceProvider::class);

        $this->app->bind(DonationRequestServiceInterface::class, DonationRequestService::class);
        $this->app->bind(DonationRequestRepositoryInterface::class, DonationRequestRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
