<?php
namespace Infrastructure\Auth;

use Domain\User\Auth\AuthProviderName;
use Illuminate\Auth\Events\Authenticated as AuthenticatedEvent;
use Illuminate\Auth\Events\Login as LoginEvent;
use Illuminate\Auth\Events\Logout as LogoutEvent;
use Illuminate\Contracts\Auth\Authenticatable;
use Infrastructure\Auth\Strategy\EmailStrategy;
use Infrastructure\Auth\Strategy\FacebookStrategy;
use Infrastructure\Auth\Strategy\StrategyContract;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\JWTGuard as BaseGuard;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class TokenGuard extends BaseGuard
{
    /**
     * @param array       $credentials
     * @param string|null $provider
     *
     * @return bool|string
     */
    public function attemptLogin(array $credentials, string $provider = null)
    {
        $provider = $provider ?: AuthProviderName::EMAIL;
        $strategy = $this->getProviderStrategy($provider);
        $this->lastAttempted = $user = $strategy->getUser($credentials);

        if ($user) {
            return $this->login($user);
        } else {
            return false;
        }
    }

    /**
     * @param JWTSubject $user
     *
     * @return string
     */
    public function login(JWTSubject $user): string
    {
        $token = $this->jwt->fromUser($user);
        $this->setToken($token)
            ->setUser($user);

        $this->fireAuthenticatedEvent($user);

        $this->fireLoginEvent($user);

        return $token;
    }

    /**
     * @param string $provider
     *
     * @return \Infrastructure\Auth\Strategy\StrategyContract|null
     */
    public function getProviderStrategy(string $provider): ?StrategyContract
    {
        $strategy = null;

        switch ($provider) {
            case AuthProviderName::FACEBOOK:
                $strategy = app()->make(FacebookStrategy::class, [
                    'provider' => $this->getProvider(),
                ]);
                break;

            case AuthProviderName::EMAIL:
                $strategy = app()->make(EmailStrategy::class, [
                    'provider' => $this->getProvider(),
                ]);
                break;
        }

        return $strategy;
    }

    /**
     * @param bool $forceForever
     */
    public function logout($forceForever = false)
    {
        $this->requireToken()
            ->invalidate($forceForever);

        $user = $this->user();
        $this->user = null;

        $this->jwt->unsetToken();

        $this->fireLogoutEvent($user);
    }

    /**
     * @param Authenticatable $user
     */
    public function fireAuthenticatedEvent(Authenticatable $user): void
    {
        event(new AuthenticatedEvent($user));
    }

    /**
     * @param Authenticatable $user
     */
    public function fireLoginEvent(Authenticatable $user): void
    {
        event(new LoginEvent($user, false));
    }

    /**
     * @param Authenticatable $user
     */
    public function fireLogoutEvent(Authenticatable $user): void
    {
        event(new LogoutEvent($user));
    }
}
