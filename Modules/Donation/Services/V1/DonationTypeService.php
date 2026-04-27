<?php

namespace Modules\Donation\Services\V1;

use Modules\Donation\Interfaces\V1\DonationType\DonationTypeRepositoryInterface;
use Modules\Donation\Interfaces\V1\DonationType\DonationTypeServiceInterface;
use Modules\Core\Services\BaseService;

class DonationTypeService extends BaseService implements DonationTypeServiceInterface
{
    public function __construct(protected DonationTypeRepositoryInterface $repository)
    {
    }
}
