<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\InformasiRepository;
use App\Repository\Interfaces\InformasiRepositoryInterface;
use App\Repository\Interfaces\KategoriRepositoryInterface;
use App\Repository\Interfaces\KurbanHewanRepositoryInterface;
use App\Repository\Interfaces\KurbanPesertaRepositoryInterface;
use App\Repository\Interfaces\PesertaRepositoryInterface;
use App\Repository\Interfaces\KurbanRepositoryInterface;
use App\Repository\Interfaces\MasjidBankRepositoryInterface;
use App\Repository\Interfaces\ProfilRepositoryInterface;
use App\Repository\KategoriRepository;
use App\Repository\KurbanHewanRepository;
use App\Repository\PesertaRepository;
use App\Repository\KurbanPesertaRepository;
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
    $this->app->bind(KurbanPesertaRepositoryInterface::class, KurbanPesertaRepository::class);
    $this->app->bind(PesertaRepositoryInterface::class, PesertaRepository::class);
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    // cara membuat blade directive activeMenru
    \Blade::directive('activeMenu', function ($route) {
      return "{{ Route::is($route) ? 'active' : '' }}";
    });

    \Blade::directive('errorInput', function ($error) {
      return "{{ \$errors->first($error) }}";
    });
  }
}
