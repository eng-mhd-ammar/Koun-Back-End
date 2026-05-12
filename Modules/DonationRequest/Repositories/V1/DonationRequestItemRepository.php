<?php

namespace Modules\DonationRequest\Repositories\V1;

use Modules\DonationRequest\Interfaces\V1\DonationRequestItem\DonationRequestItemRepositoryInterface;
use Modules\Core\Repositories\BaseRepository;
use Modules\DonationRequest\Models\DonationRequestItem;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;

class DonationRequestItemRepository extends BaseRepository implements DonationRequestItemRepositoryInterface
{
    protected $model = DonationRequestItem::class;

    public function allowedFilters(): array
    {
        return [
            AllowedFilter::exact('donation_request_item', 'id'),
            AllowedFilter::exact('donation_request', 'donation_request_id'),
            AllowedFilter::exact('donation_item', 'donation_item_id'),
        ];
    }

    public function allowedIncludes(): array
    {
        return [
            AllowedInclude::relationship('donation_request.receiver_branch.institution.owner', 'donationRequest.receiverBranch.institution.owner'),
            AllowedInclude::relationship('donation_request.receiver_user', 'donationRequest.receiverUser'),
            AllowedInclude::relationship('donation_item.donation.sender_branch.institution.owner', 'donationItem.donation.senderBranch.institution.owner'),
            AllowedInclude::relationship('donation_item.donation.sender_user', 'donationItem.donation.senderUser'),
        ];
    }
}
