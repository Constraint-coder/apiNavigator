<?php

namespace App\Http\Controllers;

use App\Models\Piso;
use Illuminate\Http\Request;

class PisoController extends Controller
{
    // 🔹 Listar todos los pisos
    public function index()
    {
        return response()->json(Piso::all());
    }

    // 🔹 Crear un nuevo piso
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombres' => 'required|string|max:255',
        ]);

        $piso = Piso::create($validated);

        return response()->json([
            'message' => 'Piso creado correctamente',
            'data' => $piso,
        ]);
    }

    // 🔹 Mostrar un piso específico
    public function show($id)
    {
        $piso = Piso::findOrFail($id);

        return response()->json($piso);
    }

    // 🔹 Actualizar un piso existente
    public function update(Request $request, $id)
    {
        $piso = Piso::findOrFail($id);

        $validated = $request->validate([
            'nombres' => 'required|string|max:255',
        ]);

        $piso->update($validated);

        return response()->json([
            'message' => 'Piso actualizado correctamente',
            'data' => $piso,
        ]);
    }

    // 🔹 Eliminar un piso
    public function destroy($id)
    {
        $piso = Piso::findOrFail($id);
        $piso->delete();

        return response()->json([
            'message' => 'Piso eliminado correctamente',
        ]);
    }
}
