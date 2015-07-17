@extends('app')

@section('sidebar')
@parent

<ul class="nav" id="main-menu">
	<li>
		<a href="{{ '/' }}decano/areas"><i class="fa fa-university fa-3x"></i>Áreas Institucionales</a>
	</li>
	<li>
		<a href="{{ '/' }}decano/lineas"><i class="fa fa-lightbulb-o fa-3x"></i>Líneas de Investigación</a>
	</li>
	<li>
		<a href="{{ '/' }}decano/reportes"><i class="fa fa-bar-chart fa-3x"></i>Reportes</a>
	</li>    
</ul>

@endsection

@section('content')

{{ $nombre = strtok(session('user.name'), " ") }}

<!-- /. NAV SIDE  -->
<div id="page-wrapper" >
	<div id="page-inner"> 

		<div style="text-align: center;">
			<h1>Bienvenido {{ $nombre }}</h1>			
			<div id="foto">
				<img src="{{Session::get('user.foto')}}" alt="{{ $nombre }}" title="{{ $nombre }}"><br />
			</div>
		</div>

	</div>
	<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
@endsection