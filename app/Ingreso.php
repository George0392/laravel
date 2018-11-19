<?php

namespace sisven;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    // llamar a tabla
    protected $table='ingreso';
// llamar llave primaria
    protected $primaryKey='id_ingreso';
// no registrar fecha de actualizaciones
    public $timestamps=true;
    protected $fillable=[
    'id_proveedor',
    'tipo_comprobante',
    'serie_comprobante',
    'num_comprobante',
    'fecha_hora',
    'impuesto',
    'estado',

    ];
}
