<?php

namespace App\Providers;

use App\Repository\Interfaces\ProfilRepositoryInterface;
use App\Repository\ProfilRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProfilRepositoryInterface::class, ProfilRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
