<?php

namespace Modules\Auth\Interfaces\V1\User;

use Modules\Auth\DTO\V1\UserDTO;

interface UserServiceInterface
{
    public function index();
    public function show(string $model_id);
    public function create(UserDTO $DTO);
    public function update(string $model_id, UserDTO $DTO);
    public function delete(string $model_id);
    public function ForceDelete(string $model_id);
    public function restore($model_id);
}
