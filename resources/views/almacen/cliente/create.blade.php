@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-xs-12 col-md-6">
		<h3>Nuevo Cliente</h3>
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
{!! Form::open(array('url'=>'almacen/cliente','method'=>'POST','autocomplete'=>'off')) !!}
{{ Form::token() }}
<div class="row">
	<div class="col-xs-12 col-md-6">
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" value="{{ old('nombre') }}" required class="form-control text-uppercase" placeholder="Nombre...">
		</div>
	</div>
	<div class="col-xs-6 col-md-1">
		<div class="form-group">
			<label for="nombre">Tipo</label>
			<select name="tipo_documento" class="form-control">
				<option value="V">V</option>
				<option value="E">E</option>
				<option value="J">J</option>
			</select>
		</div>
	</div>
	<div class="col-xs-6 col-md-5">
		<div class="form-group">
			<label for="nombre">Numero Documento</label>
			<input type="number" name="numero_documento" value="{{ old('numero_documento') }}" required class="form-control " placeholder="Numero Documento...">
		</div>
	</div>
	<div class="col-xs-12 col-md-6">
		<div class="form-group">
			<label for="nombre">Dirección</label>
			<input type="text" name="direccion" value="{{ old('direccion') }}" required class="form-control " placeholder="Direccion...">
		</div>
	</div>
	<div class="col-xs-12 col-md-6">
		<div class="form-group">
			<label for="nombre">Telefono</label>
			<input type="number" name="telefono" value="{{ old('telefono') }}" required class="form-control" placeholder="Telefono...">
		</div>
	</div>

	<div class="col-xs-12 col-md-6">
		<div class="form-group">
			<label for="nombre">Email</label>
			<input type="mail" name="email" value="{{ old('email') }}" required class="form-control" placeholder="email...">
		</div>
	</div>

</div>
<div class="col-xs-12 col-md-6">
	<div class="form-group">
		<button class="btn btn-primary" type="submit" >Guardar</button>
		<button class="btn btn-danger" type="reset" >Borrar</button>
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