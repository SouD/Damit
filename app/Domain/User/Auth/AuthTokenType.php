<?php
namespace Domain\User\Auth;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as BaseType;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class AuthTokenType extends BaseType
{
    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'AuthToken',
            'description' => trans('user.auth_token.type.attribute.description'),
            'model' => AuthToken::class,
        ];
    }

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'token' => [
                'type' => Type::nonNull(Type::string()),
                'description' => trans('user.auth_token.type.field.token.description'),
            ],
            'expiresAt' => [
                'type' => Type::nonNull(Type::string()),
                'description' => trans('user.auth_token.type.field.expires_at.description'),
            ],
            'createdAt' => [
                'type' => Type::nonNull(Type::string()),
                'description' => trans('user.auth_token.type.field.created_at.description'),
            ],
            'updatedAt' => [
                'type' => Type::nonNull(Type::string()),
                'description' => trans('user.auth_token.type.field.updated_at.description'),
            ],
        ];
    }

    /**
     * @param mixed $root
     * @param array $args
     *
     * @return string
     */
    protected function resolveExpiresAtField($root, array $args): string
    {
        return $root->expires_at->toAtomString();
    }

    /**
     * @param mixed $root
     * @param array $args
     *
     * @return string
     */
    protected function resolveCreatedAtField($root, array $args): string
    {
        return $root->created_at->toAtomString();
    }

    /**
     * @param mixed $root
     * @param array $args
     *
     * @return string
     */
    protected function resolveUpdatedAtField($root, array $args): string
    {
        return $root->updated_at->toAtomString();
    }
}
