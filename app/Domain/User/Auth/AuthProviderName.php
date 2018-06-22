<?php
namespace Domain\User\Auth;

use Infrastructure\Concern\HasConstants;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class AuthProviderName
{
    use HasConstants;

    /**
     * @var string
     */
    const EMAIL = 'email';

    /**
     * @var string
     */
    const FACEBOOK = 'facebook';

    /**
     * @return string
     */
    public static function getRouteKeyName(): string
    {
        return 'provider';
    }
}
