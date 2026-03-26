<?php

namespace Modules\Auth\Controllers\V1;

use Modules\Auth\DTO\V1\UserDTO;
use Modules\Auth\Interfaces\V1\User\UserServiceInterface;
use Modules\Auth\Requests\V1\User\CreateUserRequest;
use Modules\Auth\Requests\V1\User\UpdateUserRequest;
use Modules\Auth\Resources\V1\UserResource;
use Modules\Core\Controllers\BaseController;
use Modules\Core\Utilities\Response;

class UserController extends BaseController
{
    public function __construct(protected UserServiceInterface $userService)
    {
    }

    public function index()
    {
        $users = $this->userService->index();
        return (new Response(UserResource::collection($users)->resource))->success(message: "All users.");
    }

    public function show(string $user_id)
    {
        $user = $this->userService->show($user_id);
        return (new Response(UserResource::make($user)))->success(message: "User details");
    }

    public function create(CreateUserRequest $request)
    {
        $model = $this->userService->create(UserDTO::fromRequest($request));
        return (new Response())->success(message: "User created successfully.", code: Response::HTTP_CREATED);
    }

    public function update(UpdateUserRequest $request, string $user_id)
    {
        $this->userService->update($user_id, UserDTO::fromRequest($request));
        return (new Response())->success(message: "User updated successfully.");
    }

    public function delete(string $user_id)
    {
        $this->userService->delete($user_id);
        return (new Response())->success(message: "User deleted successfully.");
    }

    public function ForceDelete(string $user_id)
    {
        $this->userService->ForceDelete($user_id);
        return (new Response())->success(message: "User force deleted successfully.");
    }

    public function restore($user_id)
    {
        $this->userService->restore($user_id);
        return (new Response())->success(message: "User Restored successfully.");
    }
}
