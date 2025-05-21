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
Route::get('/usuarios/{id}/sesiones', [ControllerSesiones::class, 'show']); //Solo uno 
/*
{"ses_id":2,"ses_fecha":"2025-02-03T00:00:00.000000Z","ses_hora":"10:00","ses_ins_id":1,"ses_dep_id":10,"ses_use_id":1,
"instalacion":{"ins_id":1,"ins_ nombre":"Santo Domingo","ins_localidad":"Alcorcon","ins_calle":"Los robles","ins_num":11,"ins_coordenadas":"40?20'20''N 3?50'60''26O"},
"deporte":{"dep_id":10,"dep_nombre":"F?tbol7","dep_numParticipantes":"14"},
"usuario":{"Use_id":1,"Use_Nom":"javiSaugar1","Use_ApeNom":"Javier Saugar","Use_telf":"617797032","Use_mail":"Javier.saugar@juanxxiii.net"},"actividades":
[]}
*/
//----------------------------------------------------------------------------
Route::get('/sesiones/filtrar/{nombre}', [SesionesController::class, 'filtrarPorNombre']);
Route::post('/sesiones', [ControllerSesiones::class, 'store']);//Crea sesion
Route::patch('/sesiones/{id}', [SesionController::class, 'update']);//Modifica sesion
Route::delete('/sesiones/{id}', [SesionController::class, 'destroy']);//Borrar sesion

//Actividades 
Route::get('/actividades', [ControllerActividades::class, 'index']);
Route::get('/actividades/{id}', [ControllerActividades::class, 'show']);
Route::post('/actividades', [ControllerActividades::class, 'store']);
Route::patch('/actividades/{id}', [ControllerActividades::class, 'update']); 
Route::delete('/actividades/{id}', [ControllerActividades::class, 'destroy']);

// Deportes
Route::get('/deportes', [ControllerDeportes::class, 'index']);
/*
[
{"dep_id":1,"dep_nombre":"Futbol11","dep_numParticipantes":"22"}
,{"dep_id":2,"dep_nombre":"Baloncesto","dep_numParticipantes":"10"}
,{"dep_id":3,"dep_nombre":"Voleibol","dep_numParticipantes":"12"}
,{"dep_id":4,"dep_nombre":"Tenis","dep_numParticipantes":"2"},
{"dep_id":5,"dep_nombre":"Nataci?n","dep_numParticipantes":"1"},
{"dep_id":6,"dep_nombre":"B?isbol","dep_numParticipantes":"18"},
{"dep_id":7,"dep_nombre":"Hockey","dep_numParticipantes":"12"},
{"dep_id":8,"dep_nombre":"Rugby","dep_numParticipantes":"30"},
{"dep_id":9,"dep_nombre":"Atletismo","dep_numParticipantes":"1"},
{"dep_id":10,"dep_nombre":"F?tbol7","dep_numParticipantes":"14"},
{"dep_id":11,"dep_nombre":"F?tbol sala","dep_numParticipantes":"10"}
]
*/
Route::get('/deportes/{id}', [ControllerDeportes::class, 'show']);
/*
{"dep_id":1,"dep_nombre":"Futbol11","dep_numParticipantes":"22"}
*/
Route::post('/deportes', [ControllerDeportes::class, 'store']);
Route::patch('/deportes/{id}', [ControllerDeportes::class, 'update']); 
Route::delete('/deportes/{id}', [ControllerDeportes::class, 'destroy']);

//Instalaciones
Route::get('/instalaciones', [ControllerInstalaciones::class, 'index']);
/*
[
{"ins_id":1,"ins_ nombre":"Santo Domingo","ins_localidad":"Alcorcon",
"ins_calle":"Los robles","ins_num":11,"ins_coordenadas":"40?20'20''N 3?50'60''26O"}
]
*/
Route::get('/instalaciones/{id}', [ControllerInstalaciones::class, 'show']);
/*
{"ins_id":1,"ins_ nombre":"Santo Domingo","ins_localidad":"Alcorcon","
ins_calle":"Los robles","ins_num":11,"ins_coordenadas":"40?20'20''N 3?50'60''26O"}
*/
Route::post('/instalaciones', [ControllerInstalaciones::class, 'store']);
Route::patch('/instalaciones/{id}', [ControllerInstalaciones::class, 'update']); 
Route::delete('/instalaciones/{id}', [ControllerInstalaciones::class, 'destroy']);

//Usuario
Route::get('/usuarios', [ControllerUsuarios::class, 'index']);
/*
[
{"Use_id":1,"Use_Nom":"javiSaugar1","Use_ApeNom":"Javier Saugar","Use_telf":"617797032","Use_mail":"Javier.saugar@juanxxiii.net"},
{"Use_id":2,"Use_Nom":"javiFutbolero","Use_ApeNom":"Javier Jimenez","Use_telf":"609654123","Use_mail":"Javier.jimenez@juanxxiii.net"},
{"Use_id":3,"Use_Nom":"AndreaMor","Use_ApeNom":"Andrea Moreno","Use_telf":"613654233","Use_mail":"andrea.moreno@juanxxiii.net"}
]
*/
Route::get('/usuarios/{id}', [ControllerUsuarios::class, 'show']);
 
Route::get('/usuarios/buscar/{nombre}', [ControllerUsuarios::class, 'buscarPorNombre']);
Route::post('/usuarios', [ControllerUsuarios::class, 'store']);
Route::patch('/usuarios/{id}', [ControllerUsuarios::class, 'update']); 
Route::delete('/usuarios/{id}', [ControllerUsuarios::class, 'destroy']);

//Passw 
Route::get('/materiales', [MaterialController::class, 'index']);
Route::get('/materiales/{id}', [MaterialController::class, 'show']);
Route::post('/materiales', [MaterialController::class, 'store']);
Route::put('/materiales/{id}', [MaterialController::class, 'update']);
Route::delete('/materiales/{id}', [MaterialController::class, 'destroy']);