<button class="btn btn-success" data-toggle="collapse" data-target="#filtro">Buscar</button>


{{ Form::open(['url' => 'almacen/proveedor', 'method' => 'GET', 'class' => 'form-inline']) }}
<div class="collapse" id="filtro">
	<br>
	<div class="form-group">
		{{ Form::label('Buscar por:') }}
		{{ Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) }}

	</div>
	<div class="form-group">
		{{ Form::label(' Buscar por: ') }}
		{{ Form::text('numero_documento', null, ['class' => 'form-control', 'placeholder' => 'Numero documento']) }}
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary">
			<span class="fa fa-search"></span>
		</button>
	</div>
</div>
<br>
{{ Form::close() }}