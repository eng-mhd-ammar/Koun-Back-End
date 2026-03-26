<?php

namespace Modules\Core\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRelationRepository
{
    public function create(Model $model, string $relation, array $values)
    {
        return $model->$relation()->create($values);
    }
    public function createMany(Model $model, string $relation, array $values)
    {
        return $model->$relation()->createMany($values);
    }
    public function update(Model $model, string $relation, $values)
    {
        return $model->$relation()->update($values);
    }
    public function delete(Model $model, string $relation, $values)
    {
        return $model->$relation()->delete($values);
    }
    public function attach(Model $model, string $relation, $values)
    {
        return $model->$relation()->attach($values);
    }
    public function sync(Model $model, string $relation, $values)
    {
        return $model->$relation()->sync($values);
    }
    public function syncWithoutDetaching(Model $model, string $relation, $values)
    {
        return $model->$relation()->syncWithoutDetaching($values);
    }
    public function syncWithPivotValues(Model $model, string $relation, $values)
    {
        return $model->$relation()->syncWithPivotValues($values);
    }
    public function detach(Model $model, string $relation, $values)
    {
        return $model->$relation()->detach($values);
    }
}
