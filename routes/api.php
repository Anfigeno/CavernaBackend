<?php

use App\Http\Controllers\AutorolesController;
use App\Http\Controllers\CanalesImportantesController;
use App\Http\Controllers\CanalesRegistrosController;
use App\Http\Controllers\EmbedsController;
use App\Http\Controllers\MensajesDelSistemaController;
use App\Http\Controllers\RolesAdministracionController;
use App\Http\Controllers\TiquesController;
use Illuminate\Support\Facades\Route;

Route::prefix('/tiques')
    ->controller(TiquesController::class)
    ->group(function () {
        Route::get('/', 'listar');
        Route::put('/', 'actualizar');
        Route::put('/cantidad', 'actualizarCantidad');
    });

Route::prefix('/roles_administracion')
    ->controller(RolesAdministracionController::class)
    ->group(function () {
        Route::get('/', 'listar');
        Route::put('/', 'actualizar');
    });

Route::prefix('/embeds')
    ->controller(EmbedsController::class)
    ->group(function () {
        Route::get('/', 'listar');
        Route::put('/', 'actualizar');
    });

Route::prefix('/canales_registros')
    ->controller(CanalesRegistrosController::class)
    ->group(function () {
        Route::get('/', 'listar');
        Route::put('/', 'actualizar');
    });

Route::prefix('/autoroles')
    ->controller(AutorolesController::class)
    ->group(function () {
        Route::get('/', 'listar');
        Route::put('/', 'insertar');
    });

Route::prefix('/canales_importantes')
    ->controller(CanalesImportantesController::class)
    ->group(function () {
        Route::get('/', 'listar');
        Route::put('/', 'actualizar');
    });

Route::prefix('/mensajes_del_sistema')
    ->controller(MensajesDelSistemaController::class)
    ->group(function () {
        Route::get('/', 'listar');
        Route::put('/', 'actualizar');
    });
