<?php

namespace sisven\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisven\Http\Requests\VentaFormRequest;
use sisven\Venta;
use sisven\Detalle_venta;
use DB;

use DateTime;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class VentasController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // variables del query scope
            $nombre        = $request->get('nombre');
            $estado        = $request->get('estado');
            $num_comprobante     = $request->get('num_comprobante');

            $venta = DB::table('venta as V')
            ->join('persona as P', 'P.id_persona', '=', 'V.id_cliente')
            ->join('detalle_venta as DV', 'V.id_venta', '=', 'DV.id_venta')
            ->select('V.id_venta', 'V.fecha_hora','V.created_at', 'P.nombre', 'V.tipo_comprobante', 'V.serie_comprobante', 'V.num_comprobante', 'V.impuesto', 'V.estado', DB::raw('AVG(V.total_venta) as total_venta '))
            ->where('P.nombre', 'LIKE', '%'.$nombre.'%')
            ->where('V.num_comprobante', 'LIKE', '%'.$num_comprobante.'%')
            ->where('V.estado', 'LIKE', '%'.$estado.'%')
            ->orderBy('V.id_venta', 'desc')
            ->groupBy('V.id_venta', 'V.fecha_hora','V.created_at' ,'P.nombre', 'V.tipo_comprobante', 'V.serie_comprobante', 'V.num_comprobante', 'V.impuesto', 'V.estado')
            ->paginate(50);

            return view('almacen.venta.index', compact('venta'));

    }


    public function create()
    {
        $personas  = DB::table('persona')->get();
        $articulos = DB::table('articulo as ART')
        ->join('detalle_ingreso as DI', 'DI.id_articulo', '=', 'ART.id_articulo')
        ->select(DB::raw('CONCAT(ART.codigo,"-",ART.nombre) as articulo'), 'ART.id_articulo', 'ART.stock', 'DI.precio_venta')
        ->where('ART.estado', '=', 'activo')
        ->where('ART.stock', '>', '0')
        ->get();
        return view('almacen.venta.create', ["personas"=>$personas,"articulos"=>$articulos]);
    }


    public function store(VentaFormRequest $request)
    {

        $iva=16/100;

        try {
            DB::beginTransaction();

            // primero cargar en una tabla luego en otra
            $venta= new Venta;
            $venta->id_cliente=$request->get('id_cliente');
            $venta->tipo_comprobante=$request->get('tipo_comprobante');
            $venta->serie_comprobante=$request->get('serie_comprobante');
            $venta->num_comprobante=$request->get('numero_comprobante');
            $venta->total_venta=$request->get('total_venta');
            $total_ventas=$venta->total_venta;

            // hora actual
            $mytime = Carbon::now('America/Caracas');
            //convertir a hora legible
            $venta->fecha_hora=$mytime->toDateTimeString();

            $venta->estado='Activo';
            $venta->impuesto= $total_ventas * $iva;
            $venta->save();

            //cargar valores en tabla relacion Detalle_Venta
            $id_articulo=$request->get('id_articulo');
            $cantidad=$request->get('cantidad');
            $descuento=$request->get('descuento');
            $precio_venta=$request->get('precio_venta');

            // carga de valores desde tabla en la vista con javascript

            $cont=0;
            while ($cont < count($id_articulo)) {
                $detalle=new Detalle_venta();
                $detalle->id_venta=$venta->id_venta;
                $detalle->id_articulo=$id_articulo[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->descuento=$descuento[$cont];
                $detalle->precio_venta=$precio_venta[$cont];
                $detalle->save();

                $cont=$cont+1;
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return Redirect::to('almacen/venta/create');
        }
        return Redirect::to('almacen/venta');
    }

    public function show($id)
    {
       $venta = DB::table('venta as V')
       ->join('persona as P', 'P.id_persona', '=', 'V.id_cliente')
       ->join('detalle_venta as DV', 'V.id_venta', '=', 'DV.id_venta')
       ->select('V.id_venta', 'V.fecha_hora', 'P.nombre', 'V.tipo_comprobante', 'V.serie_comprobante', 'V.num_comprobante', 'V.impuesto', 'V.estado', DB::raw('AVG(V.total_venta) as total_venta '))
       ->where('V.id_venta', '=', $id)
       ->groupBy('V.id_venta', 'V.fecha_hora', 'P.nombre', 'V.tipo_comprobante', 'V.serie_comprobante', 'V.num_comprobante', 'V.impuesto', 'V.estado')
       ->first();

       $detalles=DB::table('detalle_venta as DV')
       ->join('articulo as A', 'DV.id_articulo', '=', 'A.id_articulo')
       ->select('A.nombre as articulo', 'DV.cantidad', 'DV.descuento', 'DV.precio_venta')
       ->where('DV.id_venta', '=', $id)
       ->get();

       return view("almacen.venta.show", ["venta"=>$venta,"detalles"=>$detalles]);
   }


   public function destroy($id)
   {
    $venta=Venta::findOrFail($id);
    $venta->estado='Cancelado';
    $venta->update();
    return Redirect::to('almacen/venta');
    }

    public function filtro_fechas(Request $request)
    {
        if ($request) {
        $desde = new Datetime($request->get('desde'));
        $hasta = new Datetime($request->get('hasta'));

        // $venta = venta::whereBetween('fecha_hora', [$desde, $hasta])->get();
            $searchText = trim($request->get('searchText'));
            $venta = DB::table('venta as V')
            ->join('persona as P', 'P.id_persona', '=', 'V.id_cliente')
            ->join('detalle_venta as DV', 'V.id_venta', '=', 'DV.id_venta')
            ->select('V.id_venta', 'V.fecha_hora','V.created_at', 'P.nombre', 'V.tipo_comprobante', 'V.serie_comprobante', 'V.num_comprobante', 'V.impuesto', 'V.estado', DB::raw('AVG(V.total_venta) as total_venta '))
            ->whereBetween('fecha_hora', [$desde, $hasta])
            ->groupBy('V.id_venta', 'V.fecha_hora','V.created_at' ,'P.nombre', 'V.tipo_comprobante', 'V.serie_comprobante', 'V.num_comprobante', 'V.impuesto', 'V.estado')
            ->paginate(50);
            // dd($filtro);
            return view('almacen.venta.index', compact('venta','searchText'));
        }
    }


}
