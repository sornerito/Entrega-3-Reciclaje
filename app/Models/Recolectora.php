<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recolectora extends Model
{
    protected $table = 'recolectora';
    protected $primaryKey = 'nit';
    public $timestamps = false;

    public function tiposResiduo()
    {
        return $this->belongsToMany(TipoResiduo::class, 'recolectoraresiduo', 'nitRecolectora', 'idResiduo');
    }
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'nit', 'numeroIdentidad');
    }
}
