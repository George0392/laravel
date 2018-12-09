@extends('layouts.admin')
@section('contenido')
{{--
###########################################################
#
#                    venta
#
###########################################################
--}}
<div class="row">
	<div class="col-xs-12">
		<div class="form-group">
			<label for="proveedor">Cliente</label>
			<p>{{ $venta->nombre }}</p>
		</div>
	</div>
	<div class="col-xs-6 col-md-3">
		<div class="form-group">
			<label for="nombre">Comprobante</label>
			<p>{{ $venta->tipo_comprobante }} - {{ $venta->serie_comprobante }} {{ $venta->num_comprobante }}</p>
		</div>
	</div>
</div>
{{--
###########################################################
#
#                    Detalle venta
#
###########################################################
--}}
<div class="row">
	<div class="col-xs-12">
		{{-- tabla para los productos --}}
		<div class="col-xs-12">
			<table id="detalles" class=" table table-striped table-hover table-bordered table-condensed " >
				<thead style="background: lightgrey; color:#000; " >
					<th>Articulo</th>
					<th class="text-center" >Cantidad</th>
					<th class="text-center" >Precio Venta</th>
					<th class="text-center" >Descuento </th>
					<th class="text-center" >Subtotal</th>
				</thead>
				<tfoot style="background: lightgrey; color:#000; ">
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th>
					<h4 id="total" >Total <strong class="text-danger">BsS. {{  number_format(round($venta->total_venta, 2), 2, ',', '.') }}</strong>
					</h4>
				</th>
				</tfoot>
				<tbody>


					@foreach($detalles as $det)
					<tr>
						<td> {{ $det->articulo }} </td>
						<td class="text-center" > {{ $det->cantidad }} </td>
						<td class="text-center" > BsS. {{  number_format(round($det->precio_venta, 2), 2, ',', '.') }} </td>
						<td class="text-center" > {{ $det->descuento }} % </td>
						<td class="text-center" > BsS. {{  number_format(round($det->cantidad * $det->precio_venta - ($det->precio_venta * $det->descuento/100), 2), 2, ',', '.') }} </td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<a href="{{URL::action('VentasController@index')}}" class="btn btn-success btn-lg" >Volver</a>
		</div>
	</div>
</div>
@endsection