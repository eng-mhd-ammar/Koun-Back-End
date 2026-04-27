<?php

namespace Modules\Auth\Repositories\V1;

use Modules\Auth\Interfaces\V1\Profile\ProfileRepositoryInterface;
use Modules\Core\Repositories\BaseRepository;
use Modules\Auth\Models\User;
use Spatie\QueryBuilder\AllowedInclude;

class ProfileRepository extends BaseRepository implements ProfileRepositoryInterface
{
    protected $model = User::class;

    public function allowedIncludes(): array
    {
        return [
            AllowedInclude::relationship('roles'),

            AllowedInclude::relationship('owned_institutions', 'ownedInstitutions'),
            AllowedInclude::relationship('member_institutions', 'memberInstitutions'),

            AllowedInclude::relationship('user_branches', 'userBranches'),
            AllowedInclude::relationship('branches'),

            AllowedInclude::relationship('donations_sent.sender_user', 'donationsSent.senderUser'),
            AllowedInclude::relationship('donations_sent.receiver_user', 'donationsSent.receiverUser'),
            AllowedInclude::relationship('donations_sent.sender_branch.institution', 'donationsSent.senderBranch.institution'),
            AllowedInclude::relationship('donations_sent.receiver_branch.institution', 'donationsSent.receiverBranch.institution'),
            AllowedInclude::relationship('donations_sent.donation_items.unit', 'donationsSent.donationItems.unit'),

            AllowedInclude::relationship('donations_received.sender_user', 'donationsReceived.senderUser'),
            AllowedInclude::relationship('donations_received.receiver_user', 'donationsReceived.receiverUser'),
            AllowedInclude::relationship('donations_received.sender_branch.institution', 'donationsReceived.senderBranch.institution'),
            AllowedInclude::relationship('donations_received.receiver_branch.institution', 'donationsReceived.receiverBranch.institution'),
            AllowedInclude::relationship('donations_received.donation_items.unit', 'donationsReceived.donationItems.unit'),
        ];
    }
}
