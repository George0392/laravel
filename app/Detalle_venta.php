<?php

namespace sisven;

use Illuminate\Database\Eloquent\Model;

class Detalle_venta extends Model
{
    // llamar a tabla
    protected $table='detalle_venta';
// llamar llave primaria
    protected $primaryKey='id_detalle_venta';
// no registrar fecha de actualizaciones
    public $timestamps=true;
    protected $fillable=[
    'id_venta',
    'id_articulo',
    'cantidad',
    'precio_venta',
    'descuento',
    ];
}
