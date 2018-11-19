<?php

namespace sisven\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngresoFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // ingreso
        'id_proveedor',
        'tipo_comprobante',
        'serie_comprobante',
        'numero_comprobante',
        'fecha_hora',
        'impuesto',
        'estado',
// detalle_ingreso
        'id_ingreso',
        'id_articulo',
        'cantidad',
        'precio_compra',
        'precio_venta',

        ];
    }
}
