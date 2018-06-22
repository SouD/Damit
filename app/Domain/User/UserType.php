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
            'name' => 'user',
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
            'created_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => trans('user.type.field.created_at.description'),
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => trans('user.type.field.updated_at.description'),
            ],
            'is_admin' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => trans('user.type.field.boolean.description'),
                'selectable' => false,
            ],
        ];
    }

    /**
     * @param mixed $root
     * @param mixed $args
     *
     * @return string
     */
    protected function resolveCreatedAtField($root, $args): string
    {
        return $root->created_at->toAtomString();
    }

    /**
     * @param mixed $root
     * @param mixed $args
     *
     * @return string
     */
    protected function resolveUpdatedAtField($root, $args): string
    {
        return $root->updated_at->toAtomString();
    }
}
