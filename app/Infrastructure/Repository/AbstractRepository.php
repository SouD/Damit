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
    protected $modelClass;

    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $query;

    /**
     * @param string $modelClass
     */
    public function __construct(string $modelClass)
    {
        $this->modelClass = $modelClass;
        $this->query = forward_static_call([$modelClass, 'query']);
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
        return forward_static_call([$this->modelClass, 'create'], $attributes);
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
