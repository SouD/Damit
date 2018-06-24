<?php
namespace Infrastructure\Auth\Mutation;

use Domain\User\Auth\AuthProviderName;
use Domain\User\Auth\AuthToken;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\ValidationException;
use Infrastructure\GraphQL\AbstractMutation as Mutation;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class LoginMutation extends Mutation
{
    use ThrottlesLogins;

    /**
     * We temporarily put resolve arguments into this member to make
     * them available to the username method.
     *
     * @var array
     */
    protected $resolveArgs;

    /**
     * @var string
     */
    protected $provider;

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'login',
        ];
    }

    /**
     * @return Type
     */
    public function type(): Type
    {
        return GraphQL::type('AuthToken');
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return [
            'provider' => [
                'name' => 'provider',
                'type' => Type::nonNull(Type::string()),
            ],
            'providerId' => [
                'name' => 'providerId',
                'type' => Type::string(),
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::string(),
            ],
        ];
    }

    /**
     * @param array $args
     *
     * @return array
     */
    public function rules(array $args = []): array
    {
        $provider = $this->getProvider($args);

        switch ($provider) {
            case AuthProviderName::EMAIL:
            default:
                return [
                    'provider' => ['required', 'string'],
                    'email' => ['required', 'email'],
                    'password' => ['required', 'string'],
                ];
        }
    }

    /**
     * @param mixed $root
     * @param array $args
     *
     * @throws ValidationException
     *
     * @return AuthToken|null
     */
    public function resolve($root, array $args): ?AuthToken
    {
        $this->resolveArgs = $args;
        $request = Request::instance(); // Needed for the lockout mechanism.

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            // Doesn't actually send anything, just throws a ValidationException.
            $this->sendLockoutResponse($request);
        }

        $provider = $this->getProvider($args);

        if ($this->attemptLogin($args, $provider)) {
            return $this->guard()
                ->user()
                ->newestAuthToken();
        }

        $this->incrementLoginAttempts($request);

        throw ValidationException::withMessages([
            $provider => [trans('auth.failed')],
        ]);
    }

    /**
     * This should only ever be called after the $resolveArgs member
     * is initialized. Yes, hacky...
     *
     * @return string
     */
    protected function username(): string
    {
        return $this->getProvider($this->resolveArgs);
    }

    /**
     * @param array $args
     *
     * @return string
     */
    protected function getProvider(array $args = []): string
    {
        if (!$this->provider) {
            $this->provider = array_get($args, 'provider', AuthProviderName::EMAIL);
        }

        return $this->provider;
    }

    /**
     * @param array args
     * @param string|null $provider
     *
     * @return bool
     */
    protected function attemptLogin(array $args, string $provider = null): bool
    {
        return $this->guard()
            ->attempt($args, $provider);
    }
}
