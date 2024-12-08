<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StudentContoroller;
use App\Http\Controllers\StudentController;

// 認証ルート
Auth::routes();

// ホーム画面のルート
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');

Route::controller(StudentController::class)
    ->middleware('auth')
    ->prefix('students')
    ->name('students.')
    ->group(function () {
        Route::get('/{id}', 'show')->name('show');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('update/{id}', 'update')->name('update');
    });
