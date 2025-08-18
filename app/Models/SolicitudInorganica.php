<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudInorganica extends Model
{
    protected $table = 'solicitudinorganica';
    protected $primaryKey = 'idSolicitud';
    public $timestamps = false;

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'idSolicitud', 'idSolicitud');
    }
}
