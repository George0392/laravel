@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-xs-12 col-md-6">
		<h3>Editar Categoria:{{ $categoria->nombre }}</h3>
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
		{{--
		###########################################################
		#
		#                    formulario
		#
		###########################################################
		--}}
		{{-- Reparar rutas con php artisan route:clear y para las rutas guiarse por php artisan route:list --}}
		{!! Form::model($categoria,['method'=>'PATCH','route'=>['categoria.update',$categoria->id_categoria]]) !!}
		{{ Form::token() }}
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" value="{{ $categoria->nombre }}" class="form-control text-uppercase " placeholder="Nombre...">
			<label for="nombre">Descripción</label>
			<input type="text" name="descripcion" value="{{ $categoria->descripcion }}"  class="form-control text-uppercase text-justify " placeholder="Descripción...">
		</div>
		<div class="form-group">
			<button class="btn btn-primary" type="submit" >Guardar</button>
			<a href="{{ action('CategoriaController@index') }}" class="btn btn-danger" >Volver</a>
		</div>
		{!! Form::close() !!}
		{{--
		###########################################################
		#
		#                    fin formulario
		#
		###########################################################
		--}}
	</div>
</div>
@endsection