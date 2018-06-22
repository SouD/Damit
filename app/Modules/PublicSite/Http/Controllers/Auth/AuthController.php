<?php
namespace PublicSite\Http\Controllers\Auth;

use Domain\User\Auth\AuthProviderName;
use Domain\User\UserService;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as R;
use Illuminate\Validation\ValidationException;
use Infrastructure\Http\Controllers\AbstractController as Controller;
use LogicException;
use PublicSite\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    use ThrottlesLogins;

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    /**
     * @param LoginRequest $request
     * @param string|null  $provider
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request, string $provider = null)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request, $provider)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request, $provider);
    }

    /**
     * @param LoginRequest $request
     * @param string|null  $provider
     *
     * @return bool
     */
    protected function attemptLogin(Request $request, string $provider = null)
    {
        return $this->guard()
            ->attempt($request->validated(), $provider);
    }

    /**
     * @param LoginRequest $request
     *
     * @throws LogicException
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $user = $this->guard()
            ->user();

        if ($user) {
            return response()->json([
                'user' => $user,
                'token' => $token,
            ]);
        } else {
            throw new LogicException('Login successful but user not set!');
        }
    }

    /**
     * @param LoginRequest $request
     * @param string|null  $provider
     *
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse(Request $request, string $provider = null)
    {
        throw ValidationException::withMessages([
            ($provider ?: AuthProviderName::EMAIL) => [trans('auth.failed')],
        ]);
    }

    /**
     * @return string
     */
    protected function username(): string
    {
        return R::route('provider') ?: AuthProviderName::EMAIL;
    }
}
