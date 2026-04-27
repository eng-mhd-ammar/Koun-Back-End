<?php

namespace Modules\Delivery\Services\V1;

use Modules\Delivery\Interfaces\V1\Delivery\DeliveryRepositoryInterface;
use Modules\Delivery\Interfaces\V1\Delivery\DeliveryServiceInterface;
use Modules\Core\Services\BaseService;

class DeliveryService extends BaseService implements DeliveryServiceInterface
{
    public function __construct(protected DeliveryRepositoryInterface $repository)
    {
    }
}
