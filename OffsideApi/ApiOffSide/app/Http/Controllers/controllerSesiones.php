<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sesiones;

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
        $request->validate([
            'ses_hora' => 'required|string',
            'ses_nombre' => 'required|string'
        ]);

        $sesion = Sesiones::create($request->only(['ses_hora', 'ses_nombre']));

        return response()->json($sesion, 201);
    }

    // Actualizar una sesión
    public function update(Request $request, $id)
    {
        $sesion = Sesiones::find($id);

        if (!$sesion) {
            return response()->json(['message' => 'Sesión no encontrada'], 404);
        }

        $request->validate([
            'ses_hora' => 'sometimes|required|string|max:10',
            'ses_fecha' => 'sometimes|required|date',
            'ses_ins_id' => 'sometimes|required|exists:instalaciones,ins_id',
            'ses_dep_id' => 'sometimes|required|exists:deportes,dep_id',
            'mat_use_id' => 'sometimes|required|exists:usuarios,Use_id',
        ]);

        $sesion->update($request->only([
            'ses_hora',
            'ses_fecha',
            'ses_ins_id',
            'ses_dep_id',
            'mat_use_id',
        ]));

        return response()->json($sesion, 200);
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
    // Buscar usuario por Use_Nom
    $sesion = Sesiones::where('', $nombre)->first();

    if (!$sesion) {
        return response()->json(['message' => 'Sesion no encontrado'], 404);
    }

    return response()->json($sesion, 200);
    }
}
