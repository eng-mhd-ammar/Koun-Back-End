<?php

namespace Modules\Auth\Services\V1;

use Modules\Auth\Models\User;
use Modules\Auth\Interfaces\V1\Auth\AuthServiceInterface;
use Modules\Core\Services\BaseAuthService;

class AuthService extends BaseAuthService implements AuthServiceInterface
{
    protected string $model = User::class;
    protected string $guard = 'api';
    protected bool $checkActivity = false;
    protected array $columns = ['phone', 'username', 'email'];
    protected bool $markAsActivated = true;
}
