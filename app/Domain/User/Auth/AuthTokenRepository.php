<?php
namespace Domain\User\Auth;

use Infrastructure\Repository\AbstractRepository as Repository;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class AuthTokenRepository extends Repository
{
    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct(AuthToken::class);
    }
}
