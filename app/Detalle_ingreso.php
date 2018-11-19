<?php

namespace sisven;

use Illuminate\Database\Eloquent\Model;

class Detalle_ingreso extends Model
{
    // llamar a tabla
    protected $table='detalle_ingreso';
// llamar llave primaria
    protected $primaryKey='id_detalle_ingreso';
// no registrar fecha de actualizaciones
    public $timestamps=true;
    protected $fillable=[
    'id_ingreso',
    'id_articulo',
    'cantidad',
    'precio_compra',
    'precio_venta',

    ];
}
