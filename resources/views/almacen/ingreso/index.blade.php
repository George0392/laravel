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
		<h3>Listado de Compras <a href="ingreso/create" class="btn btn-primary "> Nuevo </a> </h3>
		{{--
		###########################################################
		#
		#                    campo de busqueda
		#
		###########################################################
		--}}
		@include('almacen.ingreso.search')
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>id_ingreso</th>
					<th>fecha_hora</th>
					<th>nombre</th>
					<th>comprobante</th>
					<th>impuesto</th>
					<th>estado</th>
					<th>total</th>
					<th>Opciones</th>
				</thead>

				<tfoot>
					<th>id_ingreso</th>
					<th>fecha_hora</th>
					<th>nombre</th>
					<th>comprobante</th>
					<th>impuesto</th>
					<th>estado</th>
					<th>total</th>
					<th>Opciones</th>
				</tfoot>
				@foreach ($ingreso as $ing)
				<tr>
					<td>{{ $ing->id_ingreso }}</td>
					<td>{{ $ing->fecha_hora }}</td>
					<td>{{ $ing->nombre }}</td>
					<td>{{ $ing->tipo_comprobante }}:{{ $ing->serie_comprobante }} -{{ $ing->num_comprobante }}</td>
					<td>{{ $ing->impuesto }}</td>
					<td>{{ $ing->estado }}</td>
					<td>{{ $ing->total }}</td>
					<td>
						<a href="{{URL::action('IngresoController@show',$ing->id_ingreso)}}"><button class="btn btn-info">Ver Detalle</button></a>

						<a href="" data-target="#modal-delete-{{$ing->id_ingreso}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('almacen.ingreso.modal')
				@endforeach
			</table>
		</div>
		{{ $ingreso->render() }}
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