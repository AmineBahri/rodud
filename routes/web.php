<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('orders')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/create', [OrderController::class, 'create'])->name('orders.create');
        Route::post('/store', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
        Route::put('/{id}/update', [OrderController::class, 'update'])->name('orders.update');
        Route::delete('/{id}/delete', [OrderController::class, 'delete'])->name('orders.delete');
    });

Route::prefix('users')
    ->middleware(['role:admin','auth'])
    ->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::post('/communicate', [UserController::class, 'communicate'])->name('users.communicate');
    });

require __DIR__.'/auth.php';
