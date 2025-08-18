<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = "solicitud";
    protected $primaryKey = 'idSolicitud'; 
    public $timestamps = false;

    public function solicitudInorganica()
    {
        return $this->hasOne(SolicitudInorganica::class, 'idSolicitud', 'idSolicitud');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'numeroIdentidadUsuario', 'numeroIdentidad');
    }

    public function tipoResiduo()
{
    return $this->belongsTo(TipoResiduo::class, 'idResiduo', 'idResiduo');
}
}
