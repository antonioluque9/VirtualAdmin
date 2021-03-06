<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers;
use App\Http\Controllers\Auth;
use App\Http\Livewire;

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
        if (!App\Models\User::all()->first()){
            return view('register');
        }else{
            return view('login');
        }})->middleware('guest');

    Route::post('/register', [Auth\LoginController::class, 'register'])->name('register');
    Route::post('/login', [Auth\LoginController::class, 'login'])->name('login');
    Route::get('/logout', [Auth\LoginController::class, 'logout']);

    Route::get('/virtualhosts', Livewire\LiveVirtualhostsTable::class)->middleware('auth');

    Route::get('/backups', Livewire\LiveBackupsTable::class  )->middleware('auth');

    Route::get('/newserver/create', function () {return view('newserver');})->middleware('auth');
    Route::post('/newserver/add', [Controllers\ServerController::class, 'store'])->name('servers.store')->middleware('auth');
    Route::get('/newserver/edit/{id}', [Controllers\ServerController::class, 'edit'])->middleware('auth');
    Route::post('/newserver/update', [Controllers\ServerController::class, 'update'])->name('servers.update')->middleware('auth');
    Route::get('/newserver/delete/{id}', [Controllers\ServerController::class, 'delete'])->middleware('auth');

    Route::get('/newserver/editname', [Controllers\ServerController::class, 'editname'])->name('servers.editname')->middleware('auth');
    Route::get('/changemail', [Controllers\User::class, 'changemail'])->name('user.changemail')->middleware('auth');
    Route::get('/changepasswd', [Auth\LoginController::class, 'changepasswd'])->name('user.changepasswd')->middleware('auth');

    Route::get('/servers', [Controllers\ServerController::class, 'read'])->name('servers.read')->middleware('auth');

    Route::get('/reload', [Controllers\ReloadInformation::class, 'reloadInformation'])->middleware('auth');



