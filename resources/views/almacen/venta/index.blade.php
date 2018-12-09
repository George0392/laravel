@extends('layouts.admin')
@section('contenido')
{{--
###########################################################
#
#                    contenido categoria
#
###########################################################
--}}
<div class="row">
	<div class="col-xs-12 col-sm-8">
		<h3>Listado de Ventas <a href="venta/create" class="btn btn-primary "> Nuevo </a> </h3>
		{{--
		###########################################################
		#
		#                    campo de busqueda
		#
		###########################################################
		--}}
		@include('almacen.venta.search')
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>#</th>
					<th>Fecha_hora</th>
					<th>Nombre</th>
					<th>comprobante</th>
					<th>Estado</th>
					<th>Impuesto</th>
					<th>Subtotal</th>
					<th>Total</th>
					<th>Opciones</th>
				</thead>

				<tfoot>
					<th>#</th>
					<th>Fecha_hora</th>
					<th>Nombre</th>
					<th>comprobante</th>
					<th>Estado</th>
					<th>Impuesto</th>
					<th>Subtotal</th>
					<th>Total</th>
					<th>Opciones</th>
				</tfoot>
				@foreach ($venta as $vent)
				<tr>
					<td>{{ $vent->id_venta }}</td>
					<td>{{ $vent->fecha_hora }}</td>
					<td>{{ $vent->nombre }}</td>
					<td>{{ $vent->tipo_comprobante }}:{{ $vent->serie_comprobante }} -{{ $vent->num_comprobante }}</td>
					<td>{{ $vent->estado }}</td>
					<td> BsS. {{  number_format(round($vent->impuesto, 2), 2, ',', '.') }} </td>
					<td> BsS. {{  number_format(round($vent->total_venta, 2), 2, ',', '.') }}</td>
					<td> BsS. {{  number_format(round($vent->total_venta + $vent->impuesto , 2), 2, ',', '.') }}</td>
					<td>
						<a href="{{URL::action('VentasController@show',$vent->id_venta)}}"><button class="btn btn-info">Ver Detalle</button></a>

						<a href="" data-target="#modal-delete-{{$vent->id_venta}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('almacen.venta.modal')
				@endforeach
			</table>
		</div>
		{{ $venta->render() }}
	</div>
</div>
{{--
###########################################################
#
#                    fin contenido categoria
#
###########################################################
--}}
@endsection