<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/upload-csv', [App\Http\Controllers\HomeController::class, 'uploadCSV'])->name('upload_csv');
Route::get('/datatables', [App\Http\Controllers\HomeController::class, 'datatables'])->name('datatables');

/* Make quiz */
//Route::get('/make-quiz', [App\Http\Controllers\QuizController::class, 'makeQuiz'])->name('make_quiz');
Route::view('/make-quiz','make-quiz')->name('make_quiz');
Route::post('/store-quiz', [App\Http\Controllers\QuizController::class, 'storeQuiz'])->name('store');

Route::get('/test', [App\Http\Controllers\HomeController::class, 'test'])->name('test');