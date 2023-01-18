<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/name', [ProfileController::class, 'updateName'])->name('profile.update.name');
    Route::patch('/profile/email', [ProfileController::class, 'updateEmail'])->name('profile.update.email');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /** Project */
    Route::group(['prefix' => 'projects', 'as' => 'projects.'], function () {
        Route::get('/create', [\App\Http\Controllers\ProjectController::class, 'create'])->name('create');
        Route::get('/{project:uuid}', [\App\Http\Controllers\ProjectController::class, 'show'])->name('show');
        Route::post('/create', [\App\Http\Controllers\ProjectController::class, 'store'])->name('store');
        Route::post('/{project:uuid}/edit', [\App\Http\Controllers\ProjectController::class, 'edit'])->name('edit');
        Route::patch('/{project:uuid}', [\App\Http\Controllers\ProjectController::class, 'update'])->name('update');
        Route::delete('/{project:uuid}', [\App\Http\Controllers\ProjectController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';
