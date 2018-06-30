<?php
namespace Domain\User;

use Infrastructure\Service\AbstractService as Service;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class UserService extends Service
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * @param User $user
     */
    public function onLogin(User $user): void
    {
        ++$user->logins;
        $user->last_login_at = now();

        $user->save();
    }
}
