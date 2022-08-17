<?php

namespace App\Providers;

use App\Interfaces\AddressRepositoryInterface;
use App\Interfaces\PersonRepositoryInterface;
use App\Repositories\CachingPersonRepository;
use App\Repositories\AddressRepository;
use App\Repositories\PersonRepository;
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
        $this->app->bind(PersonRepositoryInterface::class, function () {
            return new CachingPersonRepository (
                new PersonRepository
            );
        });

        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
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
