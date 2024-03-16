<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiques extends Model
{
    protected $fillable = [
        'id_categoria',
        'id_canal_registros',
    ];
}
