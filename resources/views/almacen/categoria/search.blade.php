<button class="btn btn-success" data-toggle="collapse" data-target="#filtro">Buscar</button>


{{ Form::open(['url' => 'almacen/categoria', 'method' => 'GET', 'class' => 'form-inline']) }}
<div class="collapse" id="filtro">
	<br>
	<div class="form-group">
		{{ Form::label('Por:') }}
		{{ Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) }}

	</div>
	<div class="form-group">
		{{ Form::label('-') }}
		{{ Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Descripcion']) }}
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary">
			<span class="fa fa-search"></span>
		</button>
	</div>
</div>
<br>
{{ Form::close() }}


{{-- {!! Form::open(array('url'=>'almacen/categoria','method'=>'GET','autocomplete'=>'off', 'role'=>'search')) !!}
<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control " name="searchText" placeholder="Buscar..." value="{{ $searchText }}" >
		<span class="input-group-btn ">
			<button type="submit" class="btn btn-primary" > Buscar </button>
		</span>
	</div>
</div>
{{ Form::close() }} --}}