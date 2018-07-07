<?php
namespace Domain\Category;

use Infrastructure\Repository\AbstractRepository as Repository;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class CategoryRepository extends Repository
{
    public function __construct(string $model = Category::class)
    {
        parent::__construct($model);
    }

    /**
     * @param string $slug
     *
     * @return CategoryRepository
     */
    public function bySlug(string $slug): CategoryRepository
    {
        $this->query->where('slug', $slug);

        return $this;
    }
}
