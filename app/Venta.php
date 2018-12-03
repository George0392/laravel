<?php

namespace sisven;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
	// llamar a tabla
    protected $table='venta';
// llamar llave primaria
    protected $primaryKey='id_venta';
// no registrar fecha de actualizaciones
    public $timestamps=true;
    protected $fillable=[
    'id_cliente',
    'tipo_comprobante',
    'serie_comprobante',
    'num_comprobante',
    'fecha_hora',
    'impuesto',
    'total_venta',
    'estado',
    ];
}
