<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;

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

// Halaman form login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Submit form login
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard Admin
Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('DashboardAdmin');

// Dashboard Staff
Route::get('/dashboard-staff', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role:staff'])
    ->name('DashboardStaff');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'update'])->name('profile.update');
    Route::put('/agenda/{id}/link-dokumentasi', [AgendaController::class, 'updateLinkDokumentasi'])->name('agenda.updateLinkDokumentasi');
});

Route::prefix('agenda')->name('agenda.')->middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff/{id}', [AgendaController::class, 'showStaff'])->name('showStaff');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    // Petugas
    Route::resource('petugas', PetugasController::class);
    Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');
    Route::get('/petugas/create', [PetugasController::class, 'create'])->name('petugas.create');
    Route::post('/petugas', [PetugasController::class, 'store'])->name('petugas.store');

    // Agenda (khusus admin)
    Route::prefix('agenda')->name('agenda.')->group(function () {
        Route::get('/', [AgendaController::class, 'index'])->name('index');
        Route::get('/create', [AgendaController::class, 'create'])->name('create');
        Route::get('/{id}', [AgendaController::class, 'show'])->name('show');
        Route::post('/', [AgendaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AgendaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AgendaController::class, 'update'])->name('update');
        Route::delete('/{id}', [AgendaController::class, 'destroy'])->name('destroy');
    });

    // Audit Trail / Activity Log
    Route::get('/activity-log', [\App\Http\Controllers\ActivityLogController::class, 'index'])->name('activity-log.index');
});

// Dokumentasi Interaktif OpenAPI / Swagger UI
Route::get('/docs', function () {
    return file_get_contents(base_path('docs/index.html'));
})->name('api.docs');

Route::get('/docs/api.json', function () {
    return response()->file(base_path('docs/api.json'), [
        'Content-Type' => 'application/json'
    ]);
});

Route::get('/api.json', function () {
    return response()->file(base_path('docs/api.json'), [
        'Content-Type' => 'application/json'
    ]);
});
