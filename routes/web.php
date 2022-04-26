<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers;
use App\Http\Controllers\Auth;

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

Route::get('/', function () {return view('login');})->name('login')->middleware('guest');
Route::post('/', [Auth\LoginController::class, 'login']);
Route::post('/logout', [Auth\LoginController::class, 'logout']);

Route::get('/domains', function () {return view('domains');})->middleware('auth');

Route::get('/backups', function () { return view('backups');})->middleware('auth');

Route::get('/newserver/create', function () {return view('newserver');})->middleware('auth');
Route::post('/newserver/add', [Controllers\ServerController::class, 'store'])->name('servers.store')->middleware('auth');
Route::get('/newserver/edit/{id}', [Controllers\ServerController::class, 'edit'])->middleware('auth');
Route::post('/newserver/update', [Controllers\ServerController::class, 'update'])->name('servers.update')->middleware('auth');
Route::get('/newserver/delete/{id}', [Controllers\ServerController::class, 'delete'])->middleware('auth');

Route::get('/servers', [Controllers\ServerController::class, 'read'])->name('servers.read')->middleware('auth');

