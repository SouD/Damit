<?php
namespace Infrastructure\Auth;

use Domain\User\Auth\AuthProviderName;
use Domain\User\Auth\AuthTokenRepository;
use Illuminate\Auth\Events\Authenticated as AuthenticatedEvent;
use Illuminate\Auth\Events\Login as LoginEvent;
use Illuminate\Auth\Events\Logout as LogoutEvent;
use Illuminate\Auth\TokenGuard as BaseGuard;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use Infrastructure\Auth\Strategy\EmailStrategy;
use Infrastructure\Auth\Strategy\FacebookStrategy;
use Infrastructure\Auth\Strategy\StrategyContract;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class TokenGuard extends BaseGuard
{
    /**
     * @var AuthTokenRepository
     */
    protected $tokens;

    /**
     * @param UserProvider        $provider
     * @param Request             $request
     * @param AuthTokenRepository $tokens
     */
    public function __construct(UserProvider $provider, Request $request,
        AuthTokenRepository $tokens)
    {
        parent::__construct($provider, $request);

        $this->tokens = $tokens;
        $this->inputKey = 'token';
        $this->storageKey = 'authTokens.token';
    }

    public function getTokenForRequest()
    {
        $token = $this->request->header('Authorization');

        if (empty($token)) {
            $token = $this->request->bearerToken();
        }

        if (empty($token)) {
            $token = $this->request->input($this->inputKey);
        }

        return $token;
    }

    /**
     * @param array       $credentials
     * @param string|null $provider
     *
     * @return bool
     */
    public function attempt(array $credentials, string $provider = null): bool
    {
        $provider = $provider ?: AuthProviderName::EMAIL;
        $strategy = $this->getProviderStrategy($provider);
        $user = $strategy->getUser($credentials);

        if ($user) {
            $this->setUser($user);

            $token = $this->tokens->create([
                'user_id' => $user->id,
                'token' => $this->generateToken(),
                'expires_at' => now()->addDays(14),
            ]);

            $this->fireLoginEvent($user);

            return true;
        } else {
            return false;
        }
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
     * @param Authenticatable $user
     *
     * @return $this
     */
    public function setUser(Authenticatable $user)
    {
        $this->user = $user;

        $this->fireAuthenticatedEvent($user);

        return $this;
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

    /**
     * @return string
     */
    public function generateToken(): string
    {
        return bin2hex(random_bytes(78));
    }
}
