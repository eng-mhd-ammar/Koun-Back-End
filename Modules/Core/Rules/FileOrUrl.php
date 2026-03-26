<?php

namespace Modules\Core\Rules;

use Illuminate\Http\UploadedFile;
use Illuminate\Contracts\Validation\ValidationRule;

class FileOrUrl implements ValidationRule
{
    public function __construct(protected $mimes = [])
    {
        $this->mimes = is_array($mimes)
            ? $mimes
            : explode(',', str_replace(' ', '', $mimes));
    }

    /**
     * @param  string  $attribute
     * @param  mixed   $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate($attribute, $value, $fail): void
    {
        if (is_null($value)) {
            return;
        }

        if ($value instanceof UploadedFile) {
            $extension = strtolower($value->getClientOriginalExtension());

            if (!empty($this->mimes) && !in_array($extension, $this->mimes)) {
                $fail("The {$attribute} must be a file of type: " . implode(', ', $this->mimes) . '.');
            }

            return;
        }

        if (is_string($value) && filter_var($value, FILTER_VALIDATE_URL)) {
            $path = parse_url($value, PHP_URL_PATH);
            $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

            if (!in_array($extension, $this->mimes)) {
                $fail("The {$attribute} URL must end with one of the following extensions: " . implode(', ', $this->mimes) . '.');
            }

            return;
        }

        $fail("The {$attribute} must be a file or a valid URL string.");
    }
}
