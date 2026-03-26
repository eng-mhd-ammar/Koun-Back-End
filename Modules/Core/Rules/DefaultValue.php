<?php

namespace Modules\Core\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Arr;

class DefaultValue implements ValidationRule
{
    protected $default;

    public function __construct($default = null)
    {
        $this->default = $default;
    }

    public function validate($attribute, $value, $fail): void
    {
        if (is_null($value) || $value === '') {
            $req = request()->all();
            Arr::set($req, $attribute, $this->cast($this->default));
            request()->replace($req);
        }
    }

    public static function applyToValidator($validator, $attribute, $parameters): bool
    {
        $default = $parameters[0] ?? null;
        if ($default === null) {
            return true;
        }

        $data = $validator->getData();

        $current = data_get($data, $attribute);

        if (is_null($current) || $current === '') {
            $casted = self::cast($default);

            data_set($data, $attribute, $casted);
            $validator->setData($data);

            $reqData = request()->all();
            Arr::set($reqData, $attribute, $casted);
            request()->replace($reqData);
        }

        return true;
    }

    protected static function cast($value)
    {
        if (!is_string($value)) {
            return $value;
        }

        $lower = strtolower($value);
        if ($lower === 'null') {
            return null;
        }
        if ($lower === 'true') {
            return true;
        }
        if ($lower === 'false') {
            return false;
        }

        if (ctype_digit($value)) {
            return (int) $value;
        }

        if (is_numeric($value)) {
            return (float) $value;
        }

        return $value;
    }
}
