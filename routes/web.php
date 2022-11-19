<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\OsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmpresaController;
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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::group(['middleware' => 'auth'], function() {

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('clientes', ClienteController::class);

Route::resource('marcas', MarcaController::class);

Route::resource('ordens', OsController::class);

Route::resource('usuarios', UserController::class);

Route::resource('empresas', EmpresaController::class)->except([
    'index','create', 'destroy', 'store'
]);

Route::get('/ordens/{id}/entrega', [OsController::class, 'entregaShow'])->name('ordens.orcamento');

Route::put('/entrega/{id}', [OsController::class, 'entrega'])->name('ordens.entrega');

Route::get('autocompletecliente', [ClienteController::class, 'autocomplete'])->name('autocompletecliente');

Route::get('autocompletemarca', [MarcaController::class, 'autocomplete'])->name('autocompletemarca');

Route::post('buscarOs', [OsController::class, 'buscarOs'])->name('buscarOs');

Route::get('imprimirOs', [OsController::class, 'imprimirOs'])->name('imprimirOs');

});

/* Route::put('/ordensOrcamento/{id}', [OsController::class, 'orcamentoStore'])->name('ordens.orcamentoStore');

Route::put('/status/{id}', [OsController::class, 'orcamentoStore'])->name('ordens.status'); */

/* Route::get('/ordemservico/{id}', [OsController::class, 'showTeste']);

Route::get('/ordemservico/{id}/edit', [OsController::class, 'editTeste']);

Route::delete('/ordemservico/{id}/delete', [OsController::class, 'destroyTeste']); */


