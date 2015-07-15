@extends('app')

@section('sidebar')
@parent

<ul class="nav" id="main-menu">
	<li>
		<a href="{{ '/' }}admin/decanos"><i class="fa fa-users fa-3x"></i>Decanos</a>
	</li>
	<li>
		<a href="{{ '/' }}admin/comites"><i class="fa fa-sitemap fa-3x"></i>Comite Curricular</a>
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