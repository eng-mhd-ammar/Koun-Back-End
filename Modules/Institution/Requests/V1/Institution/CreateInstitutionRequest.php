<?php

namespace Modules\Institution\Requests\V1\Institution;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Models\User;
use Modules\Core\Rules\ProhibitedUnlessHasRole;
use Modules\Core\Rules\EnumRule;
use Modules\Core\Rules\FileOrUrl;
use Modules\Core\Rules\NotSoftDeleted;
use Modules\Core\Rules\ObjectOrMinusOne;
use Modules\Institution\Enums\InstitutionType;
use Modules\Institution\Rules\IsUser;

class CreateInstitutionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'logo' => [new FileOrUrl(['jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'tif', 'webp', 'heic', 'heif', 'svg'])],
            'name' => ['required', 'string'],
            'description' => ['string'],
            'owner_id' => ['string', new NotSoftDeleted(User::class), 'default:' . auth()->id(), new IsUser(), new ProhibitedUnlessHasRole(['admin'], auth()->id())],
            'phone' => ['required', 'string', 'regex:/^\+9639\d{8}$/'],
            'email' => ['required', 'email'],
            'type' => ['required', 'integer', new EnumRule(InstitutionType::class), 'default:' . InstitutionType::DONOR->value],
            'is_active' => ['boolean', 'default:0', new ProhibitedUnlessHasRole(['admin'], false)],
            'attachments' => ['array'],
            'attachments.*' => ['required', new FileOrUrl(['jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'tif', 'webp', 'heic', 'heif', 'svg'])],

            'users' => ['required', new ObjectOrMinusOne()],
            'users.*.user_id' => ['required', 'string', new NotSoftDeleted(User::class)],
            'users.*.is_admin' => ['boolean', 'default:0'],
        ];
    }
}
