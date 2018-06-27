<?php
namespace Domain\User;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as BaseType;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class UserType extends BaseType
{
    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'User',
            'description' => trans('user.type.attribute.description'),
            'model' => User::class,
        ];
    }

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => trans('user.type.field.email.description'),
            ],
            'logins' => [
                'type' => Type::nonNull(Type::int()),
                'description' => trans('user.type.field.logins.description'),
            ],
            'lastLoginAt' => [
                'type' => Type::string(),
                'description' => trans('user.type.field.last_login_at.description'),
            ],
            'createdAt' => [
                'type' => Type::nonNull(Type::string()),
                'description' => trans('user.type.field.created_at.description'),
            ],
            'updatedAt' => [
                'type' => Type::nonNull(Type::string()),
                'description' => trans('user.type.field.updated_at.description'),
            ],
            'isAdmin' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => trans('user.type.field.is_admin.description'),
            ],
        ];
    }

    /**
     * @param mixed $root
     * @param array $args
     *
     * @return string
     */
    protected function resolveLastLoginAtField($root, array $args): string
    {
        return $root->last_login_at->toAtomString();
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

    /**
     * @param mixed $root
     * @param array $args
     *
     * @return bool
     */
    protected function resolveIsAdminField($root, array $args): boolean
    {
        return $root->is_admin;
    }
}
