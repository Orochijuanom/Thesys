<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Thesys - ITFIP</title>

	<!-- BOOTSTRAP STYLES-->
	<link href="{{ '/' }}assets/css/bootstrap.css" rel="stylesheet" />
	<!-- FONTAWESOME STYLES-->
	<link href="{{ '/' }}assets/css/font-awesome.css" rel="stylesheet" />
	<!-- CUSTOM STYLES-->
	<link href="{{ '/' }}assets/css/custom.css" rel="stylesheet" />
	<!-- GOOGLE FONTS-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
	<div id="wrapper">
		<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">Thesys</a> 
			</div>
			<div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">			
				@if (!session()->has('user'))
				<a href="/admin/login" class="btn btn-danger square-btn-adjust">Login</a>
				@else
				{{ session('user.name') }}&nbsp;
				<a href="/logout" class="btn btn-danger square-btn-adjust" title="Cerrar Sesión"><i class="fa fa-sign-out fa-lg"></i></a>
				@endif
			</div>
		</nav>   
		<!-- /. NAV TOP  -->	
		

		<nav class="navbar-default navbar-side" role="navigation">
			<div class="sidebar-collapse">
				@section('sidebar')
				@show
			</div>
		</nav>	
		
		@yield('content')

	</div>

	<div id="footer">
		Ingeniería de Sistemas - ITFIP 2015
	</div>		

	<!-- JQUERY SCRIPTS -->
	<script src="{{ '/' }}assets/js/jquery-1.10.2.js"></script>
	<!-- BOOTSTRAP SCRIPTS -->
	<script src="{{ '/' }}assets/js/bootstrap.min.js"></script>
	<!-- METISMENU SCRIPTS -->
	<script src="{{ '/' }}assets/js/jquery.metisMenu.js"></script>
	<!-- CUSTOM SCRIPTS -->
	<script src="{{ '/' }}assets/js/custom.js"></script>
	<script>
		function clicked(e)
		{
			if(!confirm('¿Estás seguro de eliminar este registro?'))e.preventDefault();
		}
	</script>

</body>
</html>