<?php

namespace Modules\Auth\Interfaces\V1\Auth;

use Modules\Core\DTO\OtpDTO;
use Modules\Core\DTO\CodeDTO;
use Modules\Auth\DTO\V1\LoginDTO;
use Modules\Auth\DTO\V1\RegisterDTO;
use Modules\Core\DTO\ResetPasswordDTO;
use Modules\Core\DTO\ChangePasswordDTO;

interface AuthServiceInterface
{
    public function login(LoginDTO $DTO): array;
    public function register(RegisterDTO $DTO);
    public function refresh(): array;
    public function sendCode(CodeDTO $DTO, $type);
    public function checkOTP(OtpDTO $DTO);
}
