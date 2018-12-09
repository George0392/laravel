<button class="btn btn-success" data-toggle="collapse" data-target="#filtro">Filtrar por Fecha</button>


{!! Form::open(array('url'=>'almacen/venta/filtro','method'=>'GET','autocomplete'=>'off','class'=>'form-inline', 'role'=>'search')) !!}
<div class="collapse" id="filtro">
   <br> <div class="card card-body">
        <div class="form-group">
            <label> Desde </label>
            <input required type="date" class="form-control" name="desde">
        </div>
        <div class="form-group">
            <label> Hasta </label>
            <input required type="date" class="form-control" name="hasta" value="{{ date("Y-m-d") }}">
        </div>
        <button type="submit" class="btn btn-success">Filtrar</button>
    </div>
</div>
{{ Form::close() }}