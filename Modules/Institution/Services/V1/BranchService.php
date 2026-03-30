<?php

namespace Modules\Institution\Services\V1;

use Modules\Institution\Interfaces\V1\Branch\BranchRepositoryInterface;
use Modules\Institution\Interfaces\V1\Branch\BranchServiceInterface;
use Modules\Core\Services\BaseService;

class BranchService extends BaseService implements BranchServiceInterface
{
    public function __construct(protected BranchRepositoryInterface $repository)
    {
    }
}
