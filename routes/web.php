<?php

use Illuminate\Support\Facades\Route;

// AUTH
use App\Http\Controllers\Auth\AuthController;

// HOME & APP
use App\Http\Controllers\App\Home\HomeController;
use App\Http\Controllers\App\HakAkses\HakAksesController;
use App\Http\Controllers\App\Todo\TodoController;

// PENGHARGAAN
use App\Http\Controllers\App\Penghargaan\StatistikController;
use App\Http\Controllers\App\Penghargaan\PengajuanController;

// PENGAJUAN JURNAL
use App\Http\Controllers\App\PengajuanJurnal\JurnalController;

// DUMMY DATA
use App\Http\Controllers\App\Dummy\DummyDataController;


Route::middleware(['throttle:req-limit', 'handle.inertia'])->group(function () {

    // =======================
    // SSO
    // =======================
    Route::prefix('sso')->group(function () {
        Route::get('/callback', [AuthController::class, 'ssoCallback'])
            ->name('sso.callback');
    });

    // =======================
    // AUTH
    // =======================
    Route::prefix('auth')->group(function () {

        Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
        Route::post('/login-check', [AuthController::class, 'postLoginCheck'])->name('auth.login-check');
        Route::post('/login-post', [AuthController::class, 'postLogin'])->name('auth.login-post');

        Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

        Route::get('/totp', [AuthController::class, 'totp'])->name('auth.totp');
        Route::post('/totp-post', [AuthController::class, 'postTotp'])->name('auth.totp-post');
    });


    // =======================
    // PROTECTED (Login Required)
    // =======================
    Route::middleware('check.auth')->group(function () {

        // Home
        Route::get('/', [HomeController::class, 'index'])->name('home');

        // =======================
        // Hak Akses
        // =======================
        Route::prefix('hak-akses')->group(function () {
            Route::get('/', [HakAksesController::class, 'index'])->name('hak-akses');
            Route::post('/change', [HakAksesController::class, 'postChange'])->name('hak-akses.change-post');
            Route::post('/delete', [HakAksesController::class, 'postDelete'])->name('hak-akses.delete-post');
            Route::post('/delete-selected', [HakAksesController::class, 'postDeleteSelected'])->name('hak-akses.delete-selected-post');
        });

        // =======================
        // Todo
        // =======================
        Route::prefix('todo')->group(function () {
            Route::get('/', [TodoController::class, 'index'])->name('todo');
            Route::post('/change', [TodoController::class, 'postChange'])->name('todo.change-post');
            Route::post('/delete', [TodoController::class, 'postDelete'])->name('todo.delete-post');
        });

        // =======================
        // Penghargaan
        // =======================
        Route::prefix('penghargaan')->group(function () {

            Route::get('/statistik', [StatistikController::class, 'index'])
                ->name('penghargaan.statistik');

            Route::get('/daftar', [PengajuanController::class, 'index'])
                ->name('penghargaan.daftar');
        });

        // =======================
        // ⭐ Pengajuan Jurnal (LENGKAP)
        // =======================
        Route::prefix('pengajuan-jurnal')->name('pengajuan.jurnal.')->group(function () {

            // Halaman Daftar Jurnal
            Route::get('/', [JurnalController::class, 'index'])
                ->name('daftar');

            // Halaman Pilih Data (Gambar 1)
            Route::get('/pilih-data', [JurnalController::class, 'pilihData'])
                ->name('pilih-data');

            // Halaman Form Penghargaan (Gambar 2)
            Route::get('/form', [JurnalController::class, 'form'])
                ->name('form');

            // Submit Form
            Route::post('/store', [JurnalController::class, 'store'])
                ->name('store');

            // Edit Jurnal (Optional)
            Route::get('/edit/{id}', [JurnalController::class, 'edit'])
                ->name('edit');

            // Update Jurnal (Optional)
            Route::put('/update/{id}', [JurnalController::class, 'update'])
                ->name('update');

            // Delete Jurnal (Optional)
            Route::delete('/delete/{id}', [JurnalController::class, 'delete'])
                ->name('delete');
        });

        // =======================
        // Dummy Data
        // =======================
        Route::prefix('dummy')->group(function () {
            Route::get('/', [DummyDataController::class, 'index'])->name('dummy.index');
        });
    });
});