<?php

namespace Modules\Auth\Interfaces\V1\User;

use Illuminate\Database\Eloquent\Model;
use App\Custom\CustomPaginator;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;
    public function paginate(int $perPage = 15): CustomPaginator;
    public function show(string $model_id): Model;
    public function create(array $data): Model;
    public function update(string $model_id, array $data): Model;
    public function delete(string $model_id): void;
    public function addScopes(string|array $scopes);
    public function allowedSorts(): array;
    public function allowedFilters(): array;
    public function allowedIncludes(): array;
    public function allowedFields(): array;
    public function ForceDelete(string $model_id);
    public function restore($model_id);
}
