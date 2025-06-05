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
    $deporte = Deporte::find($id);

    if (!$deporte) {
        return response()->json(['message' => 'Deporte no encontrado'], 404);
    }

    return response()->json($deporte, 200);
    }

    // Crear un nuevo deporte
    public function store(Request $request)
    {
        try {
        // Validar los datos recibidos
        $request->validate([
            'dep_nombre' => 'required|string|max:255',
            'dep_numparticipantes' => 'required|integer',
        ]);

        // Crear el deporte con los datos validados
        $deporte = Deporte::create([
            'dep_nombre' => $request->dep_nombre,
            'dep_numparticipantes' => $request->dep_numparticipantes,
        ]);

        // Retornar respuesta con código 201 y el objeto creado
        return response()->json([
            'message' => 'Deporte creado correctamente.',
            'deporte' => $deporte,
        ], 201);

    } catch (\Exception $e) {
        \Log::error('Error al crear deporte: ' . $e->getMessage());

        return response()->json([
            'message' => 'Error al crear deporte',
            'error' => $e->getMessage(),
        ], 500);
    }
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
