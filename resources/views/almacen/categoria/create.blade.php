@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-xs-12 col-md-6">
		<h3>Nueva Categoria</h3>
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
		{!! Form::open(array('url'=>'almacen/categoria','method'=>'POST','autocomplete'=>'off')) !!}
		{{ Form::token() }}
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" class="form-control text-uppercase " placeholder="Nombre...">
			<label for="nombre">Descripción</label>
			<input type="text" name="descripcion" class="form-control text-justify" placeholder="Descripción...">
		</div>
		<div class="form-group">
			<button class="btn btn-primary" type="submit" >Guardar</button>
			<button class="btn btn-danger" type="reset" >Borrar</button>
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