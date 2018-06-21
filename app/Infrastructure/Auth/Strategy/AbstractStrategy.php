<?php
namespace Infrastructure\Auth\Strategy;

use Illuminate\Auth\Events\Attempting as AttemptEvent;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Auth;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
abstract class AbstractStrategy implements StrategyContract
{
    /**
     * @var UserProvider
     */
    protected $provider;

    /**
     * @param UserProvider $provider
     */
    public function __construct(UserProvider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @param string|null $guard
     *
     * @return mixed
     */
    protected function guard(string $guard = null)
    {
        return Auth::guard($guard);
    }

    public function fireAttemptEvent(Authenticatable $user): void
    {
        event(new AttemptEvent($user, false));
    }

    public function getProvider(): UserProvider
    {
        return $this->provider;
    }

    abstract public function getUser(array $credentials): ?Authenticatable;

    abstract public function createUser(array $data): ?Authenticatable;
}
