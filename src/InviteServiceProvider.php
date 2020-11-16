<?php

namespace Qihucms\Invite;

use Illuminate\Support\ServiceProvider;

class InviteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Invite::class, function () {
            return new Invite();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'invite');
        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/invite'),
        ]);
    }
}
