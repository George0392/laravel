<?php

namespace sisven\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonaFormRequest extends FormRequest
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
         'nombre'          =>'required',
         'tipo_documento'  =>'required',
         'numero_documento'=>'required',
         'direccion'       =>'required|max:250',
         'telefono'        =>'required|max:12',
         'email'           =>'max:100',
        ];
    }
}
