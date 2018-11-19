@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-xs-12 col-md-6">
		<h3>Nueva Compra</h3>
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
{!! Form::open(array('url'=>'almacen/ingreso','method'=>'POST','autocomplete'=>'off')) !!}
{{ Form::token() }}
{{--
###########################################################
#
#                    ingreso
#
###########################################################
--}}
<div class="row">
	<div class="col-xs-12">
		<div class="form-group">
			<label for="proveedor">Proveedor</label>
			<select name="id_proveedor" id='id_proveedor' class="form-control selectpicker " data-live-search="true" >
				@foreach($personas as $perso)
				<option value="{{ $perso->id_persona }}">{{ $perso->nombre }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-xs-6 col-md-3">
		<div class="form-group">
			<label for="nombre">Tipo Comprobante</label>
			<select name="tipo_comprobante" class="form-control">
				<option value="Factura">Factura</option>
				<option value="Nota Credito">Nota Credito</option>
			</select>
		</div>
	</div>
	<div class="col-xs-6 col-md-2">
		<div class="form-group">
			<label for="serie_comprobante">Serie Comprobante</label>
			<select name="serie_comprobante" class="form-control">
				<option value="J">J</option>
				<option value="V">V</option>
				<option value="E">E</option>
			</select>
		</div>
	</div>
	<div class="col-xs-12 col-md-7">
		<div class="form-group">
			<label for="nombre">Numero</label>
			<input type="number" name="numero_comprobante" value="{{ old('numero_comprobante') }}" required class="form-control text-uppercase" placeholder="Numero Comprobante...">
		</div>
	</div>
</div>
{{--
###########################################################
#
#                    Detalle ingreso
#
###########################################################
--}}
<div class="row">
	<div class="panel panel-primary">
		<div class="panel-body">
			<div class="col-xs-12">
				<div class="form-group">
					<label for="proveedor">Articulo</label>
					<select name="pid_articulo" id='pid_articulo' class="form-control selectpicker " data-live-search="true" >
						@foreach($articulos as $art)
						<option value="{{ $art->id_articulo }}">{{ $art->articulo }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-xs-3">
					<div class="form-group">
						<label for="cantidad">Cantidad</label>
						<input type="number" name="p_cantidad" id='p_cantidad' value="{{ old('cantidad') }}" class="form-control" placeholder="Cantidad...">
					</div>
				</div>

				<div class="col-xs-3">
					<div class="form-group">
						<label for="precio_compra">Precio Compra</label>
						<input type="number" name="pprecio_compra" id='pprecio_compra' value="{{ old('precio_compra') }}" class="form-control" placeholder="Precio Compra...">
					</div>
				</div>

				<div class="col-xs-3">
					<div class="form-group">
						<label for="precio_compra">Precio Venta</label>
						<input type="number" name="pprecio_venta" id='pprecio_venta' value="{{ old('precio_venta') }}" class="form-control" placeholder="Precio Venta...">
					</div>
				</div>
				<div class="col-xs-3">
					<div class="form-group">
						<button type="button" id="btn_add" class="btn-primary btn-lg" ><i class="fa fa-plus" ></i> Agregar</button>
					</div>
				</div>

				{{-- tabla para los productos --}}

				<div class="col-xs-12">
					<table id="detalles" class=" table table-striped table-hover table-bordered table-condensed " >
						<thead style="background: lightgrey; color:#000; " >
							<th>Opciones</th>
							<th>Articulo</th>
							<th>Cantidad</th>
							<th>Precio Compra</th>
							<th>Precio Venta</th>
							<th>Subtotal</th>


						</thead>
						<tfoot style="background: lightgrey; color:#000; ">
							<th>TOTAL</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th> <h4 id="total" >BsS /. 0.0</h4> </th>

						</tfoot>

						<tbody>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
{{--
###########################################################
#
#                    opciones
#
###########################################################
--}}
<div class="col-xs-12 col-md-6" id="guardar">
	<div class="form-group">
		<input name="_token" value={{ csrf_token() }} type="hidden">
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

{{--
###########################################################
#
#           javascript del formulario detalles
#
###########################################################
--}}

@push ('scripts')
<script>

$(document).ready(function(){
	$("#btn_add").click(function(){
		agregar();
	});
});

var cont=0;
total=0;
subtotal=[];
$('#guardar').hide();

function agregar(){
	idarticulo=$("#pid_articulo").val();
	articulo=$("#pid_articulo option:selected").text();
	cantidad=$("#p_cantidad").val();
	precio_compra=$("#pprecio_compra").val();
	precio_venta=$("#pprecio_venta").val();

	// validar si los articulos estan cargados
	if(idarticulo !="" && articulo !="" && cantidad >0 && precio_compra !="" && precio_venta !=""){
		subtotal[cont]=(cantidad * precio_compra);
		total=total + subtotal[cont];

		// añadir fila por cada productos
		var fila='<tr class="selected" id="fila'+cont+'" >'+
		' <td> <button type="button" class="btn btn-warning" onclick="eliminar('+ cont +');">X</button></td>'+
		' <td> <input type="hidden" name="id_articulo[]" value="'+idarticulo+'" >'+ articulo +' </td>'+
		' <td><input type="number" name="cantidad[]" value="'+cantidad+'" ></td>'+
		' <td><input type="number" name="precio_compra[]" value="'+precio_compra+'" ></td>'+
		' <td><input type="number" name="precio_venta[]" value="'+precio_venta+'" ></td> <td>'+subtotal[cont]+'</td>'+
		' </tr>'
		cont++;
		limpiar();
		$("#total").html("BsS. "+ total);
		evaluar();
		$("#detalles").append(fila);
	}
	else{
		alert("Error al cargar el articulo revisa los detalles de este" + idarticulo  + articulo + cantidad + precio_compra + precio_venta)
	}
}

	function limpiar(){
		$("#p_cantidad").val("");
		$("#pprecio_compra").val("");
		$("#pprecio_venta").val("");
	}

	function evaluar(){
		if (total>0){
			$("#guardar").show();
		}
		else{
			$("#guardar").hide();
		}
	}

	function eliminar(index){
		total=total - subtotal[index];
		$("#total").html("BsS. "+total);
		$('#fila'+index).remove();
		evaluar();

	}





</script>
@endpush


@endsection