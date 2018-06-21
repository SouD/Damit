<?php
namespace Damit\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Infrastructure\Auth\EloquentUserProvider;
use Infrastructure\Auth\TokenGuard;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $policies = [];

    public function boot()
    {
        $this->registerPolicies();
        $this->registerUserProviderExtensions();
        $this->registerGuardExtensions();
    }

    public function registerUserProviderExtensions()
    {
        Auth::provider('damit_users', function ($app, array $config) {
            $model = array_get($config, 'model');

            return $app->make(EloquentUserProvider::class, [
                'model' => $model,
            ]);
        });
    }

    public function registerGuardExtensions()
    {
        Auth::extend('damit_token', function ($app, $name, array $config) {
            $provider = Auth::createUserProvider($config['provider']);

            return $app->make(TokenGuard::class, [
                'provider' => $provider,
            ]);
        });
    }
}
