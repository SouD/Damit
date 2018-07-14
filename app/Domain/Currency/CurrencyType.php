<?php
namespace Domain\Currency;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as BaseType;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class CurrencyType extends BaseType
{
    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'Currency',
            'description' => trans('currency.type.attribute.description'),
            'model' => Currency::class,
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
                'description' => trans('currency.type.field.code.description'),
            ],
            'symbol' => [
                'type' => Type::string(),
                'description' => trans('currency.type.field.symbol.description'),
            ],
            'factor' => [
                'type' => Type::nonNull(Type::int()),
                'description' => trans('currency.type.field.factor.description'),
            ],
            'decimals' => [
                'type' => Type::nonNull(Type::int()),
                'description' => trans('currency.type.field.decimals.description'),
            ],
            'createdAt' => [
                'type' => Type::nonNull(Type::string()),
                'description' => trans('currency.type.field.created_at.description'),
            ],
            'updatedAt' => [
                'type' => Type::nonNull(Type::string()),
                'description' => trans('currency.type.field.updated_at.description'),
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
