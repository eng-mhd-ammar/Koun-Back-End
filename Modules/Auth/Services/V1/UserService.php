<?php

namespace Modules\Auth\Services\V1;

use Modules\Auth\Exceptions\UserException;
use Modules\Auth\Interfaces\V1\User\UserRepositoryInterface;
use Modules\Auth\Interfaces\V1\User\UserServiceInterface;
use Modules\Core\Services\BaseService;

class UserService extends BaseService implements UserServiceInterface
{
    public function __construct(protected UserRepositoryInterface $repository)
    {
    }

    public function create($DTO)
    {
        $addresses = array_map(fn ($address) => $address->toArray(), $DTO->addresses);
        $model = parent::create($DTO->filter(['addresses']));
        $model->addresses()->insert($addresses);

        $model->topics()->sync($DTO->topics);
        return $model;
    }

    public function update($model_id, $DTO)
    {
        $addresses = $DTO->addresses;
        $topics = $DTO->topics;

        $model = parent::update($model_id, $DTO->filter(['addresses', 'topics']));

        $addressIds = [];

        foreach ($addresses as $addressDTO) {
            $address = $model->addresses()->updateOrCreate(
                ['id' => $addressDTO->id ?? null],
                $addressDTO->filterNull()->toArray()
            );

            $addressIds[] = $address->id;
        }

        $model->addresses()->whereNotIn('id', $addressIds)->forceDelete();
        $model->topics()->sync($topics);

        return $model;
    }

    public function restore($model_id)
    {
        $model = $this->repository->withTrashed()->show($model_id);
        $this->repository = $this->repository->resetQuery();
        $models = $this->repository->where('phone', $model->phone)->all();
        if (!empty($models->toArray())) {
            $this->throwAlreadyPhoneTaken();
        }
        $model->restore();
        return $model;
    }

    public function throwAlreadyPhoneTaken()
    {
        UserException::alreadyPhoneTaken();
    }
}
