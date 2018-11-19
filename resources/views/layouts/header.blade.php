<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Sisven | Admin</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.5 -->
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
		folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
		<link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
		<link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
	</head>
	{{--
	###########################################################
	#
	#                    menu horizontal
	#
	###########################################################
	--}}
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<header class="main-header">
				<!-- Logo -->
				<a href="index2.html" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					<span class="logo-mini"><b>W51</b></span>
					<!-- logo for regular state and mobile devices -->
					<span class="logo-lg"><b>Sisven</b></span>
				</a>
				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top" role="navigation">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Navegación</span>
					</a>
					<!-- Navbar Right Menu -->
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<!-- Messages: style can be found in dropdown.less-->
							<!-- User Account: style can be found in dropdown.less -->
							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<small class="bg-red">Online</small>
									<span class="hidden-xs">George Galindez</span>
								</a>
								<ul class="dropdown-menu">
									<!-- User image -->
									<li class="user-header">
										<p>
											Desarrollo webs a medida.
											<small>Tsu George</small>
										</p>
									</li>
									<!-- Menu Footer-->
									<li class="user-footer">
										<div class="pull-right">
											<a href="#" class="btn btn-default btn-flat">Cerrar</a>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>
			</header>