<?php

namespace Modules\Donation\Repositories\V1;

use Modules\Donation\Interfaces\V1\DonationRequest\DonationRequestRepositoryInterface;
use Modules\Core\Repositories\BaseRepository;
use Modules\Donation\Models\DonationRequest;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;

class DonationRequestRepository extends BaseRepository implements DonationRequestRepositoryInterface
{
    protected $model = DonationRequest::class;

    public function allowedFilters(): array
    {
        return [
            AllowedFilter::exact('donation_request', 'id'),
            AllowedFilter::exact('donation', 'donation_id'),
            AllowedFilter::exact('receiver_branch', 'receiver_branch_id'),
            AllowedFilter::exact('receiver_user', 'receiver_user_id'),
        ];
    }

    public function allowedIncludes(): array
    {
        return [
            AllowedInclude::relationship('donation', 'donation'),
            AllowedInclude::relationship('receiver_branch', 'receiverBranch'),
            AllowedInclude::relationship('receiver_user', 'receiverUser'),
        ];
    }
}
