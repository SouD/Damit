<?php
namespace Infrastructure\Auth;

use Illuminate\Auth\EloquentUserProvider as BaseUserProvider;
use Illuminate\Support\Str;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class EloquentUserProvider extends BaseUserProvider
{
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) ||
           (1 === count($credentials) && array_key_exists('password', $credentials))
        ) {
            return;
        }

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $query = $this->createModel()->newQuery();

        foreach ($credentials as $key => $value) {
            if (!Str::contains($key, 'password')) {
                if (Str::contains($key, '.')) {
                    $parts = collect(explode('.', $key));
                    $column = $parts->pop();
                    $relation = $parts->implode('.');

                    $query->whereHas($relation, function ($query) use ($column, $value) {
                        $query->where($column, $value)
                            ->where('expires_at', '>=', now()); // This will break if relation does not have an expires_at column!
                    });
                } else {
                    $query->where($key, $value);
                }
            }
        }

        return $query->first();
    }
}
