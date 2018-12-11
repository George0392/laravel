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

//Query Scope

    public function scopeNombre($query, $nombre)
    {
        if($nombre)
            return $query->where('nombre', 'LIKE', "%$nombre%");
    }

    public function scopeNumeroDocumento($query, $numero_documento)
    {
        if($numero_documento)
            return $query->where('numero_documento', 'LIKE', "%$numero_documento%");
    }

    public function scopeCliente($query, $cliente)
    {
        if($cliente)
            return $query->where('tipo_persona', 'LIKE', "%$cliente%");
    }


}
