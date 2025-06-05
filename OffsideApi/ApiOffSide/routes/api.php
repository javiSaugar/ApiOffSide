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
// Funcionan Todos
Route::get('/sesiones', [ControllerSesiones::class, 'index']);
Route::get('/sesiones/{id}', [ControllerSesiones::class, 'show']); //Solo uno 
Route::get('/sesiones/filtrar/{nombre}', [ControllerSesiones::class, 'buscarPorNombreSesion']);
Route::post('/sesiones', [ControllerSesiones::class, 'store']);//Crea sesion
Route::patch('/sesiones/{id}', [ControllerSesiones::class, 'update']);//Modifica sesion
Route::delete('/sesiones/{id}', [ControllerSesiones::class, 'destroy']);//Borrar sesion

//Actividades 
Route::get('/actividades', [ControllerActividades::class, 'index']);
Route::get('/actividades/{id}', [ControllerActividades::class, 'show']);
Route::post('/actividades', [ControllerActividades::class, 'store']);
Route::patch('/actividades/{id}', [ControllerActividades::class, 'update']); 
Route::delete('/actividades/{id}', [ControllerActividades::class, 'destroy']);
Route::get('/actividades/sesion/{sesionId}', [ControllerActividades::class, 'getBySesionId']);
Route::get('/actividades/usuario/{userId}', [ControllerActividades::class, 'getByUserId']);

// Deportes
//Funcionan todos 
Route::get('/deportes', [ControllerDeportes::class, 'index']);
Route::get('/deportes/{id}', [ControllerDeportes::class, 'show']);
Route::post('/deportes', [ControllerDeportes::class, 'store']);
Route::patch('/deportes/{id}', [ControllerDeportes::class, 'update']); 
Route::delete('/deportes/{id}', [ControllerDeportes::class, 'destroy']);

//Instalaciones
//Funciona todos  
Route::get('/instalaciones', [ControllerInstalaciones::class, 'index']);
Route::get('/instalaciones/{id}', [ControllerInstalaciones::class, 'show']);
Route::post('/instalaciones', [ControllerInstalaciones::class, 'store']);
Route::patch('/instalaciones/{id}', [ControllerInstalaciones::class, 'update']); 
Route::delete('/instalaciones/{id}', [ControllerInstalaciones::class, 'destroy']);

//Usuario

// Rutas públicas
Route::post('/login', [ControllerUsuarios::class, 'login']);
Route::post('/usuarios', [ControllerUsuarios::class, 'store']);
Route::get('/usuarios', [ControllerUsuarios::class, 'index']);

// Rutas protegidas con Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ControllerUsuarios::class, 'logout']);
    Route::get('/profile', [ControllerUsuarios::class, 'user']);

    Route::get('/usuarios/{id}', [ControllerUsuarios::class, 'show']);
    Route::put('/usuarios/{id}', [ControllerUsuarios::class, 'update']);
    Route::delete('/usuarios/{id}', [ControllerUsuarios::class, 'destroy']);

    Route::post('/usuarios/{id}/change-password', [ControllerUsuarios::class, 'changePassword']);
    Route::get('/usuarios/buscar', [ControllerUsuarios::class, 'buscarPorNombre']);
});

