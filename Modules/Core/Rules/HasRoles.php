<?php

namespace Modules\Core\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Modules\Auth\Models\User;

class HasRoles implements ValidationRule
{
    public function __construct(protected string|array $roles)
    {
        $this->roles = is_array($roles) ? $roles : [$roles];
    }

    public function validate($attribute, $value, $fail): void
    {
        $user = $this->resolveUser($value);

        if (! $user) {
            $fail("User not found.");
            return;
        }

        if (! $user->hasAnyRole($this->roles)) {
            $fail("User does not has roles: " . implode(', ', $this->roles));
        }
    }

    public static function applyToValidator($validator, $attribute, $parameters): bool
    {
        $roles = $parameters ?? [];
        if (count($roles) === 0) {
            return true;
        }

        $data = $validator->getData();
        $value = data_get($data, $attribute);

        $user = self::resolveUserStatic($value);

        if (! $user) {
            $validator->errors()->add($attribute, 'User not found.');
            return false;
        }

        if (! $user->hasAnyRole($roles)) {
            $validator->errors()->add(
                $attribute,
                'User does not has roles: ' . implode(', ', $roles)
            );
            return false;
        }

        return true;
    }

    protected function resolveUser($value): ?User
    {
        if ($value instanceof User) {
            return $value;
        }

        if ($value) {
            return User::find($value);
        }

        if (auth()->check()) {
            return auth()->user();
        }

        return null;
    }

    protected static function resolveUserStatic($value): ?User
    {
        if ($value instanceof User) {
            return $value;
        }

        if (is_numeric($value)) {
            return User::find($value);
        }

        if (auth()->check()) {
            return auth()->user();
        }

        return null;
    }
}
