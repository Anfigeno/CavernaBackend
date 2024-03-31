<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CanalesRegistros extends Model
{
    protected $fillable = [
        'id_canal_mensajes',
        'id_canal_voz',
        'id_canal_usuarios',
        'id_canal_sanciones',
        'id_canal_servidor',
    ];
}
