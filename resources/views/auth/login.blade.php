@extends('app')

@section('sidebar')
@parent

<ul class="nav" id="main-menu">
    <li class="text-center">
        <img src="{{ '/' }}assets/img/logow.png" class="user-image img-responsive"/>
    </li>

    <li>
        <a href="index.html"><i class="fa fa-book fa-3x"></i>Estudiante</a>
    </li>
    <li>
        <a href="tab-panel.html"><i class="fa fa-check-square-o fa-3x"></i>Jurado</a>
    </li>
    <li>
        <a href="tab-panel.html"><i class="fa fa-user fa-3x"></i>Decano</a>
    </li>
    <li>
        <a href="ui.html"><i class="fa fa-users fa-3x"></i>Cómite Curricular</a>
    </li>            
    <li>
        <a class="active-menu" href="chart.html"><i class="fa fa-tachometer fa-3x"></i>Administrador</a>
    </li>
</ul>

@endsection

@section('content')

<!-- /. NAV SIDE  -->
<div id="page-wrapper" >
    <div id="page-inner">    

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading"><b>Login</b></div>
                        <div class="panel-body" style="padding: 30px;">
                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> Hubo Algunos problemas con tu entrada.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form class="form-horizontal" role="form" method="POST" action="/auth/login">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group input-group input-group-lg">
                                    <span class="input-group-addon">@</span>                            
                                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>                            
                                </div>

                                <div class="form-group input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-key "></i></span>                            
                                    <input type="password" class="form-control" placeholder="Contraseña" name="password" value="{{ old('email') }}" required>                            
                                </div>                        

                                <div class="form-group">
                                    <div class="col-md-6">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember">No cerrar sesión
                                            </label>                                    
                                        </div>                                
                                    </div>
                                    <div class="col-md-6">
                                        <a href="/password/email">¿Olvidaste tu contraseña?</a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            Aceptar
                                        </button>                                
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
@endsection