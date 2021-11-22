<?php

namespace Fol\Fees;

use Illuminate\Support\ServiceProvider;

class FeesServiceProvider extends ServiceProvider
{
     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'fees');
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/fees'),
        ]);
    }
}