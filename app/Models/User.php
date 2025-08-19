<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'nombre',
        'correo',
        'password',
        // Si luego usas estos, agrégalos: numeroidentidad, localidad, direccion, numerocelular, rol, estadosuscripcion, fecharegistro
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',  // igual hasheamos explícito en el controller
        ];
    }

    // Alias "email" para compatibilidad
    public function getEmailAttribute()
    {
        return $this->correo;
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['correo'] = $value;
    }

    // Indicamos que el identificador de login es "correo"
    public function getAuthIdentifierName()
    {
        return 'correo';
    }
}
