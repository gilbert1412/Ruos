<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TipoOrganizacionController;
use App\Http\Controllers\Admin\DirectivoController;
use App\Http\Controllers\Admin\OrganizacionController;
use App\Http\Controllers\Admin\PersonaController;
use App\Http\Controllers\Admin\RolController;
use App\Http\Controllers\Admin\PermisoController;
use App\Http\Controllers\Admin\UserController;
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
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return view('auth.login');
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

//Persona

Route::get('personal', [OrganizacionController::class, 'verPersona'])->name('persona');
Route::get('persona', [OrganizacionController::class, 'cargarListaPersona'])->name('persona.get');

Route::post('persona/post', [PersonaController::class, 'GuardarPersona'])->name('persona.post');

//roles
Route::get('rol', [RolController::class, 'index'])->name('rol');
Route::get('rol/get', [RolController::class, 'cargarTabla'])->name('rol.mostrar');
Route::post('rol/post', [RolController::class, 'guardarRol'])->name('rol.post');

//Permiso
Route::get('permiso', [PermisoController::class, 'index'])->name('permiso');
Route::get('permiso/get', [PermisoController::class, 'cargarTabla'])->name('permiso.mostrar');
Route::post('permiso/post', [PermisoController::class, 'guardarPermiso'])->name('permiso.post');
Route::post('checkbox/get', [RolController::class, 'cargarCheckbox'])->name('checkbox.mostrar');

//roles
Route::get('user', [UserController::class, 'index'])->name('user');
Route::get('user/get', [UserController::class, 'cargarTabla'])->name('user.mostrar');
Route::post('user/post', [UserController::class, 'guardarUsuario'])->name('usuario.post');
