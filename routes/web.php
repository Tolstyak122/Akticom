<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', fn () => view('welcome'))->name('index');

Route::get('/catalogue', fn () => view('catalogue'))->name('catalogue');
Route::post('/upload', [\App\Http\Controllers\Import::class, 'uploadFromCSV'])->name('upload');
