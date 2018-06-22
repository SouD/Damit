<?php
namespace Domain\User\Auth;

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
}
