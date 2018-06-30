<?php
namespace Infrastructure\Auth\Mutation;

use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Infrastructure\GraphQL\AbstractMutation as Mutation;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class ResetPasswordMutation extends Mutation
{
    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'resetPassword',
        ];
    }

    /**
     * @return Type
     */
    public function type(): Type
    {
        return Type::boolean();
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return [
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
            ],
            'token' => [
                'name' => 'token',
                'type' => Type::nonNull(Type::string()),
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
            ],
            'passwordConfirmation' => [
                'name' => 'passwordConfirmation',
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }

    /**
     * @param array $args
     *
     * @return array
     */
    public function rules(array $args = []): array
    {
        return [
            'email' => ['required', 'email'],
            'token' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'same:passwordConfirmation'],
            'passwordConfirmation' => ['required', 'string'],
        ];
    }

    /**
     * @param mixed $root
     * @param array $args
     *
     * @throws ValidationException
     *
     * @return bool
     */
    public function resolve($root, array $args): bool
    {
        $credentials = array_only($args, [
            'email', 'password', 'passwordConfirmation', 'token',
        ]);
        $credentials['password_confirmation'] = array_get($credentials,
            'passwordConfirmation');
        $response = Password::broker()
            ->reset($credentials, function ($user, $password) {
                $this->resetPassword($user, $password);
            });

        if (Password::PASSWORD_RESET === $response) {
            return true;
        } else {
            throw ValidationException::withMessages([
                'email' => trans($response),
            ]);
        }
    }
}
