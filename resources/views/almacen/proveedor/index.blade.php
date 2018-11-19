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
		<h3>Listado de Proveedores <a href="proveedor/create" class="btn btn-primary "> Nuevo </a> </h3>
		{{--
		###########################################################
		#
		#                    campo de busqueda
		#
		###########################################################
		--}}
		@include('almacen.proveedor.search')
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>#</th>
					<th>Nombre</th>
					<th>Documento</th>
					<th>Direccion</th>
					<th>Telefono</th>
					<th>e-mail</th>
					<th>Opciones</th>
				</thead>

				<tfoot>
					<th>#</th>
					<th>Nombre</th>
					<th>Documento</th>
					<th>Direccion</th>
					<th>Telefono</th>
					<th>e-mail</th>
					<th>Opciones</th>
				</tfoot>
				@foreach ($personas as $perso)
				<tr>
					<td>{{ $perso->id_persona }}</td>
					<td>{{ $perso->nombre }}</td>
					<td>{{ $perso->tipo_documento }}-{{ $perso->numero_documento }}</td>
					<td>{{ $perso->direccion }}</td>
					<td>{{ $perso->telefono }}</td>
					<td>{{ $perso->email }}</td>
					<td>
						<a href="{{URL::action('ProveedorController@edit',$perso->id_persona)}}"><button class="btn btn-info">Editar</button></a>

						<a href="" data-target="#modal-delete-{{$perso->id_persona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('almacen.proveedor.modal')
				@endforeach
			</table>
		</div>
		{{ $personas->render() }}
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