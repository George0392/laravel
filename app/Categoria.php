<?php
namespace sisven;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
// llamar a tabla
    protected $table='categoria';
// llamar llave primaria
    protected $primaryKey='id_categoria';
// no registrar fecha de actualizaciones
    public $timestamps=true;
    protected $fillable=[
    'nombre',
    'descripcion',
    'condicion',
    ];
}
