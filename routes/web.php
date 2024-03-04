<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TipoOrganizacionController;
use App\Http\Controllers\Admin\DirectivoController;
use App\Http\Controllers\Admin\OrganizacionController;
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
//TipoOrganizacion
Route::get('tipo-organizacion', [TipoOrganizacionController::class, 'index'])->name('tipoOrganizacion');
Route::post('tipo-organizacion/post', [TipoOrganizacionController::class, 'GuardarTipoOrganizacion'])->name('tipoOrganizacion.post');
Route::get('tipo-organizacion/get', [TipoOrganizacionController::class, 'cargarTabla'])->name('tipoOrganizacion.mostrar');

//Directivo
Route::get('directivo', [DirectivoController::class, 'index'])->name('directivo');
Route::post('directivo/post', [DirectivoController::class, 'GuardarDirectivo'])->name('directivo.post');
Route::get('directivo/get', [DirectivoController::class, 'cargarTabla'])->name('directivo.mostrar');

//Organizacion
Route::get('organizacion', [OrganizacionController::class, 'index'])->name('organizacion');
Route::post('organizacion/post', [OrganizacionController::class, 'GuardarOrganizacion'])->name('organizacion.post');
Route::get('organizacion/get', [OrganizacionController::class, 'cargarTabla'])->name('organizacion.mostrar');
