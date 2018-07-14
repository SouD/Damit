<?php
namespace Domain\Currency\Query;

use Domain\Currency\CurrencyRepository;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;
use Infrastructure\GraphQL\AbstractQuery as Query;
use Rebing\GraphQL\Support\SelectFields;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class CurrenciesQuery extends Query
{
    /**
     * @var CurrencyRepository
     */
    protected $currencies;

    /**
     * @param CurrencyRepository $currencies
     */
    public function __construct(CurrencyRepository $currencies)
    {
        $this->currencies = $currencies;
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'Currencies',
        ];
    }

    /**
     * @return Type
     */
    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Currency'));
    }

    /**
     * @param mixed        $root
     * @param array        $args
     * @param SelectFields $fields
     * @param ResolveInfo  $info
     *
     * @return Collection
     */
    public function resolve($root, array $args, SelectFields $fields,
        ResolveInfo $info): Collection
    {
        $columns = $this->transformColumnNames($fields->getSelect());

        return $this->currencies->select($columns)
            ->get();
    }
}
