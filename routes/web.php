<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SemiConductorController;
use App\Http\Controllers\TubesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'home'])
    ->name('home');

Route::group(['prefix' => 'auth'], function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login.form');
    Route::post('/login', [LoginController::class, 'login'])
        ->name('login');
    
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])
        ->name('register.form');
    Route::post('/register', [RegisterController::class, 'register'])
        ->name('register');

    Route::get('/logout', [LoginController::class, 'logout'])
        ->name('logout');
});

Route::group(['prefix' => 'semi-conductors'], function () {
    Route::get('/', [SemiConductorController::class, 'index'])->name('semi-conductors');
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
});

Route::group(['prefix' => 'tubes'], function () {
    Route::get('/', [TubesController::class, 'index'])
        ->name('tubes');
    Route::get('/add', [TubesController::class, 'addTubeForm'])
        ->name('tubes.addTubeForm');
    Route::get('/edit/{slug}', [TubesController::class, 'updateTubeForm'])
        ->where('slug', '[0-9A-Za-z\-]+')
        ->name('tubes.updateTubeForm');
    Route::get('/delete/{slug}', [TubesController::class, 'deleteTubeForm'])
        ->where('slug', '[0-9A-Za-z\-]+')
        ->name('tubes.deleteTubeForm');
    Route::get('/show/{slug}', [TubesController::class, 'showTubePage'])
        ->where('slug', '[0-9A-Za-z\-]+')
        ->name('tubes.show');
    Route::get('/datasheet/{slug}', [TubesController::class, 'datasheet'])
        ->where('slug', '[0-9A-Za-z\-]+')
        ->name('tubes.datasheet');

    Route::post('/', [TubesController::class, 'create'])
        ->name('tubes.create');
    Route::patch('/', [TubesController::class, 'update'])
        ->name('tubes.update');
    Route::delete('/', [TubesController::class, 'delete'])
        ->name('tubes.delete');
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/profile', [UsersController::class, 'profile'])
        ->name('users.profile');
    Route::post('/', [UsersController::class, 'create'])->name('users.create');
});