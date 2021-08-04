<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\roigController;
use App\Http\Controllers\ValorsController;

use App\Http\Controllers\TaronjaController;
use App\Http\Controllers\GrocController;
use App\Http\Controllers\VerdController;
use App\Http\Controllers\BlauController;
use App\Http\Controllers\IndigoController;
use App\Http\Controllers\VioletaController;
use App\Http\Controllers\DinersController;
use App\Http\Controllers\UserController;


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


Route::resource('Roig', roigController::class)->middleware('auth');
Route::resource('Taronja', TaronjaController::class)->middleware('auth');;
Route::resource('Groc', GrocController::class)->middleware('auth');;
Route::resource('Verd', VerdController::class)->middleware('auth');;
Route::resource('Blau', BlauController::class)->middleware('auth');;
Route::resource('Indigo', IndigoController::class)->middleware('auth');;
Route::resource('Violeta', VioletaController::class)->middleware('auth');;
Route::resource('Diners', DinersController::class)->middleware('auth');;
Route::resource('User', UserController::class);
Route::get('aaa', [ValorsController::class, 'este']);


Route::resource('Valors', ValorsController::class);

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
