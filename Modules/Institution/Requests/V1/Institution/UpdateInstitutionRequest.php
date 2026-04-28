<?php

namespace Modules\Institution\Requests\V1\Institution;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Models\User;
use Modules\Core\Rules\EnumRule;
use Modules\Core\Rules\FileOrUrl;
use Modules\Core\Rules\NotSoftDeleted;
use Modules\Core\Rules\ProhibitedUnlessHasRole;
use Modules\Institution\Enums\InstitutionType;
use Modules\Institution\Rules\IsUser;

class UpdateInstitutionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'logo' => [new FileOrUrl(['jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'tif', 'webp', 'heic', 'heif', 'svg'])],
            'name' => ['string'],
            'description' => ['string'],
            'owner_id' => ['string', new NotSoftDeleted(User::class), new ProhibitedUnlessHasRole(['admin']), new IsUser],
            'phone' => ['string', 'regex:/^\+9639\d{8}$/'],
            'email' => ['email'],
            'type' => ['integer', new EnumRule(InstitutionType::class)],
            'is_active' => ['boolean', 'default:0', new ProhibitedUnlessHasRole(['admin'])],
            'attachments' => ['array'],
            'attachments.*' => [new FileOrUrl(['jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'tif', 'webp', 'heic', 'heif', 'svg'])],
        ];
    }
}
