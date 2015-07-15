@extends('app')

@section('sidebar')
@parent

<ul class="nav" id="main-menu">
	<li>
		<a href="{{ '/' }}decano/areas"><i class="fa fa-users fa-3x"></i>Areas Institucionales</a>
	</li>
	<li>
		<a href="{{ '/' }}decano/lineas"><i class="fa fa-sitemap fa-3x"></i>Lineas de Investigacion</a>
	</li>    
</ul>

@endsection

@section('content')

<!-- /. NAV SIDE  -->
<div id="page-wrapper" >
	<div id="page-inner"> 

		<div style="text-align: center;">
			<h1>Bienvenido {{ strtok(session('user.name'), " ") }}</h1>			
			<div id="foto">
				<img src="{{Session::get('user.foto')}}"><br />
			</div>
		</div>

	</div>
	<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
@endsection