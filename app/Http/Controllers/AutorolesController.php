<?php

namespace App\Http\Controllers;

use App\Models\Autoroles;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AutorolesController extends Controller
{
    public function listar(): JsonResponse
    {
        $autoroles = Autoroles::all();

        return response()->json($autoroles, 200);
    }

    public function insertar(Request $request): JsonResponse|Response
    {
        $datos = $request->all();

        foreach ($datos as $dato) {
            $validador = Validator::make($dato, [
                'id_rol' => 'required|string|max:20',
                'nombre' => 'string|max:50',
                'emoji' => 'string|max:1',
                'tipo' => 'required|string|max:20',
            ]);

            if ($validador->fails()) {
                return response()->json([
                    'error' => $validador->errors(),
                ], 400);
            }
        }

        Autoroles::truncate();

        try {
            foreach ($datos as $dato) {
                $autorol = new Autoroles();
                $autorol->fill($dato);
                $autorol->save();
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

        return response(status: 201);
    }
}
