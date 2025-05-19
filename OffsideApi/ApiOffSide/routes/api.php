<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ControllerSesiones;
use App\Http\Controllers\ControllerActividades;
use App\Http\Controllers\ControllerDeportes;
use App\Http\Controllers\ControllerInstalaciones;
use App\Http\Controllers\ControllerUsuarios;
use App\Http\Controllers\ControllerMaterial;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Sesiones 
//Todos
Route::get('/sesiones', [SesionController::class, 'index']);
//Uno
Route::get('usuarios/{id}/sesiones', [ControllerSesiones::class, 'show']); 
//----------------------------------------------------------------------------
Route::post('/sesiones', [ControllerSesiones::class, 'store']);
Route::patch('/sesiones/{id}', [SesionController::class, 'update']);
Route::delete('/sesiones/{id}', [SesionController::class, 'destroy']);

//Actividades 
Route::get('/actividades', [ControllerActividades::class, 'index']);
Route::get('/actividades/{id}', [ControllerActividades::class, 'show']);
Route::post('/actividades', [ControllerActividades::class, 'store']);
Route::patch('/actividades/{id}', [ControllerActividades::class, 'update']); 
Route::delete('/actividades/{id}', [ControllerActividades::class, 'destroy']);

// Deportes
Route::get('/deportes', [ControllerDeportes::class, 'index']);
Route::get('/deportes/{id}', [ControllerDeportes::class, 'show']);
Route::post('/deportes', [ControllerDeportes::class, 'store']);
Route::patch('/deportes/{id}', [ControllerDeportes::class, 'update']); 
Route::delete('/deportes/{id}', [ControllerDeportes::class, 'destroy']);

//Instalaciones
Route::get('/instalaciones', [ControllerInstalaciones::class, 'index']);
Route::get('/instalaciones/{id}', [ControllerInstalaciones::class, 'show']);
Route::post('/instalaciones', [ControllerInstalaciones::class, 'store']);
Route::patch('/instalaciones/{id}', [ControllerInstalaciones::class, 'update']); 
Route::delete('/instalaciones/{id}', [ControllerInstalaciones::class, 'destroy']);

//Usuario
Route::get('/usuarios', [ControllerUsuarios::class, 'index']);
Route::get('/usuarios/{id}', [ControllerUsuarios::class, 'show']);
Route::post('/usuarios', [ControllerUsuarios::class, 'store']);
Route::patch('/usuarios/{id}', [ControllerUsuarios::class, 'update']); 
Route::delete('/usuarios/{id}', [ControllerUsuarios::class, 'destroy']);

//Passw
Route::get('/materiales', [MaterialController::class, 'index']);
Route::get('/materiales/{id}', [MaterialController::class, 'show']);
Route::post('/materiales', [MaterialController::class, 'store']);
Route::put('/materiales/{id}', [MaterialController::class, 'update']);
Route::delete('/materiales/{id}', [MaterialController::class, 'destroy']);