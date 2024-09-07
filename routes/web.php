<?php

// use App\Http\Controllers\ProfileController;    // コメントアウトにする
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController; // 追記
use App\Http\Controllers\TransfersController; // 追記

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

Route::get('/', [TransfersController::class, 'index']);
Route::get('/dashboard', [TransfersController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('users/{id}')->group(function () {
        Route::get('transfers', [UsersController::class, 'transfers'])->name('users.transfers');
        Route::get('inout', [UsersController::class, 'inout'])->name('users.inout');
        Route::get('send', [UsersController::class, 'send'])->name('users.send');
    });
    Route::resource('users', UsersController::class, ['only' => ['show','create']]);
    Route::resource('transfers', TransfersController::class, ['only' => ['index', 'store']]);//,'store2'
});

require __DIR__.'/auth.php';
