<?php

namespace App\Http\Controllers;
use App\Models\PuntoReferencia;
use Illuminate\Http\Request;

class PuntoReferenciaController extends Controller
{
    
    public function index()
    {

    return response()->json(PuntoReferencia::with('piso')->get());

    }

    public function store(Request $request)
    {
        $validated = $request->validate([    'nombres' => 'required|string|max:255',
    'id_pisos' => 'required|exists:pisos,id',
    'coordenadas' => 'required|array|min:1',
    'coordenadas' => 'required|array|size:2', 
    'coordenadas.0' => 'numeric',             
    'coordenadas.1' => 'numeric',   
]);
        $punto = PuntoReferencia::create($validated);

        return response()->json([
            'message' => 'Punto Destino Creado Correctamente',
            'data' => $punto,
        ]);
    }

    public function update(Request $request, $id){
         $punto = PuntoReferencia::findOrFail($id);

                $validated = $request->validate([
       
            'nombres' => 'required|string|max:255',
            'coordenadas' => 'required|array',
            'coordenadas.x' => 'required|numeric',
            'coordenadas.y' => 'required|numeric',
            'id_pisos' => 'required|exists:pisos,id',
        ]);
               $punto->update($validated);

             return response()->json([
            'message' => 'Punto Referencia actualizado correctamente',
            'data' => $punto,
        ]);
    }

        public function destroy($id)
    {
        $punto = PuntoReferencia::findOrFail($id);
        $punto->delete();

        return response()->json([
            'message' => 'Punto Referencia eliminado correctamente',
        ]);
    }

    //
}
