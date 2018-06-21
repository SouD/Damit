<?php
namespace Infrastructure\Auth\Strategy;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
interface StrategyContract
{
    /**
     * @param Authenticatable $user
     */
    public function fireAttemptEvent(Authenticatable $user): void;

    /**
     * @param array $credentials
     *
     * @return Authenticatable|null
     */
    public function getUser(array $credentials): ?Authenticatable;

    /**
     * @param array $data
     *
     * @return Authenticatable|null
     */
    public function createUser(array $data): ?Authenticatable;

    /**
     * @return UserProvider
     */
    public function getProvider(): UserProvider;
}
