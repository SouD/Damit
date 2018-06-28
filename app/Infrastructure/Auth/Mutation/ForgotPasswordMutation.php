<?php
namespace Infrastructure\Auth\Mutation;

use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Infrastructure\GraphQL\AbstractMutation as Mutation;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class ForgotPasswordMutation extends Mutation
{
    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'forgotPassword',
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
        $response = Password::broker()
            ->sendResetLink(array_only($args, ['email']));

        if (Password::RESET_LINK_SENT === $response) {
            return true;
        } else {
            throw ValidationException::withMessages([
                ['email' => trans($response)],
            ]);
        }
    }
}
