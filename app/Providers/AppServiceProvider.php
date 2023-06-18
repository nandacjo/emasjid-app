<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\InformasiRepository;
use App\Repository\Interfaces\InformasiRepositoryInterface;
use App\Repository\Interfaces\KategoriRepositoryInterface;
use App\Repository\Interfaces\KurbanHewanRepositoryInterface;
use App\Repository\Interfaces\KurbanRepositoryInterface;
use App\Repository\Interfaces\MasjidBankRepositoryInterface;
use App\Repository\Interfaces\ProfilRepositoryInterface;
use App\Repository\KategoriRepository;
use App\Repository\KurbanHewanRepository;
use App\Repository\KurbanRepository;
use App\Repository\MasjidBankRepository;
use App\Repository\ProfilRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProfilRepositoryInterface::class, ProfilRepository::class);
        $this->app->bind(KategoriRepositoryInterface::class, KategoriRepository::class);
        $this->app->bind(InformasiRepositoryInterface::class, InformasiRepository::class);
        $this->app->bind(MasjidBankRepositoryInterface::class, MasjidBankRepository::class);
        $this->app->bind(KurbanRepositoryInterface::class, KurbanRepository::class);
        $this->app->bind(KurbanHewanRepositoryInterface::class, KurbanHewanRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
