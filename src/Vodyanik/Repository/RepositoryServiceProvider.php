<?php

namespace Vodyanik\Repository;

use Illuminate\Support\ServiceProvider;
use Vodyanik\Repository\Commands\Repository;
use Vodyanik\Repository\Commands\RepositoryContract;
use Vodyanik\Repository\Commands\Service;
use Vodyanik\Repository\Commands\ServiceContract;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    private $commands = [
        Repository::class,
        RepositoryContract::class,
        Service::class,
        ServiceContract::class,
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands($this->commands);
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
