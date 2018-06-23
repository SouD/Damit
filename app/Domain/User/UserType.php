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
            'createdAt' => [
                'type' => Type::nonNull(Type::string()),
                'description' => trans('user.type.field.createdAt.description'),
            ],
            'updatedAt' => [
                'type' => Type::nonNull(Type::string()),
                'description' => trans('user.type.field.updatedAt.description'),
            ],
            'isAdmin' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => trans('user.type.field.isAdmin.description'),
            ],
        ];
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
