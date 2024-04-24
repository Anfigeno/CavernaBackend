<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MensajesDelSistema extends Model
{
    protected $fillable = [
        'bienvenida', 'sin_permisos', 'error_interaccion',
    ];
}
