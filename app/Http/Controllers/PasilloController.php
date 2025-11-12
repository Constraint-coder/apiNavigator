<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasillo;
use App\Models\Piso;

class PasilloController extends Controller
{
    // 🔹 Listar todos los pasillos con su piso relacionado
    public function index()
    {
        return response()->json(Pasillo::with('piso')->get());
    }

    // 🔹 Crear un nuevo pasillo
public function store(Request $request)
{
    $validated = $request->validate([
    'nombres' => 'required|string|max:255',
    'id_pisos' => 'required|exists:pisos,id',
    'coordenadas' => 'required|array|min:1',
    'coordenadas.*' => 'array|size:2',
    'coordenadas.*.0' => 'numeric',
    'coordenadas.*.1' => 'numeric',
    ]);

    // Guardar directamente en la columna JSON
    $pasillo = Pasillo::create($validated);

    return response()->json([
        'message' => 'Pasillo creado correctamente',
        'data' => $pasillo,
    ]);
}


    // 🔹 Actualizar un pasillo existente
  public function update(Request $request, $id)
{
    $pasillo = Pasillo::findOrFail($id);

    $validated = $request->validate([
        'nombres' => 'required|string|max:255',
        'id_pisos' => 'required|exists:pisos,id',
        'coordenadas' => 'required|array|min:1',
        'coordenadas.*.x' => 'required|numeric',
        'coordenadas.*.y' => 'required|numeric',
    ]);

    $pasillo->update($validated);

    return response()->json([
        'message' => 'Pasillo actualizado correctamente',
        'data' => $pasillo,
    ]);
}



    // 🔹 Eliminar un pasillo
    public function destroy($id)
    {
        $pasillo = Pasillo::findOrFail($id);
        $pasillo->delete();

        return response()->json([
            'message' => 'Pasillo eliminado correctamente',
        ]);
    }
}
