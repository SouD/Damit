<?php
namespace PublicSite\Http\Requests\Auth;

use Domain\User\Auth\AuthProviderName;
use Infrastructure\Http\Requests\AbstractFormRequest as FormRequest;

class LoginRequest extends FormRequest
{
    public function check(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $provider = $this->route(AuthProviderName::getRouteKeyName()) ?: AuthProviderName::EMAIL;
        $rules = [];

        if (AuthProviderName::EMAIL === $provider) {
            $rules = [
                'email' => ['required', 'email'],
                'password' => ['required', 'string'],
            ];
        }

        return $rules;
    }
}
