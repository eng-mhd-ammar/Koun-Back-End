<?php

namespace Modules\Delivery\Repositories\V1;

use Modules\Delivery\Interfaces\V1\Delivery\DeliveryRepositoryInterface;
use Modules\Core\Repositories\BaseRepository;
use Modules\Delivery\Models\Delivery;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;

class DeliveryRepository extends BaseRepository implements DeliveryRepositoryInterface
{
    protected $model = Delivery::class;

    public function allowedFilters(): array
    {
        return [
            AllowedFilter::exact('delivery', 'id'),
            AllowedFilter::exact('delivery', 'delivery_id'),
            AllowedFilter::exact('receiver', 'receiver_id'),
            AllowedFilter::exact('donation_request', 'donation_request_id'),
        ];
    }

    public function allowedIncludes(): array
    {
        return [
            AllowedInclude::relationship('delivery'),
            AllowedInclude::relationship('receiver'),
            AllowedInclude::relationship('donation_request', 'donationRequest'),
        ];
    }
}
