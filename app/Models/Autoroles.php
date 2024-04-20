<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autoroles extends Model
{
    protected $fillable = [
        'id_rol',
        'nombre',
        'emoji',
        'tipo',
    ];
}
