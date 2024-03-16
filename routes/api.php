<?php

use App\Http\Controllers\EmbedsController;
use App\Http\Controllers\RolesAdministracionController;
use App\Http\Controllers\TiquesController;
use Illuminate\Support\Facades\Route;

Route::prefix('/tiques')
    ->controller(TiquesController::class)
    ->group(function () {
        Route::get('/', 'listar');
        Route::post('/', 'crear');
        Route::put('/', 'actualizar');
        Route::put('/cantidad', 'actualizarCantidad');
    });

Route::prefix('/roles_administracion')
    ->controller(RolesAdministracionController::class)
    ->group(function () {
        Route::get('/', 'listar');
        Route::post('/', 'crear');
        Route::put('/', 'actualizar');
    });

Route::prefix('/embeds')
    ->controller(EmbedsController::class)
    ->group(function () {
        Route::get('/', 'listar');
        Route::post('/', 'crear');
        Route::put('/', 'actualizar');
    });
