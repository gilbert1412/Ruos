<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TipoOrganizacionController;
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
    return view('layout.maestra');
});
Route::get('tipo-organizacion', [TipoOrganizacionController::class, 'index'])->name('tipoOrganizacion');
Route::post('tipo-organizacion/post', [TipoOrganizacionController::class, 'GuardarTipoOrganizacion'])->name('tipoOrganizacion.post');
Route::get('tipo-organizacion/get', [TipoOrganizacionController::class, 'cargarTabla'])->name('tipoOrganizacion.get');

