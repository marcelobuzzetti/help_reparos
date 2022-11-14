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

Route::resource('ordens', OsController::class);

Route::get('/ordens/{id}/orcamento', [OsController::class, 'orcamento'])->name('ordens.orcamento');

/* Route::put('/ordensOrcamento/{id}', [OsController::class, 'orcamentoStore'])->name('ordens.orcamentoStore'); */

/* Route::put('/status/{id}', [OsController::class, 'orcamentoStore'])->name('ordens.status'); */

Route::put('/entrega/{id}', [OsController::class, 'orcamentoStore'])->name('ordens.entrega');

/* Route::get('/ordemservico/{id}', [OsController::class, 'showTeste']);

Route::get('/ordemservico/{id}/edit', [OsController::class, 'editTeste']);

Route::delete('/ordemservico/{id}/delete', [OsController::class, 'destroyTeste']); */


