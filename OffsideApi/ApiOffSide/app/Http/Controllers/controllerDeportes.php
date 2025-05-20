<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deporte;

class ControllerDeportes extends Controller
{
 // Listar todos los deportes
    public function index()
    {
         return response()->json(Deporte::all(), 200);
    }

    // Mostrar un deporte específico
    public function show($id)
    {
        $deporte = Deporte::with('sesiones')->find($id);

        if (!$deporte) {
            return response()->json(['message' => 'Deporte no encontrado'], 404);
        }

        return response()->json($deporte, 200);
    }

    // Crear un nuevo deporte
    public function store(Request $request)
    {
        $request->validate([
            'dep_Nombre' => 'required|string|max:255',
            'dep_numParticipantes' => 'nullable|integer',
        ]);

        $deporte = Deporte::create($request->only(['dep_Nombre', 'dep_numParticipantes']));

        return response()->json($deporte, 201);
    }

    // Actualizar un deporte
    public function update(Request $request, $id)
    {
        $deporte = Deporte::find($id);

        if (!$deporte) {
            return response()->json(['message' => 'Deporte no encontrado'], 404);
        }

        $request->validate([
            'dep_Nombre' => 'sometimes|required|string|max:255',
            'dep_numParticipantes' => 'nullable|integer',
        ]);

        $deporte->update($request->only(['dep_Nombre', 'dep_numParticipantes']));

        return response()->json($deporte, 200);
    }

    // Eliminar un deporte
    public function destroy($id)
    {
        $deporte = Deporte::find($id);

        if (!$deporte) {
            return response()->json(['message' => 'Deporte no encontrado'], 404);
        }

        $deporte->delete();

        return response()->json(['message' => 'Deporte eliminado correctamente'], 200);
    }
}
