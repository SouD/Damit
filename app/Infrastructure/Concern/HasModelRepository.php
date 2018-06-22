<?php
namespace Infrastructure\Concern;

use Infrastructure\Repository\AbstractRepository;
use LogicException;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
trait HasModelRepository
{
    /**
     * @var AbstractRepository|null
     */
    protected $repository;

    /**
     * @throws LogicException
     * @throws UnexpectedValueException
     *
     * @return AbstractRepository
     */
    public function getRepository(): AbstractRepository
    {
        if ($this->repository) {
            return $this->repository;
        }

        $model = null;

        if (!empty($this->modelClass) && is_string($this->modelClass)) {
            $model = $this->modelClass;
        } elseif (method_exists($this, 'getModelClass')) {
            $model = $this->getModelClass();
        } else {
            throw new LogicException('Failed to get repository model class');
        }

        if ($model) {
            $repositoryClass = $model . 'Repository';

            $this->repository = app()->make($repositoryClass, compact('model'));

            return $this->repository;
        } else {
            throw new UnexpectedValueException('Falsy value for model class');
        }
    }
}
