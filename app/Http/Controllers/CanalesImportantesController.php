<?php

namespace App\Http\Controllers;

use App\Models\CanalesImportantes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CanalesImportantesController extends Controller
{
    private function tablaCanalesImportantesExiste(): bool
    {
        $canalesImportantes = CanalesImportantes::first();

        return $canalesImportantes !== null;
    }

    public function listar(): JsonResponse
    {
        if (! $this->tablaCanalesImportantesExiste()) {
            return response()->json([
                'error' => 'La tabla de canales importantes no existe',
            ], 404);
        }

        $canalesImportantes = CanalesImportantes::first();

        return response()->json($canalesImportantes, 200);
    }

    public function crear(Request $request): JsonResponse|Response
    {
        if ($this->tablaCanalesImportantesExiste()) {
            return response()->json([
                'error' => 'La tabla de canales importantes ya existe',
            ], 400);
        }

        $datos = $request->all();

        $validador = Validator::make($datos, [
            'id_canal_sugerencias' => 'string|max:20',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'error' => $validador->errors(),
            ], 400);
        }

        $canalesImportantes = new CanalesImportantes();
        $canalesImportantes->fill($datos);

        try {
            $canalesImportantes->save();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }

        return response(status: 201);
    }

    public function actualizar(Request $request): JsonResponse|Response
    {
        if (! $this->tablaCanalesImportantesExiste()) {
            return response()->json([
                'error' => 'La tabla de canales importantes no existe',
            ], 400);
        }

        $datos = $request->all();

        $validador = Validator::make($datos, [
            'id_canal_sugerencias' => 'string|max:20',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'error' => $validador->errors(),
            ], 400);
        }

        $canalesImportantes = CanalesImportantes::first();
        $canalesImportantes->fill($datos);

        try {
            $canalesImportantes->save();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }

        return response(status: 201);
    }
}
