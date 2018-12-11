<?php

namespace sisven\Http\Controllers;

use Illuminate\Http\Request;
use sisven\Http\Requests;
use sisven\Articulo;
use Illuminate\Support\Facades\Redirect;
use sisven\Http\Requests\ArticuloFormRequest;
// libreria para cargar imagenes
use Illuminate\Support\Facades\Input;
//Generar codigo de barras
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;

use DB;

class ArticuloController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // variables del query scope
            $nombre        = $request->get('nombre');
            $codigo        = $request->get('codigo');
            $categoria     = $request->get('categoria');

            $codigo_barras = new DNS1D();

            // consulta a la tabla articulo con join a categoria
            $articulos     = DB::table('articulo as A')
            ->join('categoria as C', 'A.id_categoria', '=', 'C.id_categoria')
            ->select('A.id_articulo', 'A.nombre', 'A.codigo', 'A.stock', 'C.nombre as categoria', 'A.descripcion', 'A.imagen', 'A.estado')
            ->where('A.nombre', 'LIKE', '%'.$nombre.'%')
            ->where('A.codigo', 'LIKE', '%'.$codigo.'%')
            ->where('C.nombre', 'LIKE', '%'.$categoria.'%')
            ->orderBy('id_articulo', 'DESC')
            ->paginate(50);

        return view('almacen.articulo.index', compact('articulos','codigo_barras'));
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
