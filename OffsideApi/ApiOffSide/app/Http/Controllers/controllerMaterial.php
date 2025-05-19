<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controllerMaterial extends Controller
{
     // Listar todos los materiales
    public function index()
    {
        $materiales = Material::with('usuario')->get();
        return response()->json($materiales, 200);
    }

    // Mostrar un material específico
    public function show($id)
    {
        $material = Material::with('usuario')->find($id);

        if (!$material) {
            return response()->json(['message' => 'Material no encontrado'], 404);
        }

        return response()->json($material, 200);
    }

    // Crear un nuevo material
    public function store(Request $request)
    {
        $request->validate([
            'mat_pass' => 'required|string|max:255',
            'mat_use_id' => 'required|exists:usuarios,Use_id', // Asegura que el usuario exista
        ]);

        $material = Material::create($request->only([
            'mat_pass',
            'mat_use_id',
        ]));

        return response()->json($material, 201);
    }

    // Actualizar un material
    public function update(Request $request, $id)
    {
        $material = Material::find($id);

        if (!$material) {
            return response()->json(['message' => 'Material no encontrado'], 404);
        }

        $request->validate([
            'mat_pass' => 'sometimes|required|string|max:255',
            'mat_use_id' => 'sometimes|required|exists:usuarios,Use_id', // Asegura que el usuario exista
        ]);

        $material->update($request->only([
            'mat_pass',
            'mat_use_id',
        ]));

        return response()->json($material, 200);
    }

    // Eliminar un material
    public function destroy($id)
    {
        $material = Material::find($id);

        if (!$material) {
            return response()->json(['message' => 'Material no encontrado'], 404);
        }

        $material->delete();

        return response()->json(['message' => 'Material eliminado correctamente'], 200);
    }
}
