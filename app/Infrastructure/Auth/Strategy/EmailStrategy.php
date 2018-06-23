<?php
namespace Infrastructure\Auth\Strategy;

use Illuminate\Contracts\Auth\Authenticatable;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class EmailStrategy extends AbstractStrategy
{
    public function getUser(array $credentials): ?Authenticatable
    {
        $credentials = array_only($credentials, [
            'email', 'password',
        ]);

        $user = $this->provider->retrieveByCredentials($credentials);

        if ($user) {
            $this->fireAttemptEvent($user);

            if ($this->provider->validateCredentials($user, $credentials)) {
                return $user;
            } else {
                $this->fireFailedEvent($user, $credentials);

                return null;
            }
        } else {
            return null;
        }
    }

    public function createUser(array $data): ?Authenticatable
    {
        // TODO: Implement.
        return null;
    }
}
