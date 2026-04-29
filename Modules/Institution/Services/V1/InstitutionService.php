<?php

namespace Modules\Institution\Services\V1;

use Modules\Institution\Interfaces\V1\Institution\InstitutionRepositoryInterface;
use Modules\Institution\Interfaces\V1\Institution\InstitutionServiceInterface;
use Modules\Core\Services\BaseService;
use Override;

class InstitutionService extends BaseService implements InstitutionServiceInterface
{
    public function __construct(protected InstitutionRepositoryInterface $repository)
    {
    }

    #[Override]
    public function create($DTO)
    {
        $model = parent::create($DTO);

        if ($DTO->users) {
            $model->members()->sync($DTO->users);
        }

        return $model;
    }

    #[Override]
    public function update(string $modelId, $DTO)
    {
        $model = parent::update($modelId, $DTO);

        if ($DTO->users) {
            $model->members()->sync($DTO->users);
        }

        return $model;
    }
}
