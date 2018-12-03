@extends('layouts.admin')
@section('contenido')


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
			<p>{{ $ingreso->nombre }}</p>
		</div>
	</div>
	<div class="col-xs-6 col-md-3">
		<div class="form-group">
			<label for="nombre">Comprobante</label>
			<p>{{ $ingreso->tipo_comprobante }} - {{ $ingreso->serie_comprobante }} {{ $ingreso->num_comprobante }}</p>
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

			<div class="col-xs-12">

				{{-- tabla para los productos --}}

				<div class="col-xs-12">
					<table id="detalles" class=" table table-striped table-hover table-bordered table-condensed " >
						<thead style="background: lightgrey; color:#000; " >

							<th>Articulo</th>
							<th class="text-center" >Cantidad</th>
							<th class="text-center" >Precio Compra</th>
							<th class="text-center" >Precio Venta</th>
							<th class="text-center" >Subtotal</th>


						</thead>
						<tfoot style="background: lightgrey; color:#000; ">

							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th> <h4 id="total" >Total <strong>BsS. {{ $ingreso->total }}</strong></h4> </th>

						</tfoot>

						<tbody>

							@foreach($detalles as $det)
							<tr>
								<td> {{ $det->articulo }} </td>
								<td class="text-center" > {{ $det->cantidad }} </td>
								<td class="text-center" > {{ $det->precio_compra }} </td>
								<td class="text-center" > {{ $det->precio_venta }} </td>
								<td class="text-center" > {{ $det->precio_compra * $det->cantidad }} </td>
							</tr>



							@endforeach



						</tbody>
					</table>
				</div>
			</div>
		</div>






@endsection