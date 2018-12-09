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

class FiltroController extends Controller
{

    public function ventas(Request $request)
    {

        $desde = $request->desde;
        $hasta = $request->hasta;
        $venta = DB::table('venta as V')
            ->join('persona as P', 'P.id_persona', '=', 'V.id_cliente')
            ->join('detalle_venta as DV', 'V.id_venta', '=', 'DV.id_venta')
            ->select('V.id_venta', 'V.fecha_hora', 'P.nombre', 'V.tipo_comprobante', 'V.serie_comprobante', 'V.num_comprobante', 'V.impuesto', 'V.estado')
		->whereBetween('created_at', [$desde, $hasta])
		->get();


        $desde = date('d/m/y', strtotime($desde));
        $hasta = date('d/m/y', strtotime($hasta));
        $titulo = "Ingresos desde " . $desde . " hasta " . $hasta;

        return view('control.ingresos.index', compact('titulo','venta'));
    }
}
