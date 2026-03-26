<?php

namespace Modules\Auth\Requests\V1\User;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Address\Models\Address;
use Modules\Address\Models\State;
use Modules\Auth\Enums\Gender;
use Modules\Auth\Models\User;
use Modules\Core\Rules\EnumRule;
use Modules\Core\Rules\ExistsOrMinusOne;
use Modules\Core\Rules\FileOrUrl;
use Modules\Core\Rules\NotSoftDeleted;
use Modules\Core\Rules\UniqueNotDeleted;
use Modules\Notification\Models\Topic;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'photo' => [new FileOrUrl('jpg, jpeg, png, gif, bmp, tiff, tif, webp, heic, heif, svg')],
            'first_name' => ['string'],
            'last_name' => ['string'],
            'username' => ['string', new UniqueNotDeleted(User::class, 'username', $this->route('user_id'))],
            'phone' => ['string', new UniqueNotDeleted(User::class, 'phone', $this->route('user_id')), 'regex:/^\+9639\d{8}$/'],
            'password' => ['nullable', 'string', 'min:8', 'max:20'],
            'birthday' => ['date'],
            'gender' => ['boolean', new EnumRule(Gender::class)],

            'addresses' => ['required', 'array'],
            'addresses.*.id' => ['integer', 'exists:addresses,id', new NotSoftDeleted(Address::class)],
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
