<?php

namespace App\Http\Controllers;

use App\Models\RolesAdministracion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RolesAdministracionController extends Controller
{
    public function listar(): JsonResponse
    {
        $rolesAdministacion = RolesAdministracion::first();

        if (! $rolesAdministacion) {
            $rolesAdministacion = new RolesAdministracion();
            $rolesAdministacion->save();
            $rolesAdministacion->refresh();
        }

        return response()->json($rolesAdministacion, 200);
    }

    public function actualizar(Request $request): JsonResponse|Response
    {
        $datos = $request->all();
        $validador = Validator::make($datos, [
            'id_administrador' => 'string|max:20',
            'id_director' => 'string|max:20',
            'id_moderador' => 'string|max:20',
            'id_interno' => 'string|max:20',
            'id_soporte' => 'string|max:20',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'error' => $validador->errors(),
            ], 400);
        }

        $rolesAdministacion = RolesAdministracion::first();

        if (! $rolesAdministacion) {
            $rolesAdministacion = new RolesAdministracion();
            $rolesAdministacion->save();
            $rolesAdministacion->refresh();
        }

        $rolesAdministacion->fill($datos);

        try {
            $rolesAdministacion->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'error' => 'Error al actualizar la tabla de roles de administracion',
            ], 500);
        }

        return response(status: 200);
    }
}
