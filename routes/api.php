<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PisoController;
use App\Http\Controllers\PasilloController;
use App\Http\Controllers\PuntoDestinoController;
use App\Http\Controllers\PuntoReferenciaController;
use App\Http\Controllers\MateriasController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Rutas Públicas (solo lectura, sin autenticación)
|--------------------------------------------------------------------------
*/
Route::get('pisos', [PisoController::class, 'index']);
Route::get('pisos/{piso}', [PisoController::class, 'show']);

Route::get('pasillos', [PasilloController::class, 'index']);
Route::get('pasillos/{pasillo}', [PasilloController::class, 'show']);

Route::get('puntos_referencias', [PuntoReferenciaController::class, 'index']);
Route::get('puntos_referencias/{puntos_referencia}', [PuntoReferenciaController::class, 'show']);

Route::get('puntos_destinos', [PuntoDestinoController::class, 'index']);
Route::get('puntos_destinos/{puntos_destino}', [PuntoDestinoController::class, 'show']);
Route::get('destinos/{id}', [PuntoDestinoController::class, 'showId']);

Route::get('materias', [MateriasController::class, 'index']);
Route::get('materias/{materia}', [MateriasController::class, 'show']);

/*
|--------------------------------------------------------------------------
| Autenticación (rutas públicas de acceso)
|--------------------------------------------------------------------------
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Rutas Protegidas (crear, editar, eliminar)
|--------------------------------------------------------------------------
| Requieren token válido de Sanctum.
*/
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // CRUD protegido
    Route::apiResource('pisos', PisoController::class)->except(['index', 'show']);
    Route::apiResource('pasillos', PasilloController::class)->except(['index', 'show']);
    Route::apiResource('puntos_referencias', PuntoReferenciaController::class)->except(['index', 'show']);
    Route::apiResource('puntos_destinos', PuntoDestinoController::class)->except(['index', 'show']);
    Route::apiResource('materias', MateriasController::class)->except(['index', 'show']);
});
