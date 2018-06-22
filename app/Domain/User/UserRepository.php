<?php
namespace Domain\User;

use Infrastructure\Repository\AbstractRepository as Repository;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class UserRepository extends Repository
{
    public function __construct(string $model = User::class)
    {
        parent::__construct($model);
    }

    /**
     * @param string $email
     *
     * @return UserRepository
     */
    public function byEmail(string $email): UserRepository
    {
        $this->query->where('email', $email);

        return $this;
    }
}
