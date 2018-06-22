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
     * @var AbstractRepository|null
     */
    protected $repository;

    /**
     * @return string
     */
    abstract public function getModelClass(): string;

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

        if (($model = $this->getModelClass())) {
            $repositoryClass = $model . 'Repository';

            $this->repository = app()->make($repositoryClass, compact('model'));

            return $this->repository;
        } else {
            throw new Exception('Model class not set');
        }
    }
}
