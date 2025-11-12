<?php

namespace App\Http\Controllers;

use App\Models\Materias;
use App\Models\PuntoDestino;
use Illuminate\Http\Request;

class MateriasController extends Controller
{
    /**
     * Mostrar todas las materias
     */
    public function index()
    {
        // Carga las materias con su aula
        $materias = Materias::with('aula')->get();

        return response()->json($materias);
    }

    /**
     * Mostrar un formulario para crear nueva materia (si es API puedes omitir)
     */
    public function create()
    {
        $aulas = PuntoDestino::all(); // Para llenar un select de aulas
        return response()->json($aulas);
    }

    /**
     * Guardar nueva materia
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'horarios' => 'required|string|max:255',
            'id_puntos_destinos' => 'required|exists:puntos_destinos,id',
        ]);

        $materia = Materias::create($request->all());

        return response()->json([
            'message' => 'Materia creada con éxito',
            'materia' => $materia
        ], 201);
    }

    /**
     * Mostrar una materia específica
     */
    public function show($id)
    {
        $materia = Materias::with('aula')->findOrFail($id);
        return response()->json($materia);
    }

    /**
     * Mostrar formulario para editar materia (si es API puedes omitir)
     */
    public function edit($id)
    {
        $materia = Materias::findOrFail($id);
        $aulas = PuntoDestino::all();
        return response()->json([
            'materia' => $materia,
            'aulas' => $aulas
        ]);
    }

    /**
     * Actualizar una materia
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombres' => 'sometimes|required|string|max:255',
            'horarios' => 'sometimes|required|string|max:255',
            'id_puntos_destinos' => 'sometimes|required|exists:puntos_destinos,id',
        ]);

        $materia = Materias::findOrFail($id);
        $materia->update($request->all());

        return response()->json([
            'message' => 'Materia actualizada con éxito',
            'materia' => $materia
        ]);
    }

    /**
     * Eliminar una materia
     */
    public function destroy($id)
    {
        $materia = Materias::findOrFail($id);
        $materia->delete();

        return response()->json([
            'message' => 'Materia eliminada con éxito'
        ]);
    }
}
