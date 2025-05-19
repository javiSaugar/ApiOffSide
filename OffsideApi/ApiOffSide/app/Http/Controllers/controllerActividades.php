<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerActividades extends Controller
{
    // Devuelve lista de todas las Actividades(SESION  | USURIOS )
    public function index()
    {
        return response()->json(actividades::with(['sesion', 'usuario'])->get(), 200);
    }

    // Mostrar una actividad específica
    public function show($id)
    {
        $actividad = actividades::with(['sesion', 'usuario'])->find($id);

        if (!$actividad) {
            return response()->json(['message' => 'Actividad no encontrada'], 404);
        }

        return response()->json($actividad, 200);
    }

    // Crear una nueva actividad
    public function store(Request $request)
    {
        $request->validate([
            'act_ses_id' => 'required|integer|exists:sesions,id',  // ajusta 'id' si el PK es distinto
            'act_use_id' => 'required|integer|exists:usuarios,id',
        ]);

        $actividad = actividades::create($request->all());

        return response()->json($actividad, 201);
    }

    // Actualizar una actividad
    public function update(Request $request, $id)
    {
        $actividad = actividades::find($id);

        if (!$actividad) {
            return response()->json(['message' => 'Actividad no encontrada'], 404);
        }

        $actividad->update($request->all());

        return response()->json($actividad, 200);
    }

    // Eliminar una actividad
    public function destroy($id)
    {
        $actividad = actividades::find($id);

        if (!$actividad) {
            return response()->json(['message' => 'Actividad no encontrada'], 404);
        }

        $actividad->delete();

        return response()->json(['message' => 'Actividad eliminada correctamente'], 200);
    }

}
