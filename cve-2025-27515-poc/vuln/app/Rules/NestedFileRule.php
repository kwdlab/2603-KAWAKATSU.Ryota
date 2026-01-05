<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class NestedFileRule implements Rule
{
    public function passes($attribute, $value)
    {
        // ここで必ず「子 Validator」を作る（テスト用）
        $child = Validator::make(
            ['file' => $value],
            ['file' => ['required', 'mimes:png,jpg']]
        );

        return $child->passes();
    }

    public function message()
    {
        return 'The :attribute must be a jpg or png file.';
    }
}
