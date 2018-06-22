<?php
namespace Infrastructure\Concern;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
trait HasGuard
{
    /**
     * @param string|null $guard
     *
     * @return Guard|null
     */
    public function getGuard(string $guard = null): ?Guard
    {
        return Auth::guard($guard);
    }
}
