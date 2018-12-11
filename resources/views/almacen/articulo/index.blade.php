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
	<div class="col-xs-12 col-md-12">
		<h3 style="display: contents;">Listado de Articulos <a href="articulo/create" class="btn btn-primary "> Nuevo </a> </h3>
		{{--
		###########################################################
		#
		#                    campo de busqueda
		#
		###########################################################
		--}}
		@include('almacen.articulo.search')
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>id</th>
					<th>Nombre</th>
					<th>Código</th>
					<th>Categoria</th>
					<th>Stock</th>
					<th>Imagen</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
				@foreach ($articulos as $art)
				<tr>
					<td>{{ $art->id_articulo }}</td>
					<td class="text-uppercase" >{{ $art->nombre }}</td>
					<td>@php
						echo DNS1D::getBarcodeHTML("$art->codigo", "EAN13", 2,60)
						@endphp
					</td>
					<td>{{ $art->categoria }}</td>
					<td>{{ $art->stock }}</td>
					<td><img src="{{ asset('img/articulos/'.$art->imagen) }}" alt="{{$art->nombre }}" height="100px" width="100px" class="img-thumbnail"></td>
					<td>{{ $art->estado }}</td>
					<td>
						<a href="{{URL::action('ArticuloController@edit',$art->id_articulo)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$art->id_articulo}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('almacen.articulo.modal')
				@endforeach
			</table>
		</div>
		{{ $articulos->render() }}
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