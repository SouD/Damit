<?php
namespace Domain\Category\Query;

use Domain\Category\Category;
use Domain\Category\CategoryRepository;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Infrastructure\GraphQL\AbstractQuery as Query;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class CategoryQuery extends Query
{
    /**
     * @var CategoryRepository
     */
    protected $categories;

    /**
     * @param CategoryRepository $categories
     */
    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'Category',
        ];
    }

    /**
     * @return Type
     */
    public function type(): Type
    {
        return GraphQL::type('Category');
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return [
            'slug' => [
                'name' => 'slug',
                'type' => Type::string(),
            ],
        ];
    }

    /**
     * @param mixed $root
     * @param array $args
     *
     * @return Category|null
     */
    public function resolve($root, array $args): ?Category
    {
        $slug = array_get($args, 'slug');

        if ($slug) {
            return $this->categories->bySlug($slug)
                ->first();
        }
    }
}
