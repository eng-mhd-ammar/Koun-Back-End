<?php

namespace Modules\Auth\Interfaces\V1\Profile;

use Modules\Auth\DTO\V1\PhoneUpdateCheckOtpDTO;
use Modules\Auth\DTO\V1\ProfileDTO;
use Modules\Auth\DTO\V1\PhoneUpdateRequestDTO;
use Modules\Auth\DTO\V1\PhoneUpdateSendOtpDTO;

interface ProfileServiceInterface
{
    public function index();
    public function show(string $model_id);
    public function create(ProfileDTO $DTO);
    public function update(string $clientId, ProfileDTO $DTO);
    public function delete(string $model_id);
    public function ForceDelete(string $model_id);
    public function restore($model_id);
    public function phoneUpdateRequest(string $model_id, PhoneUpdateRequestDTO $DTO);
    public function phoneUpdateSendOtp(PhoneUpdateSendOtpDTO  $DTO);
    public function phoneUpdateCheckOtp(PhoneUpdateCheckOtpDTO $DTO);
}
