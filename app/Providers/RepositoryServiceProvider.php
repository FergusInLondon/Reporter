<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Entities\Client\RepositoryInterface::class,
            \App\Entities\Client\EloquentRepository::class);
        
        $this->app->bind(\App\Entities\Document\RepositoryInterface::class,
            \App\Entities\Document\EloquentRepository::class);

        $this->app->bind(\App\Entities\File\RepositoryInterface::class,
            \App\Entities\File\EloquentRepository::class);

        $this->app->bind(\App\Entities\Payment\RepositoryInterface::class,
            \App\Entities\Payment\EloquentRepository::class);

        $this->app->bind(\App\Entities\User\RepositoryInterface::class,
            \App\Entities\User\EloquentRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
