<?php

namespace App\Http\Controllers;

use App\Models\RolesAdministracion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RolesAdministracionController extends Controller
{
    private function existeTablaRolesAdministacion(): bool
    {
        $roles = RolesAdministracion::first();

        return $roles !== null;
    }

    public function listar(): JsonResponse
    {
        if (! $this->existeTablaRolesAdministacion()) {
            return response()->json([
                'error' => 'La tabla de roles de administracion no existe',
            ], 404);
        }

        $rolesAdministacion = RolesAdministracion::first();

        return response()->json($rolesAdministacion, 200);
    }

    public function crear(Request $request): JsonResponse
    {
        if ($this->existeTablaRolesAdministacion()) {
            return response()->json([
                'error' => 'La tabla de roles de administracion ya existe',
            ], 409);
        }

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

        $rolesAdministacion = new RolesAdministracion();
        $rolesAdministacion->fill($datos);

        try {
            $rolesAdministacion->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'error' => 'Error al crear la tabla de roles de administracion',
            ], 500);
        }

        return response()->json($rolesAdministacion, 201);
    }

    public function actualizar(Request $request): JsonResponse
    {
        if (! $this->existeTablaRolesAdministacion()) {
            return response()->json([
                'error' => 'La tabla de roles de administracion no existe',
            ], 404);
        }

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
        $rolesAdministacion->fill($datos);

        try {
            $rolesAdministacion->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'error' => 'Error al actualizar la tabla de roles de administracion',
            ], 500);
        }

        return response()->json($rolesAdministacion, 200);
    }
}
