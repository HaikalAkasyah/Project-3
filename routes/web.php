<?php

use Illuminate\Http\Request;
use App\Http\Controllers\loginregistercontroller;


Route::get('/', function () {
    return view('home');
});

Route::get('/auth/login', [loginregistercontroller::class, 'login'])->name('auth.login');

Route::get('/auth/register', [loginregistercontroller::class, 'register'])->name('auth.register');

Route::get('/user/home', [LoginRegisterController::class, 'userHome'])->name('user.home');

Route::get('/admin/home', [LoginRegisterController::class, 'adminHome'])->name('admin.home');

Route::post('/postRegister', [LoginRegisterController::class,'postRegister'])->name('postRegister');

Route::post('/postLogin', [LoginRegisterController::class, 'postLogin'])->name('postLogin');

Route::get('/logout', [LoginRegisterController::class, 'logout'])->name('logout');

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
    return view('home');
    });

Route::get('/auth/login', [LoginRegisterController::class, 'login'])
->name('auth.login');

Route::get('/auth/register', [LoginRegisterController::class,
    'register'])->name('auth.register');
    });

Route::group(['middleware' => ['auth', 'checklevel:admin']], function ()
    {
Route::get('/admin/home', [LoginRegisterController::class,
    'adminHome'])->name('admin.home');
    });
    Route::group(['middleware' => ['auth', 'checklevel:user']], function () {
    Route::get('/user/home', [LoginRegisterController::class,
    'userHome'])->name('user.home');
    });

Route::get('/logout', [LoginRegisterController::class, 'logout'])
->name('logout');

Route::post('/postLogin', [LoginRegisterController::class, 'postLogin'])
->name('postLogin');
    Route::post('/postRegister', [LoginRegisterController::class,
    'postRegister'])->name('postRegister');
