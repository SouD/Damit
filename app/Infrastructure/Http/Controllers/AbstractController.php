<?php
namespace Infrastructure\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
abstract class AbstractController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var bool
     */
    protected $isAdmin = false;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->isAdmin = Auth::user()->isAdmin();
            }

            return $next($request);
        });
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
}
