<?php

namespace App\Http\Controllers;

use App\Models\Embeds;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class EmbedsController extends Controller
{
    private function tablaEmbedsExiste(): bool
    {
        $embeds = Embeds::first();

        return $embeds !== null;
    }

    public function listar(): JsonResponse
    {
        if (! $this->tablaEmbedsExiste()) {
            return response()->json([
                'error' => 'La tabla de embeds no existe',
            ], 404);
        }

        $embeds = Embeds::first();

        return response()->json($embeds, 200);
    }

    public function crear(Request $request): JsonResponse
    {
        if ($this->tablaEmbedsExiste()) {
            return response()->json([
                'error' => 'La tabla de embeds ya existe',
            ], 409);
        }

        $datos = $request->all();

        $validador = Validator::make($datos, [
            'url_imagen_limitadora' => 'string|max:255',
            'color' => 'string|max:7',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'error' => $validador->errors(),
            ], 400);
        }

        $embeds = new Embeds();
        $embeds->fill($datos);

        try {
            $embeds->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'error' => 'Error al crear el embeds',
            ], 500);
        }

        return response()->json($embeds, 201);
    }

    public function actualizar(Request $request): JsonResponse
    {
        if (! $this->tablaEmbedsExiste()) {
            return response()->json([
                'error' => 'La tabla de embeds no existe',
            ], 404);
        }

        $datos = $request->all();
        $validador = Validator::make($datos, [
            'url_imagen_limitadora' => 'string|max:255',
            'color' => 'string|max:7',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'error' => $validador->errors(),
            ], 400);
        }

        $embeds = Embeds::first();
        $embeds->fill($datos);

        try {
            $embeds->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'error' => 'Error al actualizar el embeds',
            ], 500);
        }

        return response()->json($embeds, 200);
    }
}
