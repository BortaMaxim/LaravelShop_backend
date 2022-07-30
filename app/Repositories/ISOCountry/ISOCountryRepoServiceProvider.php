<?php

namespace App\Repositories\ISOCountry;

use Illuminate\Support\ServiceProvider;

class ISOCountryRepoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ISOCountryInterface::class, ISOCountryRepository::class);
    }

}
