<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Registro de usuario
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'nullable|in:admin,usuario', // solo admin o usuario
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'] ?? 'usuario', // default 'usuario'
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Usuario registrado correctamente',
            'user'    => $user,
            'token'   => $token,
        ], 201);
    }

    /**
     * Inicio de sesión (login)
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales no son válidas.'],
            ]);
        }

        // Opcional: eliminar tokens previos
        $user->tokens()->delete();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Inicio de sesión correcto',
            'user'    => $user,
            'token'   => $token,
        ]);
    }

    /**
     * Cerrar sesión (logout)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente',
        ]);
    }

    /**
     * Obtener usuario autenticado
     */
    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
        ]);
    }

    /**
     * Ejemplo de ruta solo para admin
     */
    public function adminOnly(Request $request)
    {
        if (! $request->user()->isAdmin()) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        return response()->json([
            'message' => 'Bienvenido admin',
            'user' => $request->user()
        ]);
    }
}
