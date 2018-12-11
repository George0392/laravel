<?php

namespace sisven\Http\Controllers;

use Illuminate\Http\Request;
use sisven\Http\Requests;
use sisven\Persona;
use Illuminate\Support\Facades\Redirect;
use sisven\Http\Requests\PersonaFormRequest;

use DB;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $nombre    = $request->get('nombre');
        $NumeroDocumento = $request->get('numero_documento');
        $cliente   = 'proveedor';

        $personas  = Persona::orderBy('id_persona','DESC')
        ->nombre($nombre)
        ->NumeroDocumento($NumeroDocumento)
        ->cliente($cliente)
        ->paginate(25);

        return view('almacen.proveedor.index', compact('personas'));

    }

    public function create()
    {
        return view("almacen.proveedor.create");
    }
    public function store(PersonaFormRequest $request)
    {
        // llamamos al modelo Persona
        $personas=new Persona;
        // asignamos la validacion request a cada campo del modelo
        $personas->tipo_persona='proveedor';
        $personas->nombre=$request->get('nombre');
        $personas->tipo_documento=$request->get('tipo_documento');
        $personas->tipo_documento=$request->get('tipo_documento');
        $personas->numero_documento=$request->get('numero_documento');
        $personas->direccion=$request->get('direccion');
        $personas->telefono=$request->get('telefono');
        $personas->email=$request->get('email');

        $personas->save();
        return Redirect::to('almacen/proveedor');
    }

    public function show($id)
    {
        return view('almacen.proveedor.show', ["personas"=>Persona::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view("almacen.proveedor.edit", ["personas"=>Persona::findOrFail($id)]);
    }
    public function update(PersonaFormRequest $request, $id)
    {
        $personas=Persona::findOrFail($id);

        // asignamos la validacion request a cada campo del modelo
        $personas->tipo_persona='proveedor';
        $personas->nombre=$request->get('nombre');
        $personas->tipo_documento=$request->get('tipo_documento');
        $personas->tipo_documento=$request->get('tipo_documento');
        $personas->numero_documento=$request->get('numero_documento');
        $personas->direccion=$request->get('direccion');
        $personas->telefono=$request->get('telefono');
        $personas->email=$request->get('email');

        $personas->update();
        return Redirect::to('almacen/proveedor');
    }
    public function destroy($id)
    {
        $personas=Persona::findOrFail($id);
        $personas->tipo_persona='N/A';
        $personas->update();
        return Redirect::to('almacen/proveedor');
    }
}
