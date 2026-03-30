<?php

namespace Modules\Institution\Controllers\V1;

use Modules\Institution\DTO\V1\BranchDTO;
use Modules\Institution\Interfaces\V1\Branch\BranchServiceInterface;
use Modules\Institution\Requests\V1\Branch\CreateBranchRequest;
use Modules\Institution\Requests\V1\Branch\UpdateBranchRequest;
use Modules\Institution\Resources\V1\BranchResource;
use Modules\Core\Controllers\BaseController;
use Modules\Core\Utilities\Response;

class BranchController extends BaseController
{
    public function __construct(protected BranchServiceInterface $modelService)
    {
    }

    public function index()
    {
        $models = $this->modelService->index();
        return (new Response(BranchResource::collection($models)->resource))->success(message: "All branches.");
    }

    public function show(string $modelId)
    {
        $model = $this->modelService->show($modelId);
        return (new Response(BranchResource::make($model)))->success(message: "Branch details.");
    }

    public function create(CreateBranchRequest $request)
    {
        $this->modelService->create(BranchDTO::fromRequest($request));
        return (new Response())->success(message: "Branch created successfully.", code: Response::HTTP_CREATED);
    }

    public function update(UpdateBranchRequest $request, string $modelId)
    {
        $this->modelService->update($modelId, BranchDTO::fromRequest($request));
        return (new Response())->success(message: "Branch updated successfully.");
    }

    public function delete(string $modelId)
    {
        $this->modelService->delete($modelId);
        return (new Response())->success(message: "Branch deleted successfully.");
    }

    public function ForceDelete(string $modelId)
    {
        $this->modelService->ForceDelete($modelId);
        return (new Response())->success(message: "Branch force deleted successfully.");
    }

    public function restore(string $modelId)
    {
        $this->modelService->restore($modelId);
        return (new Response())->success(message: "Branch restored successfully.");
    }
}
