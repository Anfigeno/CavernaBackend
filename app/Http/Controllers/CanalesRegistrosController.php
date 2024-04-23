<?php

namespace App\Http\Controllers;

use App\Models\CanalesRegistros;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CanalesRegistrosController extends Controller
{
    public function listar(): JsonResponse
    {
        $canales = CanalesRegistros::first();

        if (! $canales) {
            $canales = new CanalesRegistros();
            $canales->save();
            $canales->refresh();
        }

        return response()->json($canales, 200);
    }

    public function actualizar(Request $request): JsonResponse|Response
    {
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

        if (! $canales) {
            $canales = new CanalesRegistros();
            $canales->save();
            $canales->refresh();
        }

        $canales->fill($datos);

        try {
            $canales->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'error' => 'Error al actualizar la tabla de canales de registros',
            ], 500);
        }

        return response(status: 200);
    }
}
