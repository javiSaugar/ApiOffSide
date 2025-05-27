<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class ControllerUsuarios extends Controller
{
    // Listar todos los usuarios(funciona)
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    // Mostrar un usuario específico (funciona)
    public function show($id)
    {
   $usuario = User::find($id);

    if (!$usuario) {
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }
    return response()->json($usuario, 200);
    }

    // Crear un nuevo usuario(no funciona)
   public function store(Request $request)
{
    /*
    $user_auth = $request->user();
    */
    try {
        // Validación de los datos recibidos
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'telf'   => 'required|string|max:15',
            'email'   => 'required|string|email|max:255|unique:usuarios,Use_mail',
        ]);

        // Crear y guardar el nuevo usuario en una sola línea
        $usuario = Usuario::create(['name' => $request->nombre, 
                                   'password' => $request->password,
                                   'telf' => $request->telf,
                                   'email' => $request->email]);

        // Retornar respuesta en JSON con el usuario creado
        return response()->json([
            'message' => 'Usuario creado correctamente.',
            'usuario' => $usuario
        ], 201);
        
    } catch (\Exception $e) {
        \Log::error('Error al crear usuario: ' . $e->getMessage());
        return response()->json(['message' => 'Error al crear usuario', 'error' => $e->getMessage()], 500);
    }
    }
    
    // Actualizar un usuario(no funciona)
    public function update(Request $request, $id)
    {
        $usuario = usuarios::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

         $request->validate([
            'nombre'    => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'telf'   => 'required|string|max:15',
            'email'   => 'required|string|email|max:255|unique:usuarios,Use_mail',
        ]);

        $usuario->update($request->only([
            'name' => $request->nombre, 
            'password' => $request->password,
            'telf' => $request->telf,
            'email' => $request->email
        ]));

        return response()->json($usuario, 200);
    }

    // Eliminar un usuario
   public function destroy($id)
    {
    $usuario = User::find($id); 

    if (!$usuario) {
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }

    $usuario->delete();

    return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
 }
    
 // Buscar usuarios por nombre (Funciona)
    public function buscarPorNombre( $nombre)
    {
    // Buscar usuario por Use_Nom
    $usuario = User::where('name', $nombre)->first();

    if (!$usuario) {
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }

    return response()->json($usuario, 200);
    }
}