<?php

namespace sisven;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
// llamar a tabla
    protected $table='articulo';
// llamar llave primaria
    protected $primaryKey='id_articulo';
// no registrar fecha de actualizaciones
    public $timestamps=true;
    protected $fillable=[
    'id_categoria',
    'nombre',
    'codigo',
    'stock',
    'descripcion',
    'imagen',
    'estado',
    ];

}
