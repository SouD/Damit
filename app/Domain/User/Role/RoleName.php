<?php
namespace Domain\User\Role;

use Infrastructure\Concern\HasConstants;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class RoleName
{
    use HasConstants;

    /**
     * @var string
     */
    const USER = 'user';

    /**
     * @var string
     */
    const ADMIN = 'admin';
}
