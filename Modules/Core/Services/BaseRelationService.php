<?php

namespace Modules\Core\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Modules\Core\Exceptions\ServiceException;

class BaseRelationService
{
    protected string $relation;
    protected string $model;

    public function __construct()
    {
        if (!(method_exists($this->model, $this->relation) && (new $this->model())->{$this->relation}() instanceof Relation)) {
            ServiceException::relationNotFound($this->relation);
        }
    }

    public function create(Model $model, array $values)
    {
        $this->repository->create($model, $this->relation, $values);
    }
    public function createMany(Model $model, array $values)
    {
        $this->repository->createMany($model, $this->relation, $values);
    }
    public function update(Model $model, $values)
    {
        $this->repository->update($model, $this->relation, $values);
    }
    public function delete(Model $model, $values)
    {
        $this->repository->delete($model, $this->relation, $values);
    }
    public function attach(Model $model, $values)
    {
        $this->repository->attach($model, $this->relation, $values);
    }
    public function sync(Model $model, $values)
    {
        $this->repository->sync($model, $this->relation, $values);
    }
    public function syncWithoutDetaching(Model $model, $values)
    {
        $this->repository->syncWithoutDetaching($model, $this->relation, $values);
    }
    public function syncWithPivotValues(Model $model, $values)
    {
        $this->repository->syncWithPivotValues($model, $this->relation, $values);
    }
    public function detach(Model $model, $values)
    {
        $this->repository->detach($model, $this->relation, $values);
    }
}
