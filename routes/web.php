<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\OsController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('clientes', ClienteController::class);

Route::resource('marcas', MarcaController::class);

Route::resource('ordens', OsController::class)->except([
   'show'
]);;

Route::get('/ordemservico/{id}', [OsController::class, 'showTeste']);

Route::get('/ordemservico/{id}/edit', [OsController::class, 'editTeste']);


