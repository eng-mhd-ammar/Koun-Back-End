<?php

namespace Modules\Core\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NotSoftDeleted implements ValidationRule
{
    public function __construct(
        protected string $model,
        protected ?string $ignoreId = null
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$value) {
            return;
        }

        $query = $this->model::query();

        if ($this->ignoreId) {
            $query->where('id', '!=', $this->ignoreId);
        }

        $exists = $query->where('id', $value)->exists();

        if (!$exists) {
            $fail("The selected {$attribute} is invalid or has been deleted.");
        }
    }
}
