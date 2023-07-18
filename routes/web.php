<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasController;
use App\Http\Controllers\InfaqController;
use App\Http\Controllers\KurbanController;
use App\Http\Controllers\MasjidController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\MasjidBankController;
use App\Http\Controllers\UserProfilController;
use App\Http\Controllers\KurbanHewanController;
use App\Http\Controllers\KurbanPesertaController;
use App\Http\Middleware\EnsureDataMasjidCompleted;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('logout-user', function () {
  Auth::logout();
  return redirect('/');
})->name('logout-user');

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Auth::routes();

Route::middleware('auth')->group(function () {
  Route::resource('masjid', MasjidController::class)->middleware('verified');
  Route::middleware(EnsureDataMasjidCompleted::class)->group(function () {
    Route::resource('infaq', InfaqController::class);
    Route::resource('kurban-peserta', KurbanPesertaController::class);
    Route::resource('peserta', PesertaController::class);
    Route::resource('kurban-hewan', KurbanHewanController::class);
    Route::resource('kurban', KurbanController::class);
    Route::resource('masjid-bank', MasjidBankController::class);
    Route::resource('informasi', InformasiController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('profil', ProfilController::class);
    Route::resource('kas', KasController::class);
    Route::resource('user-profil', UserProfilController::class);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  });
});

Route::get('/email/verify', function () {
  return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
  $request->fulfill();
  return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
  $request->user()->sendEmailVerificationNotification();
  return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
