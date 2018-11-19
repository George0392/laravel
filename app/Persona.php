<?php

namespace sisven;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    // llamar a tabla
    protected $table='persona';
// llamar llave primaria
    protected $primaryKey='id_persona';
// no registrar fecha de actualizaciones
    public $timestamps=true;
    protected $fillable=[
        'tipo_persona',
         'nombre',
         'tipo_documento',
         'numero_documento',
         'direccion',
         'telefono',
         'email',
    ];
}
