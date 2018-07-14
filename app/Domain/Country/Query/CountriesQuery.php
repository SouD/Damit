<?php
namespace Domain\Country\Query;

use Domain\Country\CountryRepository;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;
use Infrastructure\GraphQL\AbstractQuery as Query;
use Rebing\GraphQL\Support\SelectFields;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class CountriesQuery extends Query
{
    /**
     * @var CountryRepository
     */
    protected $countries;

    /**
     * @param CountryRepository $countries
     */
    public function __construct(CountryRepository $countries)
    {
        $this->countries = $countries;
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'Countries',
        ];
    }

    /**
     * @return Type
     */
    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Country'));
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

        return $this->countries->select($columns)
            ->get();
    }
}
