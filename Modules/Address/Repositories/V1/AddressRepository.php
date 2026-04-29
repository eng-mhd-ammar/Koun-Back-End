<?php

namespace Modules\Address\Repositories\V1;

use Modules\Address\Interfaces\V1\Address\AddressRepositoryInterface;
use Modules\Core\Repositories\BaseRepository;
use Modules\Address\Models\Address;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;

class AddressRepository extends BaseRepository implements AddressRepositoryInterface
{
    protected $model = Address::class;

    public function allowedFilters(): array
    {
        return [
            AllowedFilter::exact('address', 'id'),
            AllowedFilter::exact('institution', 'institution_id'),
            AllowedFilter::exact('branch', 'branch_id'),
            AllowedFilter::exact('state', 'state_id'),
            AllowedFilter::scope('for_user', 'forUser')->default([1]),
        ];
    }

    public function allowedIncludes(): array
    {
        return [
            AllowedInclude::relationship('state'),
            AllowedInclude::relationship('branch.institution'),
        ];
    }
}
