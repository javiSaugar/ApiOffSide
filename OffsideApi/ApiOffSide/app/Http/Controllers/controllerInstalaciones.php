<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controllerInstalaciones extends Controller
{
     // Listar todas las instalaciones
    public function index()
    {
        return response()->json(instalaciones::with('sesiones')->get(), 200);
    }

    // Mostrar una instalación específica
    public function show($id)
    {
        $instalacion = instalaciones::with('sesiones')->find($id);

        if (!$instalacion) {
            return response()->json(['message' => 'Instalación no encontrada'], 404);
        }

        return response()->json($instalacion, 200);
    }

    // Crear una nueva instalación
    public function store(Request $request)
    {
        $request->validate([
            'ins_Nombre' => 'required|string|max:255',
            'ins_localidad' => 'required|string|max:255',
            'ins_calle' => 'nullable|string|max:255',
            'ins_coordenadas' => 'nullable|string|max:255',
            'ins_num' => 'nullable|integer'
        ]);

        $instalacion = instalaciones::create($request->only([
            'ins_Nombre',
            'ins_localidad',
            'ins_calle',
            'ins_coordenadas',
            'ins_num'
        ]));

        return response()->json($instalacion, 201);
    }

    // Actualizar una instalación
    public function update(Request $request, $id)
    {
        $instalacion = instalaciones::find($id);

        if (!$instalacion) {
            return response()->json(['message' => 'Instalación no encontrada'], 404);
        }

        $request->validate([
            'ins_Nombre' => 'sometimes|required|string|max:255',
            'ins_localidad' => 'sometimes|required|string|max:255',
            'ins_calle' => 'nullable|string|max:255',
            'ins_coordenadas' => 'nullable|string|max:255',
            'ins_num' => 'nullable|integer'
        ]);

        $instalacion->update($request->only([
            'ins_Nombre',
            'ins_localidad',
            'ins_calle',
            'ins_coordenadas',
            'ins_num'
        ]));

        return response()->json($instalacion, 200);
    }

    // Eliminar una instalación
    public function destroy($id)
    {
        $instalacion = instalaciones::find($id);

        if (!$instalacion) {
            return response()->json(['message' => 'Instalación no encontrada'], 404);
        }

        $instalacion->delete();

        return response()->json(['message' => 'Instalación eliminada correctamente'], 200);
    }
}
