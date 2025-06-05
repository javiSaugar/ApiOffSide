<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;

class ControllerActividades extends Controller
{
    // Devuelve lista de todas las Actividades(SESION  | USUARIOS )
    public function index()
    {
        return response()->json(Actividad::all(), 200);
    }

    // Mostrar una actividad específica
    public function show($id)
    {
        $actividad = Actividad::with(['sesion', 'usuario'])->find($id);

        if (!$actividad) {
            return response()->json(['message' => 'Actividad no encontrada'], 404);
        }

        return response()->json($actividad, 200);
    }

    // Crear una nueva actividad
    public function store(Request $request)
    {
    // Aquí validas y asignas el resultado a $validated
    $validated = $request->validate([
        'act_ses_id' => 'required|integer|exists:sesiones,ses_id',
        'act_use_id' => 'required|integer|exists:users,id',
    ]);

    $actividad = new Actividad();
    $actividad->act_ses_id = $validated['act_ses_id'];
    $actividad->act_use_id = $validated['act_use_id'];
    $actividad->save();

    return response()->json([
        'message' => 'Actividad creada correctamente',
        'data' => $actividad
    ], 201);
    }

    // Actualizar una actividad
    public function update(Request $request, $id)
    {
        $actividad = Actividad::find($id);

        if (!$actividad) {
            return response()->json(['message' => 'Actividad no encontrada'], 404);
        }

        $actividad->update($request->all());

        return response()->json($actividad, 200);
    }

    // Eliminar una actividad
    public function destroy($id)
    {
        $actividad = Actividad::find($id);

        if (!$actividad) {
            return response()->json(['message' => 'Actividad no encontrada'], 404);
        }

        $actividad->delete();

        return response()->json(['message' => 'Actividad eliminada correctamente'], 200);
    }

    public function getBySesionId($sesionId)
{
    $actividades = Actividad::where('act_ses_id', $sesionId)->get();

    if ($actividades->isEmpty()) {
        return response()->json([
            'message' => 'No se encontraron actividades para esta sesión.'
        ], 404);
    }

    return response()->json([
        'message' => 'Actividades encontradas.',
        'data' => $actividades
    ]);
}

// Obtener actividades por ID de usuario
public function getByUserId($userId)
{
    $actividades = Actividad::where('act_use_id', $userId)->get();

    if ($actividades->isEmpty()) {
        return response()->json([
            'message' => 'No se encontraron actividades para este usuario.'
        ], 404);
    }

    return response()->json([
        'message' => 'Actividades encontradas.',
        'data' => $actividades
    ]);
}

}
