<?php

use App\Http\Controllers\Dashboard\ParametrosController;
use App\Http\Controllers\Dashboard\SearchController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\PacientesController;
use App\Http\Controllers\Dashboard\ConsultasController;
use App\Http\Controllers\Dashboard\ControlController;
use App\Http\Controllers\Dashboard\GinecologiaController;
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

Route::match(
    ['get', 'post'],
    '/dashboard/navbar/search',
    [SearchController::class, 'showNavbarSearchResults']
)->middleware(['auth', 'isadmin', 'estatus']);

Route::middleware(['auth', 'estatus'])->prefix('/dashboard')->group(function (){

    Route::get('parametros/{parametro?}', [ParametrosController::class, 'index'])->name('parametros.index')->middleware(['isadmin']);
    Route::get('usuarios/{usuario?}', [UsersController::class, 'index'])->name('usuarios.index')->middleware(['isadmin', 'permisos']);
    Route::get('export/usuarios/{buscar?}', [UsersController::class, 'export'])->name('usuarios.excel')->middleware(['isadmin', 'permisos']);
    Route::get('pdf/usuarios', [UsersController::class, 'createPDF'])->name('usuarios.pdf')->middleware(['isadmin', 'permisos']);

    Route::get('pacientes', [PacientesController::class, 'index'])->name('pacientes.index');
    Route::get('consultas', [ConsultasController::class, 'index'])->name('consultas.index');
    Route::get('control', [ControlController::class, 'index'])->name('control.index');
    Route::get('ginecologia', [GinecologiaController::class, 'index'])->name('ginecologia.index');

});
