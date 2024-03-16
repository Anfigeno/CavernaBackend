<?php

namespace App\Http\Controllers;

use App\Models\Tiques;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TiquesController extends Controller
{
    private function existeTablaTiques(): bool
    {
        $tiques = Tiques::first();

        return $tiques !== null;
    }

    public function listar()
    {
        if (! $this->existeTablaTiques()) {
            return response()->json([
                'error' => 'La tabla de tiques no existe',
            ], 404);
        }

        $tiques = Tiques::first();

        return response()->json($tiques, 200);
    }

    public function crear(Request $request)
    {
        if ($this->existeTablaTiques()) {
            return response()->json([
                'error' => 'La tabla de tiques ya existe',
            ], 409);
        }

        $datos = $request->all();

        $validador = Validator::make($datos, [
            'id_categoria' => 'string|max:20',
            'id_registros' => 'string|max:20',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'error' => $validador->errors(),
            ], 400);
        }

        $tiques = new Tiques();
        $tiques->fill($datos);

        try {
            $tiques->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'error' => 'Error al crear la tabla de tiques',
            ], 500);
        }

        return response()->json($tiques, 201);
    }

    public function actualizar(Request $request): JsonResponse
    {
        if (! $this->existeTablaTiques()) {
            return response()->json([
                'error' => 'La tabla de tiques no existe',
            ], 404);
        }

        $datos = $request->all();
        $validador = Validator::make($datos, [
            'id_categoria' => 'string|max:20',
            'id_registros' => 'string|max:20',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'error' => $validador->errors(),
            ], 400);
        }

        $tiques = Tiques::first();
        $tiques->fill($datos);

        try {
            $tiques->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'error' => 'Error al actualizar la tabla de tiques',
            ], 500);
        }

        return response()->json($tiques, 200);
    }
}
