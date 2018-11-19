@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-xs-12 col-md-6">
		<h3>Editar Articulo:{{ $articulo->nombre }}</h3>
		{{-- mostrar errores si existen				 --}}
		@if(count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
</div>
{{--
###########################################################
#
#                    formulario
#
###########################################################
--}}
{{-- Reparar rutas con php artisan route:clear y para las rutas guiarse por php artisan route:list --}}
{!! Form::model($articulo,['method'=>'PATCH','route'=>['articulo.update',$articulo->id_articulo],'files'=>'true']) !!}
{{ Form::token() }}
<div class="row">
	<div class="col-xs-12 col-md-6">
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" value="{{ $articulo->nombre }}" required class="form-control text-uppercase" placeholder="Nombre...">
		</div>
	</div>
	<div class="col-xs-12 col-md-6">
		<div class="form-group">
			<label for="nombre">Código</label>
			<input type="text" name="codigo" value="{{ $articulo->codigo }}" required class="form-control text-uppercase" placeholder="Codigo...">
		</div>
	</div>
	<div class="col-xs-12 col-md-6">
		<div class="form-group">
			<label for="nombre">Descripcion</label>
			<input type="text" name="descripcion" value="{{ $articulo->descripcion }}" required class="form-control text-capitalize" placeholder="Descripcion...">
		</div>
	</div>
	<div class="col-xs-12 col-md-6">
		<div class="form-group">
			<label for="nombre">Categoria</label>
			<select name="id_categoria" class="form-control">
				@foreach($categorias as $cat)
				@if($cat->id_categoria==$articulo->id_categoria)
				<option value="{{ $cat->id_categoria }}" selected>{{ $cat->nombre }}</option>
				@else
				<option value="{{ $cat->id_categoria }}">{{ $cat->nombre }}</option>
				@endif
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-xs-12 col-md-6">
		<div class="form-group">
			<label for="nombre">Stock</label>
			<input type="text" name="stock" value="{{ $articulo->stock }}" required class="form-control" placeholder="Stock...">
		</div>
	</div>
	<div class="col-xs-12 col-md-6">
		<div class="form-group">
			<label for="nombre">Estado</label>
			<select  name="estado" 	class="form-control">
				<option value="Inactivo">Inactivo</option>
				<option value="Activo">Activo</option>
			</select>
		</div>
	</div>
	<div class="col-xs-12 col-md-6">
		<div class="form-group">
			<label for="nombre">Imagen</label>
			<input type="file" name="imagen" value="{{ $articulo->imagen }}" class="form-control" placeholder="Imagen...">
			@if(($articulo->imagen)!='')
			<img src="{{ asset('img/articulos/'.$articulo->imagen) }}" alt="{{$articulo->nombre }}" height="200px" width="200px" class="img-thumbnail">

			@endif
		</div>
	</div>
</div>
<div class="col-xs-12 col-md-6">
	<div class="form-group">
		<button class="btn btn-primary" type="submit" >Guardar</button>
		<a href="{{ action('ArticuloController@index') }}" class="btn btn-danger" >Volver</a>

	</div>
</div>
{!! Form::close() !!}
{{--
###########################################################
#
#                    fin formulario
#
###########################################################
--}}
@endsection