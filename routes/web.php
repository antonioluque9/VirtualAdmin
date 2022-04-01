<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

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

Route::get('/', function () {
    return view('login');
})->name('login')->middleware('guest');
Route::get('/servers', function () {
    return view('servers');
})->middleware('auth');
Route::get('/domains', function () {
    return view('domains');
})->middleware('auth');
Route::get('/backups', function () {
    return view('backups');
})->middleware('auth');
Route::get('/newserver', function () {
    return view('newserver');
})->middleware('auth');
Route::post('/', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout');

Route::post('newserver');



