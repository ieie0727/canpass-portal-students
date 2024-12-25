<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\TestController;

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
        Route::get('/', 'show')->name('show');
        Route::get('edit', 'edit')->name('edit');
        Route::put('update', 'update')->name('update');
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
        Route::get('/', 'index')->name('index');
        Route::get('scores/edit/{score_id}', 'editScore')->name('scores.edit');
        Route::put('scores/update/{score_id}', 'updateScore')->name('scores.update');
        Route::get('grades/edit/{grade_id}', 'editGrade')->name('grades.edit');
        Route::put('grades/update/{grade_id}', 'updateGrade')->name('grades.update');
    });

/*
|--------------------------------------------------------------------------
| Test関連ルート
|--------------------------------------------------------------------------
| 学習・テストに関するルート設定
| /tests に関連したルートをまとめています。
|--------------------------------------------------------------------------
*/
Route::controller(TestController::class)
    ->middleware('auth')
    ->prefix('tests')
    ->name('tests.')
    ->group(function () {
        Route::get('home', 'home')->name('home');
        Route::get('{subject}', 'subject')->name('subject');
        Route::get('try/{section_id}', 'try')->name('try');
        Route::post('submit/{section_id}', 'submit')->name('submit');
        Route::get('retry/{section_id}', 'retry')->name('retry');
        Route::post('resubmit/{section_id}', 'resubmit')->name('resubmit');
        Route::get('record/{section_id}', 'record')->name('record');
    });
