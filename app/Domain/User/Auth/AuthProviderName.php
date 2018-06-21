<?php
namespace Domain\User\Auth;

use Infrastructure\AbstractConstantWrapper as Wrapper;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class AuthProviderName extends Wrapper
{
    /**
     * @var string
     */
    const EMAIL = 'email';

    /**
     * @var string
     */
    const FACEBOOK = 'facebook';
}
