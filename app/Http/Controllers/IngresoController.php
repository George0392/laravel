<?php

namespace sisven\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisven\Http\Requests\IngresoFormRequest;
use sisven\Ingreso;
use sisven\Detalle_ingreso;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class IngresoController extends Controller
{

    public function index(Request $request)
    {
        if ($request) {
            $query=trim($request->get('searchText'));
            $ingreso=DB::table('ingreso as I')
            ->join('persona as P', 'I.id_proveedor', '=', 'P.id_persona')
            ->join('detalle_ingreso as DI', 'I.id_ingreso', '=', 'DI.id_ingreso')
            ->select('I.id_ingreso', 'I.fecha_hora', 'P.nombre', 'I.tipo_comprobante', 'I.serie_comprobante', 'I.num_comprobante', 'I.impuesto', 'I.estado', DB::raw('SUM(DI.cantidad * DI.precio_compra) as total '))
            ->where('I.num_comprobante', 'LIKE', '%'.$query.'%')
            ->orwhere('P.nombre', 'LIKE', '%'.$query.'%')
            ->orderBy('I.id_ingreso', 'desc')
            ->groupBy('I.id_ingreso', 'I.fecha_hora', 'P.nombre', 'I.tipo_comprobante', 'I.serie_comprobante', 'I.num_comprobante', 'I.impuesto', 'I.estado')
            ->paginate(50);
            return view('almacen.ingreso.index', ["ingreso"=>$ingreso,"searchText"=>$query]);
        }
    }


    public function create()
    {
        $personas=DB::table('persona')->where('tipo_persona', '=', 'proveedor')->get();
        $articulos=DB::table('articulo as ART')
        ->select(DB::raw('CONCAT(ART.codigo," - ",ART.nombre) as articulo'), 'ART.id_articulo')
        ->where('ART.estado', '=', 'Activo')
        ->get();
        return view('almacen.ingreso.create', ["personas"=>$personas,"articulos"=>$articulos]);
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
    {
        $ingreso=DB::table('ingreso as I')
        ->join('personas as P', 'I.id_proveedor', '=', 'P.id_persona')
        ->join('detalle_ingreso as DI', 'I.id_ingreso', '=', 'DI.id_ingreso')
        ->select('I.id_ingreso', 'I.fecha_hora', 'P.nombre', 'I.tipo_comprobante', 'I.num_comprobante', 'I.serie_comprobante', 'I.impuesto', 'I.estado', DB::raw('SUM(DI.cantidad * DI.precio_compra) as total '))
        ->where('I.id_ingreso', '=', $id)
        ->first();
        $detalles=DB::table('Detalle_ingreso as DI')
        ->join('articulos as A', 'DI.id_articulo', '=', 'A.id_articulo')
        ->select('A.nombre as articulo', 'DI.cantidad', 'DI.precio_compra', 'DI.precio_venta')
        ->where('DI.id_ingreso', '=', $id)
        ->get();
        return view("almacen.ingreso.show", ["ingreso"=>$ingreso,"detalles"=>$detalles]);
    }


    public function destroy($id)
    {
        $ingreso=Ingreso::findOrFail($id);
        $ingreso->estado='N/A';
        $ingreso->update();
        return Redirect::to('almacen/ingreso');
    }
}
