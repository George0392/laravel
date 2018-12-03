<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header"></li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-laptop"></i>
					<span>Almacén</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{URL::action('ArticuloController@index')}}"><i class="fa fa-circle-o"></i> Artículos</a></li>
					<li><a href="almacen/categoria"><i class="fa fa-circle-o"></i> Categorías</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-th"></i>
					<span>Compras</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{URL::action('IngresoController@index')}}"><i class="fa fa-circle-o"></i> Ingresos</a></li>
					<li><a href="{{URL::action('ProveedorController@index')}}"><i class="fa fa-circle-o"></i> Proveedores</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-shopping-cart"></i>
					<span>Ventas</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					{{-- <li><a href="{{URL::action('VentasController@index')}}"><i class="fa fa-circle-o"></i> Ventas</a></li> --}}
					<li><a href="{{URL::action('PersonaController@index')}}"><i class="fa fa-circle-o"></i> Clientes</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-folder"></i> <span>Acceso</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					{{-- <li><a href="{{URL::action('UsuarioController@index')}}"><i class="fa fa-circle-o"></i> Usuarios</a></li> --}}
				</ul>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-plus-square"></i> <span>Ayuda</span>
					<small class="label pull-right bg-red">PDF</small>
				</a>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-info-circle"></i> <span>Acerca De...</span>
					<small class="label pull-right bg-yellow">IT</small>
				</a>
			</li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
{{--
###########################################################
#
#                    inicio contenido
#
###########################################################

 --}}
 <!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Mai
	n content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<!-- /.box-header -->
					<div class="box-body">
						<div class="row">