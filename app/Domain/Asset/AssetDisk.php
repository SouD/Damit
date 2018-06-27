<?php
namespace Domain\Asset;

use Infrastructure\Concern\HasConstants;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class AssetDisk
{
    use HasConstants;

    /**
     * @var string
     */
    const PUBLIK = 'public';

    /**
     * @var string
     */
    const LOCAL = 'local';

    /**
     * @var string
     */
    const CLOUD = 'cloud';

    /**
     * @var string
     */
    const FACEBOOK = 'facebook';
}
