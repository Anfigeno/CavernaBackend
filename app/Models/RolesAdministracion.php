<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolesAdministracion extends Model
{
    protected $fillable = [
        'id_administrador',
        'id_director',
        'id_moderador',
        'id_soporte',
        'id_interno',
    ];
}
