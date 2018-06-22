<?php
namespace Infrastructure\Concern;

use Illuminate\Support\Collection;
use ReflectionClass;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
trait HasConstants
{
    /**
     * @return Collection
     */
    public static function getConstants(): Collection
    {
        return collect(with(new ReflectionClass(get_called_class()))->getConstants());
    }

    /**
     * @return Collection
     */
    public static function getConstantValues(): Collection
    {
        return static::getConstants()
            ->values();
    }
}
