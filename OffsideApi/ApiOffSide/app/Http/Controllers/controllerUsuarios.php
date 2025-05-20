<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class ControllerUsuarios extends Controller
{
    // Listar todos los usuarios
    public function index()
    {
        return response()->json(Usuario::all(), 200);
    }

    // Mostrar un usuario específico
    public function show($id)
    {
   $usuario = Usuario::find($id);

    if (!$usuario) {
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }
    return response()->json($usuario, 200);
    }

    // Crear un nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'Use_Nom' => 'required|string|max:255',
            'Use_ApeNom' => 'required|string|max:255',
            'Use_telf' => 'required|string|max:15',
            'Use_mail' => 'required|string|email|max:255|unique:usuarios,Use_mail',
        ]);

        $usuario = usuarios::create($request->only([
            'Use_Nom',
            'Use_ApeNom',
            'Use_telf',
            'Use_mail',
        ]));

        return response()->json($usuario, 201);
    }

    // Actualizar un usuario
    public function update(Request $request, $id)
    {
        $usuario = usuarios::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $request->validate([
            'Use_Nom' => 'sometimes|required|string|max:255',
            'Use_ApeNom' => 'sometimes|required|string|max:255',
            'Use_telf' => 'sometimes|required|string|max:15',
            'Use_mail' => 'sometimes|required|string|email|max:255|unique:usuarios,Use_mail,' . $id,
        ]);

        $usuario->update($request->only([
            'Use_Nom',
            'Use_ApeNom',
            'Use_telf',
            'Use_mail',
        ]));

        return response()->json($usuario, 200);
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        $usuario = usuarios::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $usuario->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
    }
}
