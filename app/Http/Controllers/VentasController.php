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
        if ($request) {
			$query = trim($request->get('searchText'));
			$venta = DB::table('venta as V')
            ->join('persona as P', 'P.id_persona', '=', 'V.id_cliente')
            ->join('detalle_venta as DV', 'V.id_venta', '=', 'DV.id_venta')
            ->select('V.id_venta','V.fecha_hora','P.nombre','V.tipo_comprobante','V.serie_comprobante','V.num_comprobante','V.impuesto','V.estado','V.total_venta')
            ->where('I.num_comprobante', 'LIKE', '%'.$query.'%')
            ->orwhere('P.nombre', 'LIKE', '%'.$query.'%')
            ->orderBy('V.id_venta', 'desc')
            ->groupBy('V.id_venta','V.fecha_hora','P.nombre','V.tipo_comprobante','V.serie_comprobante','V.num_comprobante','V.impuesto','V.estado')
            ->paginate(50);
            return view('almacen.venta.index', ["venta"=>$venta,"searchText"=>$query]);
        }
    }


    public function create()
    {
		$personas  = DB::table('persona')->get();
		$articulos = DB::table('articulo as ART')
       ->join('detalle_ingreso as DI','DI.id_articulo','=','ART.id_articulo')
       ->select(DB::raw('CONCAT(ART.codigo,"-",ART.nombre) as articulo'),'ART.id_articulo','ART.stock','DI.precio_venta')
       ->where('ART.estado','=','activo')
       ->where('ART.stock','>','0')
        ->get();
        return view('almacen.venta.create', ["personas"=>$personas,"articulos"=>$articulos]);
    }


    public function store(IngresoFormRequest $request)
    {
        try {
            DB::beginTransaction();

            // primero cargar en una tabla luego en otra
            $ingreso= new Ingreso;
            $ingreso->id_proveedor=$request->get('id_proveedor');
            $ingreso->tipo_comprobante=$request->get('tipo_comprobante');
            $ingreso->serie_comprobante=$request->get('serie_comprobante');
            $ingreso->num_comprobante=$request->get('numero_comprobante');
            // hora actual
            $mytime = Carbon::now('America/Caracas');
            //convertir a hora legible
            $ingreso->fecha_hora=$mytime->toDateTimeString();
            $ingreso->impuesto='16';
            $ingreso->estado='Activo';
            $ingreso->save();

            //cargar valores en tabla relacion Detalle_Ingreso
            $id_articulo=$request->get('id_articulo');
            $cantidad=$request->get('cantidad');
            $precio_compra=$request->get('precio_compra');
            $precio_venta=$request->get('precio_venta');

            // carga de valores desde tabla en la vista con javascript

            $cont=0;
            while ($cont < count($id_articulo)) {
                $detalle=new Detalle_ingreso();
                $detalle->id_ingreso=$ingreso->id_ingreso;
                $detalle->id_articulo=$id_articulo[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->precio_compra=$precio_compra[$cont];
                $detalle->precio_venta=$precio_venta[$cont];
                $detalle->save();

                $cont=$cont+1;
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        return Redirect::to('almacen/ingreso');
    }

    public function show($id)
    { $venta=$venta = DB::table('venta as V')
            ->join('persona as P', 'P.id_persona', '=', 'V.id_cliente')
            ->join('detalle_venta as DV', 'V.id_venta', '=', 'DV.id_venta')
            ->select('V.id_venta','V.fecha_hora','P.nombre','V.tipo_comprobante','V.serie_comprobante','V.num_comprobante','V.impuesto','V.estado','V.total_venta')
            ->where('V.id_venta', '=', $id)
            ->groupBy('V.id_venta','V.fecha_hora','P.nombre','V.tipo_comprobante','V.serie_comprobante','V.num_comprobante','V.impuesto','V.estado','V.total_venta')
            ->first();

        $detalles=DB::table('Detalle_venta as DV')
        ->join('articulo as A', 'DV.id_articulo', '=', 'A.id_articulo')
        ->select('A.nombre as articulo', 'DV.cantidad')
        ->where('DV.id_venta', '=', $id)
        ->get();

        return view("almacen.venta.show", ["venta"=>$venta,"detalles"=>$detalles]);
    }


    public function destroy($id)
    {
        $venta=Venta::findOrFail($id);
        $venta->estado='N/A';
        $venta->update();
        return Redirect::to('almacen/venta');
    }
}

