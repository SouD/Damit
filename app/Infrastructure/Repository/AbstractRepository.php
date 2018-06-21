<?php
namespace Infrastructure\Repository;

use Illuminate\Database\Eloquent\Builder;
use Infrastructure\Model\AbstractModel as Model;

/**
 * Abstract repository.
 */
abstract class AbstractRepository
{
    /**
     * @var string
     */
    protected $model;

    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $query;

    /**
     * @param string $model
     */
    public function __construct(string $model)
    {
        $this->model = $model;
        $this->query = forward_static_call([$model, 'query']);
    }

    public function reset(): void
    {
        $this->query = $this->query->newModelInstance()
            ->query();
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return forward_static_call([$this->model, 'create'], $attributes);
    }

    /**
     * @param string $name
     * @param mixed  $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $result = $this->query->{$name}(...$arguments);

        if ($result instanceof Builder) {
            return $this;
        }

        return $result;
    }
}
