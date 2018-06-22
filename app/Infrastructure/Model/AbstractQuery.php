<?php
namespace Infrastructure\Model;

use Exception;
use Infrastructure\Repository\AbstractRepository;
use Rebing\GraphQL\Support\Query;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
abstract class AbstractQuery extends Query
{
    /**
     * @var string
     */
    protected $modelClass;

    /**
     * @var AbstractRepository|null
     */
    protected $repository;

    /**
     * @throws Exception
     *
     * @return AbstractRepository
     */
    public function getRepository(): AbstractRepository
    {
        if ($this->repository) {
            return $this->repository;
        }

        if (($model = $this->modelClass)) {
            $repositoryClass = $model . 'Repository';

            $this->repository = app()->make($repositoryClass, compact('model'));

            return $this->repository;
        } else {
            throw new Exception('Model class not set');
        }
    }
}
