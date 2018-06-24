<?php
namespace Domain\User\Auth;

use Domain\User\User;
use Infrastructure\Repository\AbstractRepository as Repository;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class AuthTokenRepository extends Repository
{
    public function __construct(string $model = AuthToken::class)
    {
        parent::__construct($model);
    }

    /**
     * @param User $user
     *
     * @return AuthTokenRepository
     */
    public function byUser(User $user): AuthTokenRepository
    {
        $this->query->where('user_id', $user->id);

        return $this;
    }

    /**
     * @param string $token
     *
     * @return AuthTokenRepository
     */
    public function byToken(string $token): AuthTokenRepository
    {
        $this->query->where('token', $token);

        return $this;
    }
}
