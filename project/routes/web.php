<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PastorController;
use App\Http\Controllers\CarecellLeaderController;
use App\Http\Controllers\CarecellAreaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('pages.admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/user/list', [UserController::class, 'get'])->name('user.list')->middleware('can:manage-users');
    Route::get('/user/detail/{id}', [UserController::class, 'show'])->name('user.detail')->middleware('can:edit-users');
    Route::post('/user/save', [UserController::class, 'store'])->name('user.store');

    Route::get('/pastor/list', [PastorController::class, 'get'])->name('pastor.list')->middleware('can:manage-users');
    Route::get('/pastor/detail/{id}', [PastorController::class, 'show'])->name('pastor.detail')->middleware('can:edit-users');
    Route::post('/pastor/save', [PastorController::class, 'store'])->name('pastor.store');

    // Carecell Leaders
    Route::get('/carecell-leader/list', [CarecellLeaderController::class, 'get'])->name('carecell_leader.list');
    Route::get('/carecell-leader/detail/{id}', [CarecellLeaderController::class, 'show'])->name('carecell_leader.detail');
    Route::post('/carecell-leader/save', [CarecellLeaderController::class, 'store'])->name('carecell_leader.store');

    // Carecell Areas
    Route::get('/carecell-area/list', [CarecellAreaController::class, 'get'])->name('carecell_area.list');
    Route::get('/carecell-area/detail/{id}', [CarecellAreaController::class, 'show'])->name('carecell_area.detail');
    Route::post('/carecell-area/save', [CarecellAreaController::class, 'store'])->name('carecell_area.store');
});

require __DIR__ . '/auth.php';
