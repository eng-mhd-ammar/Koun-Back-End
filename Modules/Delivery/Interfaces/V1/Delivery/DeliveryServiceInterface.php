<?php

namespace Modules\Delivery\Interfaces\V1\Delivery;

use Modules\Delivery\DTO\V1\DeliveryDTO;

interface DeliveryServiceInterface
{
    public function index();
    public function show(string $modelId);
    public function create(DeliveryDTO $DTO);
    public function update(string $modelId, DeliveryDTO $DTO);
    public function delete(string $modelId);
    public function ForceDelete(string $modelId);
    public function restore($modelId);
}
