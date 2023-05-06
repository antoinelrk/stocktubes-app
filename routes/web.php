<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SemiConductorController;
use App\Http\Controllers\TubesController;
use App\Http\Controllers\UsersController;
use App\Models\SemiConductor;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'home'])
    ->name('home');
Route::get('/test', [PagesController::class, 'zipDatasheets'])
    ->name('test');

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

Route::group(['prefix' => 'smc'], function () {
    Route::get('/export', [SemiConductorController::class, 'export'])
        ->name('smc.export');
    Route::get('/', [SemiConductorController::class, 'index'])
        ->name('smc');
    Route::get('/add', function () {
        return view('smc.addSmcForm');
    })
    ->middleware('auth')
    ->name('smc.addSmcForm');

    Route::get('/edit/{slug}', [SemiConductorController::class, 'updateSmcForm'])
        ->where('slug', '[0-9A-Za-z\-]+')
        ->name('smc.updateSmcForm');
    Route::get('/delete/{slug}', [SemiConductorController::class, 'delete'])
        ->where('slug', '[0-9A-Za-z\-]+');
    Route::get('/show/{slug}', [SemiConductorController::class, 'showSmcPage'])
        ->where('slug', '[0-9A-Za-z\-]+')
        ->name('smc.show');

    Route::get('/datasheet/{slug}', [SemiConductorController::class, 'datasheet'])
        ->where('slug', '[0-9A-Za-z\-]+')
        ->name('smc.datasheet');
    Route::get('/datasheet/remove/{slug}', [SemiConductorController::class, 'removeDatasheet'])
        ->where('slug', '[0-9A-Za-z\-]+')
        ->name('smc.datasheet.remove');

    Route::post('/create', [SemiConductorController::class, 'create'])
        ->name('smc.create');
    Route::post('/update/{slug}', [SemiConductorController::class, 'update'])
        ->where('slug', '[0-9A-Za-z\-]+')
        ->name('smc.update');
    Route::post('/delete/{slug}', [SemiConductorController::class, 'delete'])
        ->where('slug', '[0-9A-Za-z\-]+')
        ->name('smc.delete');
    Route::get('/export', [SemiConductorController::class, 'export'])
        ->name('smc.export');
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
});

Route::group(['prefix' => 'tubes'], function () {
    Route::get('/', [TubesController::class, 'index'])
        ->name('tubes');
    Route::get('/add', function () {
        return view('tubes.addTubeForm');
    })
    ->middleware('auth')
    ->name('tubes.addTubeForm');

    Route::get('/edit/{slug}', [TubesController::class, 'updateTubeForm'])
        ->where('slug', '[0-9A-Za-z\-]+')
        ->name('tubes.updateTubeForm');
    Route::get('/delete/{slug}', [TubesController::class, 'delete'])
        ->where('slug', '[0-9A-Za-z\-]+');
    Route::get('/show/{slug}', [TubesController::class, 'showTubePage'])
        ->where('slug', '[0-9A-Za-z\-]+')
        ->name('tubes.show');

    Route::get('/datasheet/{slug}', [TubesController::class, 'datasheet'])
        ->where('slug', '[0-9A-Za-z\-]+')
        ->name('tubes.datasheet');
    Route::get('/datasheet/remove/{slug}', [TubesController::class, 'removeDatasheet'])
        ->where('slug', '[0-9A-Za-z\-]+')
        ->name('tubes.datasheet.remove');

    Route::post('/create', [TubesController::class, 'create'])
        ->name('tubes.create');
    Route::post('/update/{slug}', [TubesController::class, 'update'])
        ->where('slug', '[0-9A-Za-z\-]+')
        ->name('tubes.update');
    Route::post('/delete/{slug}', [TubesController::class, 'delete'])
        ->where('slug', '[0-9A-Za-z\-]+')
        ->name('tubes.delete');
    Route::get('/export', [TubesController::class, 'export'])
        ->name('tubes.export');
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/profile', [UsersController::class, 'profile'])
        ->name('users.profile');
    Route::post('/', [UsersController::class, 'create'])->name('users.create');
});