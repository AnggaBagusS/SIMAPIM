<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AgendaController;
use App\Http\Controllers\Api\PetugasController;
use App\Http\Controllers\Api\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes - SIMAPIM (Agenda Pimpinan)
|--------------------------------------------------------------------------
|
| Rute API berbasis JSON dengan autentikasi Laravel Sanctum Token.
| Digunakan untuk aplikasi mobile (Android/iOS) atau SPA front-end.
|
*/

// Version 1 API Prefix
Route::prefix('v1')->group(function () {

    // === Public Routes ===
    Route::post('/auth/login', [AuthController::class, 'login'])->name('api.v1.login');

    // === Protected Routes (Bearer Token Sanctum) ===
    Route::middleware('auth:sanctum')->group(function () {

        // --- Autentikasi & Profil ---
        Route::prefix('auth')->group(function () {
            Route::get('/me', [AuthController::class, 'me'])->name('api.v1.me');
            Route::put('/profile', [AuthController::class, 'updateProfile'])->name('api.v1.profile.update');
            Route::post('/logout', [AuthController::class, 'logout'])->name('api.v1.logout');
        });

        // --- Ringkasan Dashboard ---
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('api.v1.dashboard');

        // --- Modul Agenda Kegiatan ---
        Route::prefix('agendas')->group(function () {
            Route::get('/', [AgendaController::class, 'index'])->name('api.v1.agendas.index');
            Route::get('/my', [AgendaController::class, 'myAgendas'])->name('api.v1.agendas.my');
            Route::get('/{id}', [AgendaController::class, 'show'])->name('api.v1.agendas.show');
            Route::post('/', [AgendaController::class, 'store'])->name('api.v1.agendas.store');
            Route::put('/{id}', [AgendaController::class, 'update'])->name('api.v1.agendas.update');
            Route::delete('/{id}', [AgendaController::class, 'destroy'])->name('api.v1.agendas.destroy');
            Route::put('/{id}/link-dokumentasi', [AgendaController::class, 'updateLinkDokumentasi'])->name('api.v1.agendas.link');
        });

        // --- Direktori Petugas / Staff ---
        Route::prefix('petugas')->group(function () {
            Route::get('/', [PetugasController::class, 'index'])->name('api.v1.petugas.index');
            Route::get('/{id}', [PetugasController::class, 'show'])->name('api.v1.petugas.show');
        });

    });

});

// Fallback user route bawaan sanctum
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return new \App\Http\Resources\UserResource($request->user());
});
