<?php

namespace App\Http\Controllers;

use App\Models\Tiques;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TiquesController extends Controller
{
    public function listar(): JsonResponse
    {
        $tiques = Tiques::first();

        if (! $tiques) {
            $tiques = new Tiques();
            $tiques->save();
            $tiques->refresh();
        }

        return response()->json($tiques, 200);
    }

    public function actualizar(Request $request): JsonResponse|Response
    {
        $datos = $request->all();
        $validador = Validator::make($datos, [
            'id_categoria' => 'string|max:20',
            'id_canal_registros' => 'string|max:20',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'error' => $validador->errors(),
            ], 400);
        }

        $tiques = Tiques::first();

        if (! $tiques) {
            $tiques = new Tiques();
            $tiques->save();
            $tiques->refresh();
        }

        $tiques->fill($datos);

        try {
            $tiques->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'error' => 'Error al actualizar la tabla de tiques',
            ], 500);
        }

        return response(status: 200);
    }

    public function actualizarCantidad(): JsonResponse|Response
    {
        $tiques = Tiques::first();

        if (! $tiques) {
            $tiques = new Tiques();
            $tiques->save();
            $tiques->refresh();
        }

        $tiques->cantidad += 1;

        try {
            $tiques->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'error' => 'Error al actualizar la tabla de tiques',
            ], 500);
        }

        return response(status: 200);
    }
}
