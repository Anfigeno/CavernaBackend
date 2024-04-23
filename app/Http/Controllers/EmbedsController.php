<?php

namespace App\Http\Controllers;

use App\Models\Embeds;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class EmbedsController extends Controller
{
    public function listar(): JsonResponse
    {
        $embeds = Embeds::first();

        if (! $embeds) {
            $embeds = new Embeds();
            $embeds->save();
            $embeds->refresh();
        }

        return response()->json($embeds, 200);
    }

    public function actualizar(Request $request): JsonResponse|Response
    {
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

        if (! $embeds) {
            $embeds = new Embeds();
            $embeds->save();
            $embeds->refresh();
        }

        $embeds->fill($datos);

        try {
            $embeds->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'error' => 'Error al actualizar el embeds',
            ], 500);
        }

        return response(status: 200);
    }
}
