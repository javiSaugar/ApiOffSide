<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instalacion;

class ControllerInstalaciones extends Controller
{
     // Listar todas las instalaciones
    public function index()
    {
        return response()->json(Instalacion::all(), 200);
    }

    // Mostrar una instalación específica
    public function show($id)
    {
    $instalacion = Instalacion::find($id);

        if (!$instalacion) {
            return response()->json(['message' => 'Instalación no encontrada'], 404);
        }

    return response()->json($instalacion, 200);
    }

    // Crear una nueva instalación
    public function store(Request $request)
    {
         try {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'ins_nombre'      => 'required|string|max:255',
            'ins_localidad'   => 'required|string|max:255',
            'ins_calle'       => 'nullable|string|max:255',
            'ins_coordenadas' => 'nullable|string|max:255',
            'ins_num'         => 'nullable|integer',
        ]);

        // Crear la instalación
        $instalacion = Instalacion::create($validatedData);

        // Devolver la respuesta en JSON
        return response()->json([
            'message' => 'Instalación creada correctamente.',
            'instalacion' => $instalacion
        ], 201);

    } catch (\Exception $e) {
        \Log::error('Error al crear instalación: ' . $e->getMessage());

        return response()->json([
            'message' => 'Error al crear la instalación.',
            'error' => $e->getMessage()
        ], 500);
    }
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
        $instalacion = Instalacion::find($id); // Nombre de clase corregido

    if (!$instalacion) {
        return response()->json(['message' => 'Instalación no encontrada'], 404);
    }

    $instalacion->delete();

    return response()->json(['message' => 'Instalación eliminada correctamente'], 200);
    }
}
