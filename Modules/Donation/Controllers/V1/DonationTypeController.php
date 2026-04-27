<?php

namespace Modules\Donation\Controllers\V1;

use Modules\Donation\DTO\V1\DonationTypeDTO;
use Modules\Donation\Interfaces\V1\DonationType\DonationTypeServiceInterface;
use Modules\Donation\Requests\V1\DonationType\CreateDonationTypeRequest;
use Modules\Donation\Requests\V1\DonationType\UpdateDonationTypeRequest;
use Modules\Donation\Resources\V1\DonationTypeResource;
use Modules\Core\Controllers\BaseController;
use Modules\Core\Utilities\Response;

class DonationTypeController extends BaseController
{
    public function __construct(protected DonationTypeServiceInterface $modelService)
    {
    }

    public function index()
    {
        $models = $this->modelService->index();
        return (new Response(DonationTypeResource::collection($models)->resource))->success(message: "All donation types.");
    }

    public function show(string $modelId)
    {
        $model = $this->modelService->show($modelId);
        return (new Response(DonationTypeResource::make($model)))->success(message: "Donation type details.");
    }

    public function create(CreateDonationTypeRequest $request)
    {
        $this->modelService->create(DonationTypeDTO::fromRequest($request));
        return (new Response())->success(message: "Donation type created successfully.", code: Response::HTTP_CREATED);
    }

    public function update(UpdateDonationTypeRequest $request, string $modelId)
    {
        $this->modelService->update($modelId, DonationTypeDTO::fromRequest($request));
        return (new Response())->success(message: "Donation type updated successfully.");
    }

    public function delete(string $modelId)
    {
        $this->modelService->delete($modelId);
        return (new Response())->success(message: "Donation type deleted successfully.");
    }

    public function ForceDelete(string $modelId)
    {
        $this->modelService->ForceDelete($modelId);
        return (new Response())->success(message: "Donation type force deleted successfully.");
    }

    public function restore(string $modelId)
    {
        $this->modelService->restore($modelId);
        return (new Response())->success(message: "Donation type restored successfully.");
    }
}
