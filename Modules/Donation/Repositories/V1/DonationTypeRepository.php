<?php

namespace Modules\Donation\Repositories\V1;

use Modules\Donation\Interfaces\V1\DonationType\DonationTypeRepositoryInterface;
use Modules\Core\Repositories\BaseRepository;
use Modules\Donation\Models\DonationType;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;

class DonationTypeRepository extends BaseRepository implements DonationTypeRepositoryInterface
{
    protected $model = DonationType::class;

    public function allowedFilters(): array
    {
        return [
            AllowedFilter::exact('donation_type', 'id'),
            AllowedFilter::exact('parent', 'donation_type_id'),
        ];
    }

    public function allowedIncludes(): array
    {
        return [
            AllowedInclude::relationship('donation_item.donation.sender_user', 'DonationItems.donation.senderUser'),
            AllowedInclude::relationship('donation_item.donation.receiver_user', 'DonationItems.donation.receiverUser'),
            AllowedInclude::relationship('donation_item.donation.sender_branch.institution', 'DonationItems.donation.senderBranch.institution'),
            AllowedInclude::relationship('donation_item.donation.receiver_branch.institution', 'DonationItems.donation.receiverBranch.institution'),

            AllowedInclude::relationship('parent'),
            AllowedInclude::relationship('children'),

        ];
    }
}
