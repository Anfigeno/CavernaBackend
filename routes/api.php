<?php

use App\Http\Controllers\RolesAdministracionController;
use App\Http\Controllers\TiquesController;
use Illuminate\Support\Facades\Route;

Route::prefix('/tiques')
    ->controller(TiquesController::class)
    ->group(function () {
        Route::get('/', 'listar');
        Route::post('/', 'crear');
        Route::put('/', 'actualizar');
    });

Route::prefix('/roles_administracion')
    ->controller(RolesAdministracionController::class)
    ->group(function () {
        Route::get('/', 'listar');
        Route::post('/', 'crear');
        Route::put('/', 'actualizar');
    });
