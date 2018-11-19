@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-xs-12 col-md-6">
		<h3>Nuevo Articulo</h3>
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
{!! Form::open(array('url'=>'almacen/articulo','method'=>'POST','autocomplete'=>'off','files'=>'true')) !!}
{{ Form::token() }}
<div class="row">
	<div class="col-xs-12 col-md-6">
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" value="{{ old('nombre') }}" required class="form-control text-uppercase" placeholder="Nombre...">
		</div>
	</div>
	<div class="col-xs-12 col-md-6">
		<div class="form-group">
			<label for="nombre">Código</label>
			<input type="text" name="codigo" value="{{ old('codigo') }}" required class="form-control text-uppercase" placeholder="Codigo...">
		</div>
	</div>
	<div class="col-xs-12 col-md-6">
		<div class="form-group">
			<label for="nombre">Descripcion</label>
			<input type="text" name="descripcion" value="{{ old('descripcion') }}" required class="form-control text-capitalize" placeholder="Descripcion...">
		</div>
	</div>
	<div class="col-xs-12 col-md-6">
		<div class="form-group">
			<label for="nombre">Categoria</label>
			<select name="id_categoria" class="form-control">
				@foreach($categorias as $cat)
				<option value="{{ $cat->id_categoria }}">{{ $cat->nombre }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-xs-12 col-md-6">
		<div class="form-group">
			<label for="nombre">Stock</label>
			<input type="text" name="stock" value="{{ old('stock') }}" required class="form-control" placeholder="Stock...">
		</div>
	</div>
	<div class="col-xs-12 col-md-6">
		<div class="form-group">
			<label for="nombre">Imagen</label>
			<input type="file" name="imagen" class="form-control" placeholder="Imagen...">
		</div>
	</div>
	<div class="col-xs-12 col-md-6">
		<div class="form-group">
			<label for="nombre">Estado</label>
			<select  name="estado" 	class="form-control">
				<option value="Activo">Activo</option>
				<option value="Inactivo">Inactivo</option>
			</select>
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