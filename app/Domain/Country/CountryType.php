<?php
namespace Domain\Country;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as BaseType;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class CountryType extends BaseType
{
    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'Country',
            'description' => trans('country.type.attribute.description'),
            'model' => Country::class,
        ];
    }

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'code' => [
                'type' => Type::nonNull(Type::string()),
                'description' => trans('country.type.field.code.description'),
            ],
            'shippingEnabled' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => trans('country.type.field.shipping_enabled.description'),
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => trans('country.type.field.name.description'),
            ],
            'createdAt' => [
                'type' => Type::nonNull(Type::string()),
                'description' => trans('country.type.field.created_at.description'),
            ],
            'updatedAt' => [
                'type' => Type::nonNull(Type::string()),
                'description' => trans('country.type.field.updated_at.description'),
            ],
        ];
    }

    /**
     * @param mixed $root
     * @param array $args
     *
     * @return bool
     */
    protected function resolveShipppingEnabledField($root, array $args): bool
    {
        return $root->shipping_enabled;
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
