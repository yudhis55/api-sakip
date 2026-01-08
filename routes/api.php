<?php

use App\Http\Controllers\Api\IkuController;
use App\Http\Controllers\Api\LkjipController;
use App\Http\Controllers\Api\LppdController;
use App\Http\Controllers\Api\OpdController;
use App\Http\Controllers\Api\PeriodeSakipController;
use App\Http\Controllers\Api\PerjanjianKinerjaController;
use App\Http\Controllers\Api\PohonKinerjaController;
use App\Http\Controllers\Api\ProsesBisnisController;
use App\Http\Controllers\Api\RencanaAksiController;
use App\Http\Controllers\Api\RenjaController;
use App\Http\Controllers\Api\RenstraController;
use App\Http\Controllers\Api\RpjmdController;
use App\Http\Controllers\Api\TahunSakipController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Helper/Master Data Endpoints
Route::prefix('master')->group(function () {
    // OPD (Perangkat Daerah)
    Route::get('/opd', [OpdController::class, 'index']);
    Route::get('/opd/{id}', [OpdController::class, 'show']);

    // Periode SAKIP
    Route::get('/periode', [PeriodeSakipController::class, 'index']);
    Route::get('/periode/{id}', [PeriodeSakipController::class, 'show']);

    // Tahun SAKIP
    Route::get('/tahun', [TahunSakipController::class, 'index']);
    Route::get('/tahun/{id}', [TahunSakipController::class, 'show']);
});

// Document Endpoints - Dokumen dengan periode
Route::prefix('dokumen')->group(function () {
    // RPJMD
    Route::get('/rpjmd', [RpjmdController::class, 'index']);
    Route::get('/rpjmd/{id}', [RpjmdController::class, 'show']);

    // Proses Bisnis
    Route::get('/proses-bisnis', [ProsesBisnisController::class, 'index']);
    Route::get('/proses-bisnis/{id}', [ProsesBisnisController::class, 'show']);

    // Pohon Kinerja (Cascading)
    Route::get('/pohon-kinerja', [PohonKinerjaController::class, 'index']);
    Route::get('/pohon-kinerja/{id}', [PohonKinerjaController::class, 'show']);

    // Renstra
    Route::get('/renstra', [RenstraController::class, 'index']);
    Route::get('/renstra/{id}', [RenstraController::class, 'show']);

    // IKU
    Route::get('/iku', [IkuController::class, 'index']);
    Route::get('/iku/{id}', [IkuController::class, 'show']);

    // Renja
    Route::get('/renja', [RenjaController::class, 'index']);
    Route::get('/renja/{id}', [RenjaController::class, 'show']);

    // Perjanjian Kinerja
    Route::get('/perjanjian-kinerja', [PerjanjianKinerjaController::class, 'index']);
    Route::get('/perjanjian-kinerja/{id}', [PerjanjianKinerjaController::class, 'show']);

    // Rencana Aksi
    Route::get('/rencana-aksi', [RencanaAksiController::class, 'index']);
    Route::get('/rencana-aksi/{id}', [RencanaAksiController::class, 'show']);

    // LPPD
    Route::get('/lppd', [LppdController::class, 'index']);
    Route::get('/lppd/{id}', [LppdController::class, 'show']);

    // LKJIP
    Route::get('/lkjip', [LkjipController::class, 'index']);
    Route::get('/lkjip/{id}', [LkjipController::class, 'show']);
});
