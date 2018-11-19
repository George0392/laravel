<?php

namespace sisven\Http\Controllers;

use Illuminate\Http\Request;
use sisven\Http\Requests;
use sisven\Articulo;
use Illuminate\Support\Facades\Redirect;
use sisven\Http\Requests\ArticuloFormRequest;
// libreria para cargar imagenes
use Illuminate\Support\Facades\Input;

use DB;

class ArticuloController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        if ($request) {
            // html del formulario con nombre searchtext
            $query=trim($request->get('searchText'));
            // consulta a la tabla articulo con join a categoria
            $articulos=DB::table('articulo as A')
            ->join('categoria as C', 'A.id_categoria', '=', 'C.id_categoria')
            ->select('A.id_articulo', 'A.nombre', 'A.codigo', 'A.stock', 'C.nombre as categoria', 'A.descripcion', 'A.imagen', 'A.estado')
            ->where('A.codigo', 'LIKE', '%'.$query.'%')
            ->orwhere('A.id_articulo', 'LIKE', '%'.$query.'%')
            ->orderBy('id_articulo', 'DESC')
            ->paginate(25);
            // html del formulario con nombre searchtext y categorias
            return view('almacen.articulo.index', ["articulos"=>$articulos,"searchText"=>$query]);
        }
    }
// carga la vista almacen/articulo/create se le envia $categorias para cargar la tabla y asignar la llave foranea
    public function create()
    {
        $categorias=DB::table('categoria')
        ->where('condicion', '=', '1')
        ->get();
        return view("almacen.articulo.create", ["categorias"=>$categorias]);
    }
    public function store(ArticuloFormRequest $request)
    {
        // llamamos al modelo articulo
        $articulo=new Articulo;
        // asignamos la validacion request a cada campo del modelo
        $articulo->id_categoria=$request->get('id_categoria');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->stock=$request->get('stock');
        $articulo->descripcion=$request->get('descripcion');
        $articulo->estado=$request->get('estado');
        // subir imagen al servidor
        if (Input::hasFile('imagen')) {
            $file=Input::file('imagen');
            $file->move(public_path().'/img/articulos/', $file->getClientOriginalName());
            $articulo->imagen=$file->getClientOriginalName();
        }

        $articulo->save();
        return Redirect::to('almacen/articulo');
    }

    public function show($id)
    {
        return view('almacen.articulo.show', ["articulo"=>Categoria::findOrFail($id)]);
    }

    public function edit($id)
    {
        $articulo=Articulo::findOrFail($id);
        $categorias=DB::table('categoria')
        ->where('condicion', '=', '1')
        ->get();
        return view("almacen.articulo.edit", ["articulo"=>$articulo,"categorias"=>$categorias]);
    }
    public function update(ArticuloFormRequest $request, $id)
    {
        $articulo=Articulo::findOrFail($id);
           // llamamos al modelo articulo
        $articulo->id_categoria=$request->get('id_categoria');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->stock=$request->get('stock');
        $articulo->descripcion=$request->get('descripcion');
        $articulo->estado='activo';
        // subir imagen al servidor
        if (Input::hasFile('imagen')) {
            $file=Input::file('imagen');
            $file->move(public_path().'/img/articulos/', $file->getClientOriginalName());
            $articulo->imagen=$file->getClientOriginalName();
        }

        $articulo->update();
        return Redirect::to('almacen/articulo');
    }
    public function destroy($id)
    {
        $articulo=Articulo::findOrFail($id);
        $articulo->estado='Inactivo';
        $articulo->update();
        return Redirect::to('almacen/articulo');
    }
}
