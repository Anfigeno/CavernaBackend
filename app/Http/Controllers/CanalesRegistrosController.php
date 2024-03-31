<?php

namespace App\Http\Controllers;

use App\Models\CanalesRegistros;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CanalesRegistrosController extends Controller
{
    private function tablaCanalesRegistrosExiste(): bool
    {
        $canales = CanalesRegistros::first();

        return $canales !== null;
    }

    public function listar(): JsonResponse
    {
        if (! $this->tablaCanalesRegistrosExiste()) {
            return response()->json([
                'error' => 'La tabla de canales de registros no existe',
            ], 404);
        }

        $canales = CanalesRegistros::first();

        return response()->json($canales, 200);
    }

    public function crearar(Request $request): JsonResponse
    {
        if ($this->tablaCanalesRegistrosExiste()) {
            return response()->json([
                'error' => 'La tabla de canales de registros ya existe',
            ], 409);
        }

        $datos = $request->all();

        $validador = Validator::make($datos, [
            'id_canal_mensajes' => 'string|max:20',
            'id_canal_voz' => 'string|max:20',
            'id_canal_usuarios' => 'string|max:20',
            'id_canal_sanciones' => 'string|max:20',
            'id_canal_servidor' => 'string|max:20',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'error' => $validador->errors(),
            ], 400);
        }

        $canales = new CanalesRegistros();
        $canales->fill($datos);

        try {
            $canales->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'error' => 'Error al crear la tabla de canlaes de registros',
            ], 500);
        }

        return response()->json($canales, 200);
    }

    public function actualizar(Request $request): JsonResponse
    {
        if (! $this->tablaCanalesRegistrosExiste()) {
            return response()->json([
                'error' => 'La tabla de canales de registros no existe',
            ], 404);
        }

        $datos = $request->all();
        $validador = Validator::make($datos, [
            'id_canal_mensajes' => 'string|max:20',
            'id_canal_voz' => 'string|max:20',
            'id_canal_usuarios' => 'string|max:20',
            'id_canal_sanciones' => 'string|max:20',
            'id_canal_servidor' => 'string|max:20',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'error' => $validador->errors(),
            ], 400);
        }

        $canales = CanalesRegistros::first();
        $canales->fill($datos);

        try {
            $canales->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'error' => 'Error al actualizar la tabla de canales de registros',
            ], 500);
        }

        return response()->json($canales, 200);
    }
}
