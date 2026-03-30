<?php

namespace Modules\Institution\Repositories\V1;

use Modules\Institution\Interfaces\V1\Institution\InstitutionRepositoryInterface;
use Modules\Core\Repositories\BaseRepository;
use Modules\Institution\Models\Institution;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;

class InstitutionRepository extends BaseRepository implements InstitutionRepositoryInterface
{
    protected $model = Institution::class;

    public function allowedFilters(): array
    {
        return [
            AllowedFilter::exact('institution', 'id'),
            AllowedFilter::exact('owner', 'owner_id'),
            AllowedFilter::exact('active', 'is_active'),
        ];
    }

    public function allowedIncludes(): array
    {
        return [
            AllowedInclude::relationship('owner'),
            AllowedInclude::relationship('branches'),
        ];
    }
}
