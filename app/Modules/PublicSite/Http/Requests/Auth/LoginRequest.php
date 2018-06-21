<?php
namespace PublicSite\Http\Requests\Auth;

use Infrastructure\Http\Requests\AbstractFormRequest as FormRequest;

class LoginRequest extends FormRequest
{
    public function check(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }
}
