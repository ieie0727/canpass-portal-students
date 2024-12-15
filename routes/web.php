<?php

use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StudentController;

// 認証ルート
Auth::routes();

// ホーム画面のルート
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');

/*
|--------------------------------------------------------------------------
| Student関連ルート
|--------------------------------------------------------------------------
| 生徒情報に関するルート設定
| /students に関連したルートをまとめています。
|--------------------------------------------------------------------------
*/
Route::controller(StudentController::class)
    ->middleware('auth')
    ->prefix('students')
    ->name('students.')
    ->group(function () {
        Route::get('{id}', 'show')->name('show');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('update/{id}', 'update')->name('update');
    });

/*
|--------------------------------------------------------------------------
| School関連ルート
|--------------------------------------------------------------------------
| 学校関連の情報に関するルート設定
| /schools に関連したルートをまとめています。
|--------------------------------------------------------------------------
*/
Route::controller(SchoolController::class)
    ->middleware('auth')
    ->prefix('schools')
    ->name('schools.')
    ->group(function () {
        Route::get('{id}', 'index')->name('index'); // 一覧表示
        Route::get('scores/edit/{id}', 'editScore')->name('scores.edit'); // スコア編集画面
        Route::put('scores/update/{id}', 'updateScore')->name('scores.update'); // スコア編集処理
        Route::get('grades/edit/{id}', 'editGrade')->name('grades.edit'); // 内申点編集画面
        Route::put('grades/update/{id}', 'updateGrade')->name('grades.update'); // 内申点編集処理
    });
