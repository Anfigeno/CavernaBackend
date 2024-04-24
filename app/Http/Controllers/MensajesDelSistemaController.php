<?php

namespace App\Http\Controllers;

use App\Models\MensajesDelSistema;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class MensajesDelSistemaController extends Controller
{
    public function listar(): JsonResponse
    {
        $mensajesDelSistema = MensajesDelSistema::first();

        if (! $mensajesDelSistema) {
            $mensajesDelSistema = new MensajesDelSistema();
            $mensajesDelSistema->save();
            $mensajesDelSistema->refresh();
        }

        return response()->json($mensajesDelSistema, 200);
    }

    public function actualizar(Request $request): JsonResponse|Response
    {
        $datos = $request->all();

        $validador = Validator::make($datos, [
            'bienvenida' => 'string|max:400',
            'sin_permisos' => 'string|max:100',
            'error_interaccion' => 'string|max:100',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'error' => $validador->errors(),
            ], 400);
        }

        $mensajesDelSistema = MensajesDelSistema::first();

        if (! $mensajesDelSistema) {
            $mensajesDelSistema = new MensajesDelSistema();
            $mensajesDelSistema->save();
            $mensajesDelSistema->refresh();
        }

        $mensajesDelSistema->fill($datos);

        try {
            $mensajesDelSistema->save();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }

        return response(status: 200);
    }
}
