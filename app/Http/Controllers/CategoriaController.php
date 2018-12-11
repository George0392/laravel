<?php

namespace sisven\Http\Controllers;

use Illuminate\Http\Request;
use sisven\Http\Requests;
use sisven\Categoria;
use Illuminate\Support\Facades\Redirect;
use sisven\Http\Requests\CategoriaFormRequest;

use DB;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

public function index(Request $request)
    {
        // variables del query scope
         $nombre      = $request->get('nombre');
         $descripcion = $request->get('descripcion');

         $categorias  = Categoria::orderBy('id_categoria', 'DESC')
            ->nombre($nombre)
            ->descripcion($descripcion)
            ->condicion('1')
            ->paginate(25);
            // dd($categorias);
        return view('almacen.categoria.index', compact('categorias'));
    }


    public function create()
    {
        return view("almacen.categoria.create");
    }
    public function store(CategoriaFormRequest $request)
    {
        // llamamos al modelo articulo
        $categoria=new Categoria;
        // asignamos la validacion request a cada campo del modelo
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->condicion='1';
        $categoria->save();
        return Redirect::to('almacen/categoria');
    }

    public function show($id)
    {
        return view('almacen.categoria.show', ["categoria"=>Categoria::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view("almacen.categoria.edit", ["categoria"=>Categoria::findOrFail($id)]);
    }
    public function update(CategoriaFormRequest $request, $id)
    {
        $categoria=Categoria::findOrFail($id);
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->update();
        return Redirect::to('almacen/categoria');
    }
    public function destroy($id)
    {
        $categoria=Categoria::findOrFail($id);
        $categoria->condicion='0';
        $categoria->update();
        return Redirect::to('almacen/categoria');
    }
}
