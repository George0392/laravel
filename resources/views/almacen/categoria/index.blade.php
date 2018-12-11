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
		<h3 style="display: contents;">Listado de Categorias <a href="categoria/create" class="btn btn-primary "> Nuevo </a> </h3>
		{{--
		###########################################################
		#
		#                    campo de busqueda
		#
		###########################################################
		--}}
		@include('almacen.categoria.search')
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>id</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Opciones</th>
				</thead>
				@foreach ($categorias as $cat)
				<tr>
					<td>{{ $cat->id_categoria }}</td>
					<td class="text-uppercase" >{{ $cat->nombre }}</td>
					<td>{{ $cat->descripcion }}</td>
					<td>
						 <a href="{{URL::action('CategoriaController@edit',$cat->id_categoria)}}"><button class="btn btn-info">Editar</button></a>

						<a href="" data-target="#modal-delete-{{$cat->id_categoria}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('almacen.categoria.modal')
				@endforeach
			</table>
		</div>
		{{ $categorias->render() }}
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