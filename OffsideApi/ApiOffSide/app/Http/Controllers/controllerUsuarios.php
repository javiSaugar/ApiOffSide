<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ControllerUsuarios extends Controller
{

public function login(Request $request)
{
    // Validamos los campos que esperamos recibir
    try {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
    } catch (ValidationException $e) {
        // Capturamos la excepción de validación y devolvemos una respuesta JSON
        return response()->json([
            'mensaje' => 'Faltan campos por rellenar o los campos no son válidos',
            'errores' => $e->errors()
        ], 422);
    }

    // Intentamos obtener el usuario con ese email
    $user = User::where('email', $request->email)->first();

    // Verificamos si el usuario existe y la contraseña es correcta
    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'mensaje' => 'Las credenciales proporcionadas son incorrectas'
        ], 401);
    }

    // Generamos un token de acceso para el usuario
    $token = $user->createToken('auth_token')->plainTextToken;

    // Devolvemos una respuesta JSON con el token de acceso y el usuario
    return response()->json([
        'mensaje' => 'Inicio de sesión exitoso',
        'token' => $token,
        'token_type' => 'Bearer',
        'user' => $user
    ], 200);
}

public function user(Request $request)
{
     return response()->json($request->user());
}

public function logout(Request $request)
{
    $request->user()->tokens()->delete();
    return response()->json(['message' => 'Sesión cerrada'], 200);
}


   /**
     * Muestra todos los usuarios.
     */
    public function index()
    {
        return response()->json(User::all());
    }

    /**
     * Muestra un usuario específico.
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json($user);
    }

    /**
     * Crea un nuevo usuario.
     */
    public function store(Request $request)
    {
       try {
        // Validar campos básicos (sin unique aquí porque luego se valida manualmente)
      $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|max:255',
        'password' => 'required|string|min:6',
        'telf'     => 'required|string|max:15',
        'nom_ape'  => 'required|string|max:255',
        ]);
        // Validar que el email no exista en DB (como validación adicional)
        $validator = Validator::make($request->all(), [
            'email' => 'unique:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Crear usuario (hashear contraseña)
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'telf'     => $request->telf,
            'nom_ape' => $request->nom_ape,
        ]);

        return response()->json([
            'message' => 'Usuario creado correctamente.',
            'user'    => $user
        ], 201);

    } catch (\Exception $e) {
        \Log::error('Error al crear usuario: ' . $e->getMessage());

        return response()->json([
            'message' => 'Error al crear usuario',
            'error'   => $e->getMessage()
        ], 500);
    }
    }

    /**
     * Actualiza un usuario existente.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $validated = $request->validate([
            'name'     => 'sometimes|required|string|max:255',
            'email'    => ['sometimes', 'required', 'email', Rule::unique('users')->ignore($user->id)],
            'telf'     => 'nullable|string|max:15',
            'ape_nom'  => 'nullable|string|max:255',
        ]);

        $user->update($validated);

        return response()->json($user);
    }

    /**
     * Elimina un usuario.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }

    /**
     * Cambia la contraseña de un usuario.
     */
    public function changePassword(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'Contraseña actualizada correctamente']);
    }
    
 // Buscar usuarios por nombre (Funciona)
   public function buscarPorNombre(Request $request)
{
    $nombre = $request->query('nombre');

    $usuarios = User::where('name', 'like', "%$nombre%")->get();

    return response()->json($usuarios);
}



}