<?php

namespace Modules\Institution\Repositories\V1;

use Modules\Institution\Interfaces\V1\Branch\BranchRepositoryInterface;
use Modules\Core\Repositories\BaseRepository;
use Modules\Institution\Models\Branch;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;

class BranchRepository extends BaseRepository implements BranchRepositoryInterface
{
    protected $model = Branch::class;

    public function allowedFilters(): array
    {
        return [
            AllowedFilter::exact('branch', 'id'),
            AllowedFilter::exact('institution', 'institution_id'),
            AllowedFilter::exact('main_branch', 'is_main_branch'),
        ];
    }

    public function allowedIncludes(): array
    {
        return [
            AllowedInclude::relationship('institution.owner'),
            AllowedInclude::relationship('address.state'),
        ];
    }
}
