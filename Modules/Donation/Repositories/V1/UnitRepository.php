<?php

namespace Modules\Donation\Repositories\V1;

use Modules\Donation\Interfaces\V1\Unit\UnitRepositoryInterface;
use Modules\Core\Repositories\BaseRepository;
use Modules\Donation\Models\Unit;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;

class UnitRepository extends BaseRepository implements UnitRepositoryInterface
{
    protected $model = Unit::class;

    public function allowedFilters(): array
    {
        return [
            AllowedFilter::exact('unit', 'id'),
        ];
    }

    public function allowedIncludes(): array
    {
        return [
            AllowedInclude::relationship('donation_items.donation.sender_user', 'donationItems.donation.senderUser'),
            AllowedInclude::relationship('donation_items.donation.donation_requests.receiver_user', 'donationItems.donation.donationRequests.receiverUser'),
            AllowedInclude::relationship('donation_items.donation.sender_branch.institution', 'donationItems.donation.senderBranch.institution'),
            AllowedInclude::relationship('donation_items.donation.donation_requests.receiver_branch.institution', 'donationItems.donation.donationRequests.receiverBranch.institution'),
        ];
    }
}
