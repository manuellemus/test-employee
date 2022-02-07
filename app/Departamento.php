<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $fillable = [
        'nombreDepartamento', 'ubicacion',
    ];

    public function empleados()
    {
        return $this->hasMany(empleado::class);
    }
}
