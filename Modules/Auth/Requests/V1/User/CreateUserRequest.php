<?php

namespace Modules\Auth\Requests\V1\User;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Address\Models\State;
use Modules\Auth\Enums\Gender;
use Modules\Auth\Models\User;
use Modules\Core\Rules\EnumRule;
use Modules\Core\Rules\ExistsOrMinusOne;
use Modules\Core\Rules\FileOrUrl;
use Modules\Core\Rules\NotSoftDeleted;
use Modules\Core\Rules\UniqueNotDeleted;
use Modules\Notification\Models\Topic;

class CreateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'photo' => [new FileOrUrl('jpg, jpeg, png, gif, bmp, tiff, tif, webp, heic, heif, svg')],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'username' => ['required', 'string', new UniqueNotDeleted(User::class, 'username')],
            'phone' => ['required', 'string', new UniqueNotDeleted(User::class, 'phone'), 'regex:/^\+9639\d{8}$/'],
            'password' => ['nullable', 'required', 'string', 'min:8', 'max:20'],
            'birthday' => ['required', 'date'],
            'gender' => ['required', 'boolean', new EnumRule(Gender::class)],

            'addresses' => ['required', 'array'],
            'addresses.*.name' => ['required', 'string'],
            'addresses.*.state_id' => ['required', 'integer', 'exists:states,id', new NotSoftDeleted(State::class)],
            'addresses.*.city' => ['required', 'string'],
            'addresses.*.latitude' => ['required', 'numeric'],
            'addresses.*.longitude' => ['required', 'numeric'],
            'addresses.*.details' => ['required', 'string'],
            'addresses.*.phone' => ['string', 'regex:/^\+9639\d{8}$/'],

            'topics' => ['array'],
            'topics.*' => ['required', 'string', new ExistsOrMinusOne(Topic::class), new NotSoftDeleted(Topic::class)],
        ];
    }
}
