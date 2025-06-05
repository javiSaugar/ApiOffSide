<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sesiones;
use Illuminate\Support\Facades\Validator;
class ControllerSesiones extends Controller
{
     // Listar todas las sesiones
    public function index()
    {
        $sesiones = Sesiones::with(['instalacion', 'deporte', 'usuario', 'actividades'])->get();
        return response()->json($sesiones, 200);
    }

    // Mostrar una sesión específica
    public function show($id)
    {
        $sesion = Sesiones::with(['instalacion', 'deporte', 'usuario', 'actividades'])->find($id);

        if (!$sesion) {
            return response()->json(['message' => 'Sesión no encontrada'], 404);
        }

        return response()->json($sesion, 200);
       
    }

    // Crear una nueva sesión
public function store(Request $request)
{  
   try {
        // Validar campos sin exists porque vienen objetos
        $request->validate([
            'ses_hora'   => 'sometimes|required|string|max:10',
            'ses_fecha'  => 'sometimes|required|date',
            'ses_ins_id' => 'sometimes|required',
            'ses_dep_id' => 'sometimes|required',
            'mat_use_id' => 'sometimes|required',
            'ses_precio' => 'sometimes|required|numeric',
            'ses_nombre' => 'sometimes|required|string|min:3|max:255',
        ]);

        // Extraer los IDs de los objetos o usarlos directamente si ya son IDs
        $ses_ins_id = is_object($request->ses_ins_id) ? $request->ses_ins_id->ins_id : $request->ses_ins_id;
        $ses_dep_id = is_object($request->ses_dep_id) ? $request->ses_dep_id->dep_id : $request->ses_dep_id;
        $ses_use_id = is_object($request->mat_use_id) ? $request->mat_use_id->id : $request->mat_use_id;

        // Validar que esos IDs sí existen en la BD
        $validator = Validator::make([
            'ses_ins_id' => $ses_ins_id,
            'ses_dep_id' => $ses_dep_id,
            'ses_use_id' => $ses_use_id,
        ], [
            'ses_ins_id' => 'exists:instalaciones,ins_id',
            'ses_dep_id' => 'exists:deportes,dep_id',
            'ses_use_id' => 'exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Crear la sesión con los IDs extraídos
        $sesion = Sesiones::create([
            'ses_hora'   => $request->ses_hora,
            'ses_fecha'  => $request->ses_fecha,
            'ses_ins_id' => $ses_ins_id,
            'ses_dep_id' => $ses_dep_id,
            'ses_use_id' => $ses_use_id,
            'ses_precio' => $request->ses_precio,
            'ses_nombre' => $request->ses_nombre,
        ]);

        return response()->json([
            'message' => 'Sesión creada correctamente.',
            'sesion'  => $sesion
        ], 201);

    } catch (\Exception $e) {
        \Log::error('Error al crear sesión: ' . $e->getMessage());
        return response()->json([
            'message' => 'Error al crear sesión',
            'error'   => $e->getMessage()
        ], 500);
    }
}

    // Actualizar una sesión
    public function update(Request $request, $id)
    {
         $sesion = Sesiones::find($id);

    if (!$sesion) {
        return response()->json(['message' => 'Sesión no encontrada'], 404);
    }

    $validated = $request->validate([
        'ses_hora' => 'sometimes|required|string|max:10',
        'ses_fecha' => 'sometimes|required|date',
        'ses_ins_id' => 'sometimes|required|exists:instalaciones,ins_id',
        'ses_dep_id' => 'sometimes|required|exists:deportes,dep_id',
        'ses_use_id' => 'sometimes|required|exists:users,id',
        'ses_precio' => 'sometimes|required|numeric',
        'ses_nombre' => 'sometimes|required|string|max:255',
    ]);

    $sesion->update($validated);

    return response()->json([
        'message' => 'Sesión actualizada correctamente',
        'sesion' => $sesion,
    ]);
    }

    // Eliminar una sesión
    public function destroy($id)
    {
        $sesion = Sesiones::find($id);

        if (!$sesion) {
            return response()->json(['message' => 'Sesión no encontrada'], 404);
        }

        $sesion->delete();

        return response()->json(['message' => 'Sesión eliminada correctamente'], 200);
    }

    // Filtrar sesiones por nombre
    public function buscarPorNombreSesion($nombre)
    {
    $sesiones = Sesiones::with(['instalacion', 'deporte', 'usuario', 'actividades'])
                ->where('ses_nombre', 'LIKE', "%{$nombre}%")
                ->get();

    if ($sesiones->isEmpty()) {
        return response()->json(['message' => 'Sesión no encontrada'], 404);
    }

    return response()->json($sesiones, 200);
    }
}
