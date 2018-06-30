<?php
namespace Infrastructure\Subscriber;

use Domain\User\UserService;
use Illuminate\Auth\Events\Login as LoginEvent;
use Illuminate\Events\Dispatcher;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class UserSubscriber extends AbstractSubscriber
{
    /**
     * @var UserService
     */
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param LoginEvent $event
     */
    public function onLogin(LoginEvent $event): void
    {
        $this->userService->onLogin($event->user);
    }

    /**
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe(Dispatcher $events): void
    {
        $events->listen(LoginEvent::class, UserSubscriber::class . '@onLogin');
    }
}
