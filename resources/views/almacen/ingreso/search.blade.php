<button class="btn btn-success" data-toggle="collapse" data-target="#filtro">Buscar</button>


{{ Form::open(['url' => 'almacen/ingreso', 'method' => 'GET', 'class' => 'form-inline']) }}
<div class="collapse" id="filtro">
	<br>
	<div class="form-group">
		{{ Form::label('Por:') }}
		{{ Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) }}

	</div>
	<div class="form-group">
		{{ Form::label(' - ') }}
		{{ Form::text('num_comprobante', null, ['class' => 'form-control', 'placeholder' => '# Comprobante']) }}
	</div>
	<div class="form-group">
		{{ Form::label(' - ') }}
		{{ Form::text('estado', null, ['class' => 'form-control', 'placeholder' => 'Estado']) }}
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary">
			<span class="fa fa-search"></span>
		</button>
	</div>
</div>
<br>
{{ Form::close() }}
