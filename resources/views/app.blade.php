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
			@if (Auth::guest())
						<li><a href="/auth/login">Login</a></li>
				@else
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img style="max-width: 30px;  margin-right: 5px;  border-radius: 50%;" src="{{Auth::user()->gravatar}}" alt="user">{{ Auth::user()->name }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="/auth/logout">Cerrar Sesión</a></li>
						</ul>
					</li>
			@endif
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

</body>
</html>