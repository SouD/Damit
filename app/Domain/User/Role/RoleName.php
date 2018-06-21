<?php
namespace Domain\User\Role;

use Infrastructure\AbstractConstantWrapper as Wrapper;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class RoleName extends Wrapper
{
    /**
     * @var string
     */
    const USER = 'user';

    /**
     * @var string
     */
    const ADMIN = 'admin';
}
