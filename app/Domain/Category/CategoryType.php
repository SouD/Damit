<?php
namespace Domain\Category;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as BaseType;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class CategoryType extends BaseType
{
    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'Category',
            'description' => trans('category.type.attribute.description'),
            'model' => Category::class,
        ];
    }

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'slug' => [
                'type' => Type::nonNull(Type::string()),
                'description' => trans('category.type.field.slug.description'),
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => trans('category.type.field.name.description'),
            ],
            'createdAt' => [
                'type' => Type::nonNull(Type::string()),
                'description' => trans('category.type.field.created_at.description'),
            ],
            'updatedAt' => [
                'type' => Type::nonNull(Type::string()),
                'description' => trans('category.type.field.updated_at.description'),
            ],
        ];
    }

    /**
     * @param mixed $root
     * @param array $args
     *
     * @return string
     */
    protected function resolveNameField($root, array $args): string
    {
        return $root->name ?: trans('common.unknown');
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
