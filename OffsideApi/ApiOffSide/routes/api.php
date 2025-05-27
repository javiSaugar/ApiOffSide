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
Route::get('/sesiones', [ControllerSesiones::class, 'index']);
/*
[
{"ses_id":2,"ses_fecha":"2025-02-03T00:00:00.000000Z","ses_hora":"10:00","ses_ins_id":1,"ses_dep_id":10,"ses_use_id":1,
"instalacion":{"ins_id":1,"ins_ nombre":"Santo Domingo","ins_localidad":"Alcorcon","ins_calle":"Los robles","ins_num":11,"ins_coordenadas":"40?20'20''N 3?50'60''26O"},
"deporte":{"dep_id":10,"dep_nombre":"F?tbol7","dep_numParticipantes":"14"},
"usuario":{"Use_id":1,"Use_Nom":"javiSaugar1","Use_ApeNom":"Javier Saugar","Use_telf":"617797032","Use_mail":"Javier.saugar@juanxxiii.net"},"actividades":[]
}
]
*/
//Uno
Route::get('/sesiones/{id}', [ControllerSesiones::class, 'show']); //Solo uno 
/*
{"ses_id":2,"ses_fecha":"2025-02-03T00:00:00.000000Z","ses_hora":"10:00","ses_ins_id":1,"ses_dep_id":10,"ses_use_id":1,
"instalacion":{"ins_id":1,"ins_ nombre":"Santo Domingo","ins_localidad":"Alcorcon","ins_calle":"Los robles","ins_num":11,"ins_coordenadas":"40?20'20''N 3?50'60''26O"},
"deporte":{"dep_id":10,"dep_nombre":"F?tbol7","dep_numParticipantes":"14"},
"usuario":{"Use_id":1,"Use_Nom":"javiSaugar1","Use_ApeNom":"Javier Saugar","Use_telf":"617797032","Use_mail":"Javier.saugar@juanxxiii.net"},"actividades":
[]}
*/
//----------------------------------------------------------------------------
Route::get('/sesiones/filtrar/{nombre}', [ControllerSesiones::class, 'filtrarPorNombreSesion']);
Route::post('/sesiones', [ControllerSesiones::class, 'store']);//Crea sesion
Route::patch('/sesiones/{id}', [ControllerSesiones::class, 'update']);//Modifica sesion
Route::delete('/sesiones/{id}', [ControllerSesiones::class, 'destroy']);//Borrar sesion

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
Route::get('/usuarios/buscar/{nombre}', [ControllerUsuarios::class, 'buscarPorNombre']);
Route::post('/usuarios', [ControllerUsuarios::class, 'store']);
Route::patch('/usuarios/{id}', [ControllerUsuarios::class, 'update']); 
Route::delete('/usuarios/{id}', [ControllerUsuarios::class, 'destroy']);

//Passw 
Route::get('/materiales', [ControllerMaterial::class, 'index']);
Route::get('/materiales/{id}', [ControllerMaterial::class, 'show']);
Route::post('/materiales', [ControllerMaterial::class, 'store']);
Route::put('/materiales/{id}', [ControllerMaterial::class, 'update']);
Route::delete('/materiales/{id}', [ControllerMaterial::class, 'destroy']);