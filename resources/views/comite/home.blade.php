@extends('app')

@section('sidebar')
@parent
<ul class="nav" id="main-menu">
    <li>
        <a href="{{ '/' }}estudiante/tesis" class="active-menu"><i class="fa fa-list fa-3x"></i>Trabajo de Grado</a>
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