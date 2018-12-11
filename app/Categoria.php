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

    //Query Scope

    public function scopeNombre($query, $nombre)
    {
        if($nombre)
            return $query->where('nombre', 'LIKE', "%$nombre%");
    }

    public function scopeDescripcion($query, $descripcion)
    {
        if($descripcion)
            return $query->where('descripcion', 'LIKE', "%$descripcion%");
    }

    public function scopeCondicion($query, $condicion)
    {
        if($condicion)
            return $query->where('condicion', '=', "$condicion");
    }
}
