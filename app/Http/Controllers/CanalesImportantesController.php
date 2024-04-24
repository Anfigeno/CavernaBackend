<?php

namespace App\Http\Controllers;

use App\Models\CanalesImportantes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CanalesImportantesController extends Controller
{
    public function listar(): JsonResponse
    {
        $canalesImportantes = CanalesImportantes::first();

        if (! $canalesImportantes) {
            $canalesImportantes = new CanalesImportantes();
            $canalesImportantes->save();
            $canalesImportantes->refresh();
        }

        return response()->json($canalesImportantes, 200);
    }

    public function actualizar(Request $request): JsonResponse|Response
    {
        $datos = $request->all();

        $validador = Validator::make($datos, [
            'id_canal_sugerencias' => 'string|max:20',
            'id_canal_general' => 'string|max:20',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'error' => $validador->errors(),
            ], 400);
        }

        $canalesImportantes = CanalesImportantes::first();

        if (! $canalesImportantes) {
            $canalesImportantes = new CanalesImportantes();
            $canalesImportantes->save();
            $canalesImportantes->refresh();
        }

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
