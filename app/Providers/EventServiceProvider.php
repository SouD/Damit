<?php
namespace Damit\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Infrastructure\Subscriber\UserSubscriber;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $listen = [];

    /**
     * @var array
     */
    protected $subscribe = [
        UserSubscriber::class,
    ];

    public function boot()
    {
        parent::boot();
    }
}
