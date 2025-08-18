<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'numeroIdentidad';
    public $timestamps = false;

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'numeroIdentidadUsuario', 'numeroIdentidad');
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'numeroIdentidad', 'numeroIdentidad');
    }
}
