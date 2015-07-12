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

<!-- /. NAV SIDE  -->
<div id="page-wrapper" >
	<div id="page-inner"> 

		<div style="text-align: center;">
			<h1>Bienvenido Administrador</h1>
			<img src="{{ '/' }}assets/img/logo.png" width="60%">
		</div>

	</div>
	<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
@endsection