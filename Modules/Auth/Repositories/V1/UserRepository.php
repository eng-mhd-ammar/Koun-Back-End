<?php

namespace Modules\Auth\Repositories\V1;

use Modules\Auth\Interfaces\V1\User\UserRepositoryInterface;
use Modules\Core\Repositories\BaseRepository;
use Modules\Auth\Models\User;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model = User::class;

    public function allowedFilters(): array
    {
        return [
            AllowedFilter::exact('user', 'id'),
            AllowedFilter::exact('role', 'roles.id'),
        ];
    }

    public function allowedIncludes(): array
    {
        return [
            AllowedInclude::relationship('roles'),
            AllowedInclude::relationship('owned_institutions', 'ownedInstitutions'),
            AllowedInclude::relationship('member_institutions', 'memberInstitutions'),
            AllowedInclude::relationship('user_branches', 'userBranches'),
            AllowedInclude::relationship('branches'),
            AllowedInclude::relationship('donations.donation_items', 'donations.donationItems'),
            AllowedInclude::relationship('donations_requests.donation_items', 'donationsRequests.donationItems'),
        ];
    }
}
